<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Team;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'users_details' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function UserProfileUpdate(Request $request)
    {
        $uploded_img = null;
        $user = Auth::User();
        $request->validate(array(
            'email' =>  'required',
            'name'  =>  'required',
        ));

        // if ($request->hasFile('picture')) {
        //     $old_img = public_path($request->picture);
        //     if (file_exists($old_img)) {
        //         @unlink($old_img);
        //     }
        //     $document = $request->file('picture');
        //     $file = 'profile_image/' . floor(time() - 999999999) . $request->file('picture')->getClientOriginalName();
        //     Image::make($document)->save(public_path($file));
        //     $uploded_img = $file;
        // }

        if ($request->file('image')) {
            $file = $request->file('image');
            $old_img = public_path('/image/User' . $request->image);
            if (file_exists($old_img)) {
                @unlink($old_img);
            }
            $filenamefavicon = time() . $file->getClientOriginalName();
            $file->move(public_path('/image/User'),  $filenamefavicon);

            $uploded_img = 'image/User/' . $filenamefavicon;
        }

        if (!$request->file('image')) {
            $uploded_img =  Auth::User()->image;
        }

        // if ($request->hasFile('signature')) {
        //     $old_imgg = public_path($request->signature);
        //     if (file_exists($old_imgg)) {
        //         @unlink($old_imgg);
        //     }
        //     $documentt = $request->file('signature');
        //     $filee = 'signature/' . floor(time() - 999999999) . $request->file('signature')->getClientOriginalName();
        //     Image::make($documentt)->save(public_path($filee));
        //     $uploded_img_sign = $filee;
        // }


        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'email' => $request->email,

                'phone' => $request->mobile,

                'image' => $uploded_img,
                'address' => $request->address,

            ]);
        $team = Team::where('user_id', Auth::id())->first();
        if ($team) {
            $team->phone = $request->name;
            $team->name = $request->name;
            $team->save();
        }

        return redirect()->route('profile.edit')->with('message', 'Updated Successfully!');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function change_password()
    {
        return view('profile.change_password');
    }
    public function UserChangePassword(Request $request)
    {

        $user = Auth::user();
        //dd($user);
        $request->validate(array(
            'current_password'      =>  'required',
            'new_password'    =>  'required'
        ));

        if (Hash::check($request->current_password, $user->password)) {
            DB::table('users')
                ->where('id', Auth::id())
                ->update(['password' => Hash::make($request->new_password)]);
            Session::flash('success', 'Current Password Changed Successfully!');
            // Log out the user
            Auth::logout();

            // Redirect to login page after logging out
            return redirect('/login')->with('message', 'Password changed successfully, please log in again.');
        } else {
            Session::flash('current_password_not_valid', 'Current Password Is Not Correct!');

            return redirect('change_password');
        }
    }
}
