<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\help;
use App\Models\customer;
use App\Models\oldCustomer;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function viewDashboard(Request $req) {
        $date = $req->date ?? now();
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));


        $userCount = user::where('role', 'user')->count();

        $oldsale = customer::whereMonth('regitr_date', $month)
                           ->whereYear('regitr_date', $year)
                           ->where('status', 'sale')
                           ->count();
        $Newsale = oldCustomer::whereMonth('regitr_date', $month)
                              ->whereYear('regitr_date', $year)
                              ->where('status', 'sale')
                              ->count();
        $sale = $oldsale + $Newsale;

        $trial = customer::whereMonth('regitr_date', $month)
                         ->whereYear('regitr_date', $year)
                         ->where('status', 'trial')
                         ->count();

        $lead = customer::whereMonth('regitr_date', $month)
                        ->whereYear('regitr_date', $year)
                        ->where('status', 'lead')
                        ->count();

        $meeting = customer::whereMonth('regitr_date', $month)
                        ->whereYear('regitr_date', $year)
                        ->where('status', 'meeting')
                        ->count();

        $oldCutomerprice = Customer::where('status','sale')->whereMonth('regitr_date', $month)
                                   ->whereYear('regitr_date', $year)
                                   ->sum('price');
        $NewCustomerprice = oldCustomer::where('status','sale')->whereMonth('regitr_date', $month)
                                       ->whereYear('regitr_date', $year)
                                       ->sum('price');
        $price = $oldCutomerprice + $NewCustomerprice;


        $oldSalecustomerExpriDate = Customer::with('user')
                                            ->whereDate('regitr_date', today())
                                            ->get();
        $NewSalecurentSale = OldCustomer::with('user')
                                        ->whereDate('regitr_date', today())
                                        ->get();


        $curentSale = $oldSalecustomerExpriDate->merge($NewSalecurentSale);

        return view('admin.dashbord', compact([
            'userCount', 'sale', 'trial', 'lead', 'price', 'meeting', 'curentSale'
        ]));
    }

     public function  viewAgentSaleTable(){

             $customers = Customer::with('user')
                            ->select('a_name', \DB::raw('count(*) as total'))
                            ->groupBy('a_name')
                            ->where('status', 'sale')
                            ->orderBy('regitr_date', 'desc')
                            ->get();

            return view('admin.agent_sale', compact('customers'));
     }

     public function viewSaleTable(Request $req,string $id){
        $month = date('m', strtotime($req->date));
        $year = date('Y', strtotime($req->date));
         if ($req->date == null) {
            $oldcustomers = Customer::with('user')
            ->where('status', 'sale')
            ->orderBy('regitr_date','desc')
            ->where('a_name',$id)
            ->get();
           $Newcustomers = oldCustomer::with('user')
              ->where('status', 'sale')
              ->orderBy('regitr_date','desc')
              ->where('agent',$id)
              ->get();

         } else {
            $oldcustomers = Customer::with('user')
            ->where('status', 'sale')
            ->whereMonth('regitr_date', $month)
            ->whereYear('regitr_date', $year)
            ->where('a_name',$id)
            ->get();
            $Newcustomers = oldCustomer::with('user')
              ->where('status', 'sale')
              ->whereMonth('regitr_date', $month)
            ->whereYear('regitr_date', $year)
              ->where('agent',$id)
              ->get();

            }
            $customers = $oldcustomers->merge($Newcustomers);

         return view('admin.sale_table', compact('customers'));
     }

     public function cutomerUPdateSaleDetailFormVIew(string $id){
      $customer = customer::find($id);

     return view('admin.edit_agent_sale',compact('customer'));
    }

public function cutomerUPdateDetailSaleStore(Request $req, string $id){
  $req->validate([
    'customer_name' => 'required|string',
    'customer_number' => 'required|numeric',
    'price' => 'required|numeric',
    'remarks' => 'required',
    'status' => 'required',
]);

    $customer = customer::find($id);
    $email = $req->customer_email ?: 'No Email';
    $customer->update([
      'customer_name' => $req->customer_name,
      'customer_email' => $email,
      'customer_number' => $req->customer_number,
      'price' => $req->price,
      'remarks' => $req->remarks,
      'status' => $req->status,
        'regitr_date' => $req->date,
    ]);
    $customer->make_address = $req->make_address;
     $customer->regitr_date = $req->date;
    $customer->save();
    return  redirect()->route('viewAgentSaleTable')->with(['success' => 'Customer Detail Update Successfuly']);
 }

 public function deleteSaleCustomerDetails(string $id){
  $customer = customer::find($id);
  $customer->delete();
  return  redirect()->route('viewAgentSaleTable')->with(['success' => 'Customer Detail Deleted Successfuly']);
}

     public function  viewAgentLeadlTable(){

                $customers = Customer::with('user')
                            ->select('a_name', \DB::raw('count(*) as total'))
                            ->groupBy('a_name')
                            ->where('status', 'lead')
                            ->orderBy('regitr_date', 'desc')
                            ->get();
       return view('admin.agent_lead',compact('customers'));
     }

     public function viewleadtable(string $id){
       $customers = Customer::with('user')
                   ->where('status', 'lead')
                   ->orderByRaw('MONTH(regitr_date) asc')
                   ->where('a_name',$id)
                   ->get();
        return view('admin.lead_table',compact('customers'));
     }

     public function distributeLeadsForm(string $id){
        $agentName = Customer::select('a_name')->with('user')->where('status','lead')->groupBy('a_name')->where('a_name','!=',$id)->get();
        $agentID = user::find($id);
        $customer = Customer::where('status','lead')->where('a_name',$id)->get();
        return view('admin.dis_lead',compact(['agentName','agentID']));
     }

     public function updateLeadAgent(Request $req,string $id){
        $OldLeadAgent = customer::where('status', 'lead')->where('a_name', $id)->get();
        $disLeadAgent = customer::where('status', 'lead')->where('a_name', $req->agent)->get();
        foreach ($OldLeadAgent as $oldAgent) {
            foreach ($disLeadAgent as $newAgent) {
                $newAgentID = $newAgent->a_name;
                $newAgentName = $newAgent->user_name;

                $oldAgent->a_name = $newAgentID;
                $oldAgent->user_name = $newAgentName;

                $oldAgent->save();
                $newAgent->save();
            }
        }
         return redirect()->route('viewAgentLeadlTable')->with(['success' => 'Distribute Lead Successfuly']);
     }

     public function cutomerUPdateDetailFormVIew(string $id){
       $customer = customer::find($id);

      return view('admin.edit_agent_lead',compact('customer'));
     }

   public function cutomerUPdateDetailStore(Request $req, string $id){

    $req->validate([
      'customer_name' => 'required|string',
      'customer_number' => 'required|numeric',
      'price' => 'required|numeric',
      'remarks' => 'required',
      'status' => 'required',

     ]);

      $customer = customer::find($id);
      $email = $req->customer_email ?: 'No Email';
      $customer->update([
        'customer_name' => $req->customer_name,
        'customer_email' => $email,
        'customer_number' => $req->customer_number,
        'price' => $req->price,
        'remarks' => $req->remarks,
        'status' => $req->status,
         'regitr_date' => $req->date,
      ]);
       $customer->regitr_date = $req->date;
      $customer->save();

      return  redirect()->route('viewAgentLeadlTable')->with(['success' => 'Customer Detail Updated Successfuly']);
   }

   public function deleteLeadCustomerDetails(string $id){
      $customer = customer::find($id);
      $customer->delete();
      return  redirect()->route('viewAgentLeadlTable')->with(['success' => 'Customer Detail Deleted Successfuly']);
   }

     public function  viewAgentTrialTable(){

       $customers = Customer::with('user')
      ->where('status', 'trial')
      ->orderByRaw('MONTH(regitr_date) asc')
      ->get();
       return view('admin.agent_trial',compact('customers'));
     }

     public function cutomerUPdateTrialDetailFormVIew(string $id){
      $customer = customer::find($id);

     return view('admin.edit_agent_trial',compact('customer'));
    }

public function cutomerUPdateDetailTrialStore(Request $req, string $id){
  $req->validate([
    'customer_name' => 'required|string',
    'customer_number' => 'required|numeric',
    'price' => 'required|numeric',
    'remarks' => 'required',
    'status' => 'required',
  ]);

    $customer = customer::find($id);
    $email = $req->customer_email ?: 'No Email';
    $customer->update([
      'customer_name' => $req->customer_name,
      'customer_email' => $email,
      'customer_number' => $req->customer_number,
      'price' => $req->price,
      'remarks' => $req->remarks,
      'status' => $req->status,
        'regitr_date' => $req->date,
    ]);

     $customer->regitr_date = $req->date;
    $customer->save();

    return  redirect()->route('viewAgentTrialTable')->with(['success' => 'Customer Detail Update Successfuly']);
 }

 public function deleteTrialCustomerDetails(string $id){
  $customer = customer::find($id);
  $customer->delete();
  return  redirect()->route('viewAgentTrialTable')->with(['success' => 'Customer Detail Deleted Successfuly']);
}



    public function updateCustomerStatus(string $id){
        $customer = customer::find($id);
        $customer->status = 'sale';
        $customer->active_status = null;
        $customer->make_address = null;
        $customer->start_date = null;
        $customer->end_date = null;
        $customer->date_count = null;
        $customer->save();
        return  redirect()->route('viewAgentTrialTable')->with(['success' => 'Customer Detail Updated Successfuly']);
      }

      public function deleteCustomerDetails(string $id){
        $customer = customer::find($id);
        $customer->delete();
        return  redirect()->route('viewAgentTrialTable')->with(['success' => 'Customer Cencel Successfuly']);
    }


    public function viewHelpRequestTableDashboard(){
      $helpRequest = help::all();
       return view('admin.helpTable',compact('helpRequest'));
    }

    public function downHelpRequestStatus(string $id){
      $help = help::find($id);
      $help->status = 'down';
      $help->save();
      return redirect()->route('viewHelpRequestTableDashboard')->with(['success' => 'Help Request is Down Successfuly']);
    }

    public function cancelHelpRequestStatus(string $id){
      $help = help::find($id);
      $help->status = 'cancel';
      $help->save();
      return redirect()->route('viewHelpRequestTableDashboard')->with(['success' => 'Help Request is Cancel Successfuly']);
    }

    public function viewTrialDaysForm(string $id){
      $customer = customer::find($id);
      return view('admin.trial_Days',compact('customer'));
    }


    public function updateStatusCustomerTrial(){
      $customers = Customer::where('active_status', 'active')->get();

      foreach ($customers as $customer) {
          if ($customer->date_count > 0) {
              $customer->date_count = (int) $customer->date_count - 1;

              if ($customer->date_count == 0) {
                  $customer->active_status = 'inactive';
              }

              $customer->save();
          }
      }

      return response()->json(['status' => 'Update complete']);
    }

    public function viewupdateSaleCustomerStatus(string $id){
      $customer = customer::find($id);
      return view('admin.update_sale_days',compact('customer'));
    }
     public function updateSaleCustomerStatus(Request $req,string $id){
      $req->validate([
        'make_address' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
      ]);

      $startDate = new \DateTime($req->start_date);
      $endDate = new \DateTime($req->end_date);

      $interval = $startDate->diff($endDate);
      $daysDifference = $interval->days;
      $customer = Customer::find($id);
      $customer->active_status = 'active';
      $customer->make_address = $req->make_address;
      $customer->start_date = $req->start_date;
      $customer->end_date = $req->end_date;
      $customer->date_count = $daysDifference;
      $customer->save();
      return redirect()->route('viewAgentSaleTable')->with(['success' => 'Customer Sale Days Is Start Now']);
     }

     public function viewSaleDaysForm(string $id){
      $customer = customer::find($id);
      return view('admin.sale_days',compact('customer'));
    }

    public function addSaleCustomerStatus(Request $req,string $id){
      $req->validate([
        'make_address' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
      ]);

      $startDate = new \DateTime($req->start_date);
      $endDate = new \DateTime($req->end_date);

      $interval = $startDate->diff($endDate);
      $daysDifference = $interval->days;
      $customer = Customer::find($id);
      $customer->active_status = 'active';
      $customer->make_address = $req->make_address;
      $customer->start_date = $req->start_date;
      $customer->end_date = $req->end_date;
      $customer->date_count = $daysDifference;
      $customer->save();
      return redirect()->route('viewAgentSaleTable')->with(['success' => 'Customer Sale Days Is Start Now']);
     }

     public function viewAddNumbersForm(){
        return view('admin.add_number');
     }

     public function viewAgentMeeting(){
        $customers = Customer::with('user')
                      ->select('a_name', \DB::raw('count(*) as total'))
                      ->groupBy('a_name')
                      ->where('status', 'meeting')
                      ->orderBy('regitr_date', 'desc')
                      ->get();
         return view('admin.agent_meeting',compact('customers'));
     }



     public function viewMeetingTable(Request $req,string $id){
        $month = date('m', strtotime($req->date));
        $year = date('Y', strtotime($req->date));
         if ($req->date == null) {
            $oldcustomers = Customer::with('user')
            ->where('status', 'meeting')
            ->orderBy('regitr_date','desc')
            ->where('a_name',$id)
            ->get();

         } else {
            $oldcustomers = Customer::with('user')
            ->where('status', 'meeting')
            ->whereMonth('regitr_date', $month)
            ->whereYear('regitr_date', $year)
            ->where('a_name',$id)
            ->get();

            }
            $customers = $oldcustomers;

        //    return $cus
         return view('admin.meeting_table', compact('customers'));
     }

     public function viewAgentDistributeMeeting(string $id){
        $agentName = Customer::select('a_name')->with('user')->where('status','meeting')->groupBy('a_name')->where('a_name','!=',$id)->get();
        $agentID = user::find($id);;
        return view('admin.dis_meeting',compact(['agentName','agentID']));
     }

     public function updateMeetingAgent(Request $req,string $id){
        $OldLeadAgent = customer::where('status', 'meeting')->where('a_name', $id)->get();
        $disLeadAgent = customer::where('status', 'meeting')->where('a_name', $req->agent)->get();
        foreach ($OldLeadAgent as $oldAgent) {
            foreach ($disLeadAgent as $newAgent) {
                $newAgentID = $newAgent->a_name;
                $newAgentName = $newAgent->user_name;

                $oldAgent->a_name = $newAgentID;
                $oldAgent->user_name = $newAgentName;

                $oldAgent->save();
                $newAgent->save();
            }
        }
         return redirect()->route('viewAgentMeeting')->with(['success' => 'Distribute Meeting Successfuly']);
     }


     public function cutomerMeetingUPdateDetailFormVIew(string $id){
        $customer = customer::find($id);

       return view('admin.edit_agent_meeting',compact('customer'));
      }


      public function cutomerMeetingUPdateDetailStore(Request $req, string $id){

        $req->validate([
          'customer_name' => 'required|string',
          'customer_number' => 'required|numeric',
          'price' => 'required|numeric',
          'remarks' => 'required',
          'status' => 'required',

         ]);

          $customer = customer::find($id);
          $email = $req->customer_email ?: 'No Email';
          $customer->update([
            'customer_name' => $req->customer_name,
            'customer_email' => $email,
            'customer_number' => $req->customer_number,
            'price' => $req->price,
            'remarks' => $req->remarks,
            'status' => $req->status,
             'regitr_date' => $req->date,
          ]);
          $customer->regitr_date = $req->date;
          $customer->save();

          return  redirect()->route('viewAgentMeeting')->with(['success' => 'Customer Detail Updated Successfuly']);
       }

       public function deleteMeetingCustomerDetails(string $id){
        $customer = customer::find($id);
        $customer->delete();
        return  redirect()->route('viewAgentMeeting')->with(['success' => 'Customer Detail Deleted Successfuly']);
     }


     public function  viewAgentMeetingDoneTable(){

        $customers = Customer::with('user')
       ->where('status', 'meeting done')
       ->orderByRaw('MONTH(regitr_date) asc')
       ->get();
        return view('admin.meeting_done',compact('customers'));
      }

      public function cutomerUPdateMeetingDoneDetailFormVIew(string $id){
        $customer = customer::find($id);

       return view('admin.edit_meeting_done',compact('customer'));
      }

      public function cutomerUPdateDetailMeetingDoneStore(Request $req, string $id){
        $req->validate([
          'customer_name' => 'required|string',
          'customer_number' => 'required|numeric',
          'price' => 'required|numeric',
          'remarks' => 'required',
          'status' => 'required',
        ]);

          $customer = customer::find($id);
          $email = $req->customer_email ?: 'No Email';
          $customer->update([
            'customer_name' => $req->customer_name,
            'customer_email' => $email,
            'customer_number' => $req->customer_number,
            'price' => $req->price,
            'remarks' => $req->remarks,
            'status' => $req->status,
              'regitr_date' => $req->date,
          ]);

           $customer->regitr_date = $req->date;
          $customer->save();

          return  redirect()->route('viewAgentMeetingDoneTable')->with(['success' => 'Customer Detail Update Successfuly']);
       }

       public function deleteCustomerMeetingDoneDetails(string $id){
        $customer = customer::find($id);
        $customer->delete();
        return  redirect()->route('viewAgentMeetingDoneTable')->with(['success' => 'Customer Deleted Successfuly']);
    }


}
