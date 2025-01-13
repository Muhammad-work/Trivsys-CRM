<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\sendAgentMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class userController extends Controller
{

    public function viewHome(){
        return view('front.home');
    }

    public function viewUserTable(Request $req){
         if ($req->date !== null && strtotime($req->date)) {
              $salemonth = (int) date('m', strtotime($req->date));
              $saleyear = (int) date('Y', strtotime($req->date));

              $currentMonth = $salemonth;
              $currentYear = $saleyear;
         } else {
              $currentMonth = (int) now()->month;
              $currentYear = (int) now()->year;
         }

          $agents = User::all();

         $salesData = [];

         foreach ($agents as $agent) {
            $salesCount = $agent->getSalesCountForMonth($currentMonth, $currentYear);
            $salesData[$agent->id] = $salesCount;
         }

          $users = User::all();

       return view('admin.userTable', compact('users', 'salesData', 'currentMonth'));
    }

    public function addUser(){
        return view('admin.add_user');
    }

    public function storeUserdetail(Request $req){
        $req->validate([
            'user_name' => 'required|string',
            'user_email' => 'required|email|unique:users,email',
            // 'user_phone' => 'required|numeric|unique:users,phone',
            'user_password' => 'required|min:8|max:12|confirmed',
        ]);


        $address = $req->user_address ?: 'No Address';
        $phone = $req->user_phone ?: 'No Address';

        $toSendMail = $req->user_email;
        $subject ='Hello ' . $req->user_name . ' Login Now';
        $message ='Email : ' . $req->user_email . ' Password : ' . $req->user_password;

        Mail::to( $toSendMail)->send(new sendAgentMail($subject,$message));

        user::insert([
          'name' => $req->user_name,
          'email' => $req->user_email,
          'phone' => $phone,
          'address' => $address,
          'password' => Hash::make($req->user_password),
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        return redirect()->route('viewUserTable')->with(['success' => 'User Created Successfuly']);
    }

    public function viewEditForm(string $id){
        $user = user::find($id);
        return view('admin.edit_user',compact('user'));
    }

    public function storeUpdateUser(Request $req, string $id){

        $req->validate([
            'user_name' => 'required|string',
            'user_email' => 'required|email',
            // 'user_phone' => 'required|numeric',
        ]);

        $address = $req->user_address ?: 'No Address';
        $phone = $req->user_phone ?: 'No Address';

        $user = user::find($id);
        $user->update([
            'name' => $req->user_name,
            'email' => $req->user_email,
            'phone' => $phone,
            'address' => $address,
            'created_at' => now(),
            'updated_at' => now(),
          ]);

         $user->ip_address = $req->ip;
         $user->save();

          return redirect()->route('viewUserTable')->with(['success' => 'User Updated Successfuly']);

    }


    public function deleteUser(string $id){
        $user = user::find($id);
        $user->delete();
        return redirect()->route('viewUserTable')->with(['success' => 'User Deleted Successfuly']);
    }


    public function login(){
         Auth::logout();
        return view('front.login');
    }

    public function loginstore(Request $request){

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    // Attempt to authenticate the user
    if (Auth::attempt($credentials, $remember)) {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is inactive
        if ($user->ip_address === '0') {
            Auth::logout(); // Log out if inactive
            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact support.',
            ]);
        }

        // Check if the user's IP matches
        if ($user->ip_address !== '1') {
            // Reject login if IP doesn't match
            Auth::logout(); // Log out if IP doesn't match
            return back()->withErrors([
                'email' => 'You cannot log in from this device or location.',
            ]);
        }

        // Update the user's IP address if it's the first time
        if ($user->ip_address === '1') {
            $user->ip_address = '1'; // Set to current IP address
            $user->save();
        }

        // Redirect based on the user's role
        if ($user->role === 'admin' || $user->role === 'sub_admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('viewHome');
        }
    } else {
        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

    public function sendMail(){
        Mail::to('balochmuhammad817@gmail.com')->send(new sendAgentMail('Hello Muhammad', 'kdmflaksmdflkmslkdmflksm'));
    }

     public function activateUser($id)
    {
       $user = user::find($id);
        if ($user) {
            $user->ip_address = '1';  // Set the user's IP address to the current IP
            $user->save();
            return redirect()->back()->with('success', 'User activated successfully');
        }

        return redirect()->back()->with('error', 'User not found');
    }

    public function deactivateUser($id)
{
     $user = user::find($id);
    if ($user) {
        $user->ip_address = '0';  // Set the user's IP address to '0' to mark as inactive
        $user->save();
        return redirect()->back()->with('success', 'User deactivated successfully');
    }

    return redirect()->back()->with('error', 'User not found');
}

}
