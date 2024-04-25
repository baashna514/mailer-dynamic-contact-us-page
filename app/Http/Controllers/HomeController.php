<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string'],
            'email' => ['required', 'email:rfc'],
            'g-recaptcha-response' => ['required']
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 50 characters.',
            'message.required' => 'The message field is required.',
            'message.string' => 'The message must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address according to the RFC standards.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.'
        ]);
        $data = $request->all();
        $recaptcha_response = $request->input('g-recaptcha-response');

        if (is_null($recaptcha_response)) {
            return redirect()->back()->with('status', 'Please Complete the Recaptcha to proceed');
        }

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $body = [
            'secret' => config('services.recaptcha_v3.secret'),
            'response' => $recaptcha_response,
            'remoteip' => IpUtils::anonymize($request->ip())
        ];

        $response = Http::asForm()->post($url, $body);

        $result = json_decode($response);

        if ($result->success == true) {
            $user = DB::table('users')->first();
            Mail::to($user->email)->send(new ContactFormMail($data));
            return redirect()->back()->with('message', 'Thank you for contacting us. Your message has been sent. ');
        } else {
            return redirect()->back()->with('error', 'Please Complete the Recaptcha Again to proceed');
        }

    }

    public function admin(){
        $user = DB::table('users')->first();
        return view('admin')->with('user', $user);
    }

    public function update(Request $request){
        $this->validate($request, [
            'email' => ['required', 'email:rfc'],
            'password' => ['required'],
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address according to the RFC standards.',
            'password.required' => 'The password field is required.',
        ]);
        $data = $request->all();
        $user = DB::table('users')->first();
        if($data['password'] != $user->password_2){
            return redirect()->back()->with('error', 'You are not authorized to update email.');
        }
        $res = User::query()->first()->update([
            'email' => $data['email']
        ]);
        if($res){
            return redirect()->back()->with('success', 'Email updated.');
        }else{
            return redirect()->back()->with('error', 'Error in updating the email.');
        }
    }

    public function update_password(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $data = $request->all();
        $user = User::first();
        if($data['old_password'] != $user->password_2){
            return redirect()->back()->with('error', 'Old password is incorrect. Please try again.');
        }

        if($data['new_password'] != $data['confirm_password']){
            return redirect()->back()->with('error', 'New password and confirm password do not match. Please make sure they are identical.');
        }

        $result = User::where('id', 1)->update([
            'password' => Hash::make($data['new_password']),
            'password_2' => $data['new_password']
        ]);

        if($result){
            return redirect()->back()->with('success', 'Password has been updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Password is not changed. Please try again.');
        }

        dd($request->all());
    }
}
