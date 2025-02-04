<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\user;
use App\Models\customerNumber;
use App\Models\customerResponse;
use App\Models\expense;
use App\Models\oldCustomer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function storeCustomerDetail(Request $req)
    {
        //   return now();
        $req->validate([
            'customer_name' => 'required|string',
            'customer_number' => 'required|numeric|unique:customers,customer_number',
            'customer_email' => 'unique:customers,customer_email',
            'price' => 'required|numeric',
            'remarks' => 'required',
            'status' => 'required',
            'date' => 'required'

        ]);

        $email = $req->customer_email ?: 'No Email';

        $customer = customer::create([
            'customer_name' => $req->customer_name,
            'customer_email' => $email,
            'customer_number' => $req->customer_number,
            'price' => $req->price,
            'remarks' => $req->remarks,
            'status' => $req->status,
            'a_name' => Auth::id(),
            'regitr_date' => $req->date
        ]);
        $customer->created_at = now();
        $customer->updated_at = now();
        $customer->regitr_date = $req->date;
        $customer->save();

        return back()->with(['success' => 'Customer Created Successfully']);
    }

    public function customerStatus(Request $req, string $id)
    {

        $customer = customer::find($id);
        $customer->update([
            'status' => $req->status
        ]);

        return back()->with(['update' => 'Update Customer Status Successfuly']);
    }

    public function customerSalesTable()
    {
        $oldcustomers = Customer::with('user')->where('a_name', Auth::id())
            ->where('status', 'sale')
            ->orderBy('regitr_date', 'desc')
            ->get();

        $newCustomer = oldCustomer::with('user')->where('agent', Auth::id())
            ->where('status', 'sale')
            ->orderBy('regitr_date', 'desc')
            ->get();

        $customers = $oldcustomers->merge($newCustomer);
        return view('front.customer_sale', compact(['customers']));
    }

    public function customerLeadTable()
    {

        $customers = Customer::where('a_name', Auth::id())
            ->where('status', 'lead')
            ->orderByRaw('MONTH(regitr_date) desc')
            ->get();
        $user = user::where('id', Auth::id())->first();
        return view('front.customer_lead', compact(['user', 'customers']));
    }



    public function customerTrialTable()
    {

        $customers = Customer::with('user')
            ->where('a_name', Auth::id())
            ->where('status', 'trial')
            ->orderByRaw('MONTH(regitr_date) desc')
            ->get();

        return view('front.customer_trial', compact('customers'));
    }

    // public function viewCustomerNumberEditForm(string $id){
    //     $customer = CustomerNumber::find($id);
    //     return view('front.edit_customer_number',compact('customer'));
    // }

    // public function storeCustomerNumberEditDetails(Request $req, string $id)
    // {


    //     if ($req->status == 'lead' || $req->status == 'trial') {
    //         $req->validate([
    //             'status' => 'required',
    //             'remarks' => 'required',
    //             'price' => 'required',
    //         ]);

    //         $customer = CustomerNumber::find($id);
    //         $customerName = $req->customer_name ?: 'No Name';
    //         $customerEmail = 'No Email';
    //         $price = $req->price;
    //         $status = $req->status;
    //         $remarks = $req->remarks;
    //         $authID = Auth::id();
    //         $authName = Auth::user()->name;
    //         $date = now();

    //         $customerLeadDataStoreAndTrialDataStore = customer::create([
    //             'customer_name' => $customerName,
    //             'customer_email' =>  $customerEmail,
    //             'customer_number' =>  $customer->customer_number,
    //             'price' =>  $price,
    //             'remarks' =>  $remarks,
    //             'status' =>   $req->status,
    //             'a_name' =>   $authID,
    //             'user_name' => $authName,
    //             'regitr_date' => $date,
    //         ]);

    //         $customerLeadDataStoreAndTrialDataStore->user_name = $authName;
    //         $customerLeadDataStoreAndTrialDataStore->regitr_date = $date;
    //         $customerLeadDataStoreAndTrialDataStore->save();
    //         $customer->delete();

    //         if ($req->status == 'lead') {
    //             return redirect()->route('viewCunstomerNumberTable')->with(['success' => 'Add Customer Information To Youre Lead Page Successfuly']);
    //         } else {
    //             return redirect()->route('viewCunstomerNumberTable')->with(['success' => 'Add Customer Information To Youre Trial Page Successfuly']);
    //         }
    //     } else {
    //         $req->validate([
    //             'customer_name' => 'required',
    //             'status' => 'required',
    //             'remarks' => 'required',
    //         ]);

    //         $customer = CustomerNumber::find($id);

    //         $customer->customer_name = $req->customer_name;
    //         $customer->status = $req->status;
    //         $customer->remarks = $req->remarks;
    //         $customer->save();

    //         return redirect()->route('viewCunstomerNumberTable')->with(['success' => 'Update Customer Information Successfuly']);
    //     }
    // }


    public function viewEditCustomerSaleDetailForm(Request $req, string $id)
    {
        $customer = customer::where('a_name', Auth::id())->find($id);

        return view('front.edit_customer_sale', compact('customer'));
    }

    public function storeEditCustomerSaleDetails(request $req, string $id)
    {
        $req->validate([
            'price' => 'required',
            'remarks' => 'required',
        ]);
        $customer = customer::find($id);

        $customer->price = $req->price;
        $customer->remarks = $req->remarks;
        $customer->save();

        return redirect()->route('customerSalesTable')->with(['success' => 'Update Sale Detail Successfuly']);
    }


    public function  viewOldCustomerNewPKG(string $id)
    {
        $oldCustomerData = customer::find($id);
        return view('front.add_old_customer_sale', compact('oldCustomerData'));
    }

    public function storeOldCustomerNewPKGData(Request $req, string $id)
    {
        $req->validate([
            'price' => 'required',
            'date' => 'required',
            'remarks' => 'required',
        ]);

        $oldCustomerData = customer::find($id);
        $NewCustomer = oldCustomer::create([
            'customer_name' => $oldCustomerData->customer_name,
            'customer_number' => $oldCustomerData->customer_number,
            'customer_email' => 'No Email',
            'price' => $req->price,
            'status' => 'sale',
            'remarks' => $req->remarks,
        ]);
        $NewCustomer->regitr_date = $req->date;
        $NewCustomer->agent = Auth::id();
        $NewCustomer->save();
        return redirect()->route('customerSalesTable')->with(['success' => 'Add New Customer Successfully']);
    }


    public function viewleadEditForm(string $id)
    {
        $customer  = customer::find($id);
        return view('front.lead_edit', compact('customer'));
    }

    public function storeUpdateLeadData(Request $req, string $id)
    {
        $req->validate([
            'price' => 'required',
            'date' => 'required',
            'remarks' => 'required',
        ]);

        $customer  = customer::find($id);
        $customer->price = $req->price;
        $customer->regitr_date = $req->date;
        $customer->remarks = $req->remarks;

        $customer->save();

        return redirect()->route('customerLeadTable')->with(['success' => 'update customer detail']);
    }

    public function viewTrialEditForm(string $id)
    {
        $customer  = customer::find($id);

        return view('front.trial_edit', compact('customer'));
    }

    public function storeUpdateTrialData(Request $req, string $id)
    {
        $req->validate([
            'price' => 'required',
            'date' => 'required',
            'remarks' => 'required',
        ]);

        $customer  = customer::find($id);
        $customer->price = $req->price;
        $customer->regitr_date = $req->date;
        $customer->remarks = $req->remarks;

        $customer->save();

        return redirect()->route('customerTrialTable')->with(['success' => 'update customer detail']);
    }


    public function customerDeniedTable()
    {

        $customers = Customer::with('user')
            ->where('status', 'denied')
            ->orderByRaw('MONTH(regitr_date) desc')
            ->where('a_name', Auth::id())
            ->get();

        return view('front.customer_denied', compact('customers'));
    }


    public function viewMeetingPage()
    {
        $customers = Customer::with('user')
            ->where('status', 'meeting')
            ->where('a_name', Auth::id())
            ->orderByRaw('MONTH(regitr_date) desc')
            ->get();
        return view('front.meeting', compact('customers'));
    }

    public function viewMeetingDonePage()
    {
        $customers = Customer::with('user')
            ->where('status', 'meeting done')
            ->where('a_name', Auth::id())
            ->orderByRaw('MONTH(regitr_date) desc')
            ->get();
        return view('front.meeting_done', compact('customers'));
    }


    public function viewexpensepage(){
        $expense = expense::with('user')->where('agent',Auth::id())->get();
        return view('front.view_expense',compact('expense'));
    }

    public function viewExpenseForm()
    {
        return view('front.expens');
    }

    public function storeExpenseData(Request $req)
    {
        $req->validate([
            'expense' => 'required',
            'date' => 'required',
            'price' => 'required',
        ]);

        if ($req->hasFile('img')) {
            $imgName = time() . '.' . $req->img->extension();
            $req->img->move(public_path('upload'), $imgName);
        } else {
            $imgName = 'No Img';
        }

        expense::create([
            'expense' => $req->expense,
            'img' => $imgName,
            'date' => $req->date,
            'price' => $req->price,
            'agent' => Auth::id()
        ]);

        return back()->with(['success' => 'Expense Request Uploaded Successfuly']);
    }
}
