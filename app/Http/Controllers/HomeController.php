<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class HomeController extends Controller
{
     public function Dashboard(Request $request)
    {
        return view('backend.admin_dashboard');
    }
     public function UserDashboard(Request $request)
    {
        return view('backend.user_dashboard');
    }
}
