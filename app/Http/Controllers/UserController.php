<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function UserAppointment()
    {
        if (Auth::user()->hasAnyRole('user')) {
        $appointments = Appointment::with('employee')->where('user_id', Auth::user()->id)->latest()->get();
        }
        else{
            $appointments = Appointment::with('employee')->latest()->get();
        }
        return view('backend.user.my_appointment',compact('appointments'));
    }
}
