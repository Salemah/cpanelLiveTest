<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Mail\UserGreetingMail;
use App\Mail\VerificationEmail;
use App\Models\CompanySetting;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function SignInProcess(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->hasAnyRole('admin')) {
                return redirect(route('admin.dashboard'));
            } elseif (Auth::User()->hasAnyRole('team')) {
                return redirect(route('admin.dashboard'));
            } elseif (Auth::User()->hasanyrole('user')) {
                return redirect()->route('user.panel');
            } else {
                // return redirect(route('my-accounts'));
            }
        }
        return redirect()->back()->with('failed', 'These credentials do not match our records.');
    }
    public function SignUpProcess(Request $request)
    {
        // dd(12345);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:11|unique:users',

            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $user = new User();
        $massage = 'New User Created successfully';

        // $user->uuid = (string) Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password != $request->password_confirmation) {
            return Redirect::back()->with('failed', 'Password & Re-type Password Did Not Match.');
        }
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->type = 'user';
        $user->assignRole('user');
        $user->save();

        $Setting = CompanySetting::first();
        $mailData = [
            'logo' => $Setting->logo,
            'title' => $Setting->title,
            'website' => $Setting->website,
            'facebook' => $Setting->facebook,
            'instagram' => $Setting->instagram,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ];
        $dynamicSubject = $Setting->title . ' - Welcome ' . $request->name;
        // dd($mailData);
        // Mail::to($request->email)->send(new UserGreetingMail($mailData, $dynamicSubject));

        //for email verification

        $data = $request->all();
        $createUser = $user;
        $token = Str::random(64);

        UserVerify::create([

            'user_id' => $createUser->id,

            'token' => $token

        ]);
        // Mail::send('mail.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {

        //     $message->to($request->email);

        //     $message->subject('Email Verification Mail');
        // });
        $Setting = CompanySetting::first();
        $dynamicSubject = $Setting->title . ' - Welcome ' . $request->name;

        Mail::to($request->email)->send(new VerificationEmail($data, $dynamicSubject, $token));

        return redirect()->route('login')->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
    }
    public function verifyAccount($token)

    {

        $verifyUser = UserVerify::where('token', $token)->first();



        $message = 'Sorry your email cannot be identified.';



        if (!is_null($verifyUser)) {

            $user = $verifyUser->user;



            if (!$user->is_email_verified) {

                $verifyUser->user->is_email_verified = 1;

                $verifyUser->user->save();

                $message = "Your e-mail is verified. You can now login.";
            } else {

                $message = "Your e-mail is already verified. You can now login.";
            }
        }



        return redirect()->route('login')->with('message', $message);
    }
}
