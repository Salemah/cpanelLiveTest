<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{


    public function UserAppointment()
    {
        return view('backend.user.my_appointment',);
    }
}
