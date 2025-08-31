<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\CompanySetting;
use App\Models\User;
use App\Models\UserVerify;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

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

        //end

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
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
