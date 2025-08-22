<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\CompanySetting;
use App\Models\LegalArea;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class TeamController extends Controller
{
    public function TeamAccounts()
    {
        return view('backend.team_accounts',);
    }
    public function TeamData(Request $request)
    {

        $accounts_customer_accounts = Team::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)
            // ->addColumn('user_id', function ($data) {
            //     return $data->User ? $data->User->name : '';
            // })
            // ->addColumn('contact_category_id', function ($data) {
            //     return $data->ContactCategory ? $data->ContactCategory->name : '';
            // })
            // ->addColumn('district_id', function ($data) {
            //     if (session()->get('locale') == 'bn') {
            //         return $data->District ? $data->District->bn_name : '';
            //     } else {
            //         return $data->District ? $data->District->name : '';
            //     }
            // })
            // ->addColumn('upazilla_id', function ($data) {
            //     if (session()->get('locale') == 'bn') {
            //         return $data->Upazila ? $data->Upazila->bn_name : '';
            //     } else {
            //         return $data->Upazila ? $data->Upazila->name : '';
            //     }
            // })
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';



                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-info btn-sm tableEdit"><i class="fa fa-edit"></i></a>';



                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';



                return $htmlData;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function TeamInsert(Request $request)
    {



        if ($request->has('delete')) {
            $query = Team::find($request->delete);
            $user = User::where('id', $query->user_id)->first();

            if ($user) {
                $user->delete();
            }
            $query->delete();

            $message = 'Team Member Deleted Successfully!';
        } else {
            $request->validate([

                'name' => 'required',
                'fees' => 'required',
                'phone' => ['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/'],
                'email' => 'required',
            ]);

            $message = 'Team Member Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = Team::find($request->id);
                    $message = 'Team MemberUpdated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new Team();


                    $User = User::where('id', $query->chart_of_account_id)->firstOrNew();
                    $User->name = $request->name;
                    $User->email = $request->email;
                    $User->phone = $request->phone;

                    $User->added_by = Auth::id();
                    $User->password = Hash::make($request->password);
                    $User->type = 'team';
                    $User->assignRole('team');
                    $User->save();

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
                    Mail::to($request->email)->send(new DemoMail($mailData, $dynamicSubject));
                }

                $query->name = $request->name;
                $query->details = $request->details;
                $query->positions = $request->positions;
                $query->fees = $request->fees;
                $query->legal_area = implode(",", $request->legal_area_id);
                $query->sub_legal_area = $request->sub_legal_area;

                $query->phone = $request->phone;
                $query->email = $request->email;
                $query->status = $request->status;
                $query->details = $request->details;
                $query->facebook = $request->facebook;
                $query->twitter = $request->twitter;
                $query->linkedin = $request->linkedin;
                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/team' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/team'),  $filenamefavicon);

                    $query->image = 'image/team/' . $filenamefavicon;
                }

                $query->save();


                DB::commit();
            } catch (\Exception $e) {
                DB::rollback(); //Transaction rollback

                return response()->json([
                    'status' => 'error',
                    'message' => 'Server Error' . json_encode($e->errorInfo),
                ], 422);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,

        ]);
    }
    public function TeamEditData(Request $request)
    {
        $query = Team::find($request->id);

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not Found, Please Try Again...',
            ], 422);
        }
        $legalAreas = LegalArea::whereIn('id', explode(',', $query->legal_area))->get(['id', 'name']);
        return response()->json([
            'status' => 'success',
            'data' => $query,
            'legal_areas' => $legalAreas,
        ]);
    }
}
