<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CompanySettingController extends Controller
{
    public function index(Request $request)
    {
        $DashboardSetting = CompanySetting::first();
        return view('backend.company_setting',compact('DashboardSetting'));
    }
    public function companySettingInsert(Request $request)
    {
        $request->validate([
            'system_title' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'copyright' => 'required',


        ]);
        try {
            // if ($request->has('id')) {
            //     $data = CompanySetting::findOrFail($request->id);

            // } else {
                $data =CompanySetting::first();
           // }
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = time() . $file->getClientOriginalName();
                $file->move(public_path('/image/dashboard/'), $filename);
                $data->logo = $filename;
            }
            if ($request->file('favicon')) {
                $file = $request->file('favicon');
                $filenamefavicon = time() . $file->getClientOriginalName();
                $file->move(public_path('/image/dashboard'),  $filenamefavicon);
                $data->favicon =  $filenamefavicon;
            }
            $data->title = $request->system_title;
            $data->about = $request->description;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->facebook = $request->facebook;
            $data->linkedin = $request->linkedin;
            $data->twitter = $request->twitter;
            $data->address = $request->address;
            $data->copyright = $request->copyright;
            $data->website = $request->website;
            $data->save();

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Server Error' . json_encode($e->errorInfo),
            ], 422);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Company Setting Update Successfully',
        ]);
        $DashboardSetting = CompanySetting::first();
       // return view('backend.company_setting',compact('DashboardSetting'));
    }
}
