<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Mail\UserGreetingMail;
use App\Models\CompanySetting;
use App\Models\User;
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
                return redirect(route('dashboard'));
            } elseif (Auth::User()->hasAnyRole('team')) {
                return redirect(route('dashboard'));
            } elseif (Auth::User()->hasanyrole('user')) {
                return redirect()->route('user.dashboard');
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
        Mail::to($request->email)->send(new UserGreetingMail($mailData, $dynamicSubject));

        return redirect()->route('login')->with('message', 'Sign-up Successfully Completed!');
    }
}
