<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SlotController extends Controller
{
    public function Slot()
    {
        $teams = Team::orderBy('id', 'desc')->where('status', 'Active')->get();
        return view('backend.slot', compact('teams'));
    }
    public function SlotData(Request $request)
    {

        $accounts_customer_accounts = Slot::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('team', function ($data) {
                return $data->Team ? $data->Team->name : '';
            })
            ->addColumn('time', function ($data) {
                return Carbon::parse($data->from_time)->format('g:i A');
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-info btn-sm tableEdit"><i class="fa fa-edit"></i></a>';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';
                return $htmlData;
            })
            ->rawColumns(['description', 'law_details', 'action'])
            ->toJson();
    }
    public function SlotInsert(Request $request)
    {


        if ($request->has('delete')) {
            $query = Slot::find($request->delete);

            $query->delete();

            $message = 'Slot Deleted Successfully!';
        } else {




            $request->validate([
                'team_id'            =>      'required',
                // 'from_time'            =>      'required',

            ]);

            try {

                if ($request->has('id')) {
                    $query = Slot::find($request->id);
                    $message = 'Slot Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                    $query->from_time = $request->from_time;
                    $query->updated_by = Auth::id();
                    $query->save();
                } else {


                    $message = 'Save Successfully!';
                    if (!empty($request->from_time_saturday)) {
                        foreach ($request->from_time_saturday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Saturday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                    if (!empty($request->from_time_sunday)) {
                        foreach ($request->from_time_sunday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Sunday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                    if (!empty($request->from_time_monday)) {
                        foreach ($request->from_time_monday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Monday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                    if (!empty($request->from_time_tuesday)) {
                        foreach ($request->from_time_tuesday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Tuesday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                    if (!empty($request->from_time_wednesday)) {
                        foreach ($request->from_time_wednesday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Wednesday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                    if (!empty($request->from_time_thursday)) {
                        foreach ($request->from_time_thursday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Thursday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                    if (!empty($request->from_time_friday)) {
                        foreach ($request->from_time_friday as $key => $day) {
                            if (!is_null($day) && $day !== '') {
                                $List = new Slot();
                                $List->team_id = $request->team_id;

                                $List->added_by = Auth::id();
                                $List->day = 'Friday';
                                $List->from_time = $day;
                                $List->save();
                            }
                        }
                    }
                }
            } catch (\Exception $exception) {
                return redirect()->back()->with('error', $exception->getMessage());
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => $message,

        ]);
    }
    public function SlotEditData(Request $request)
    {
        $query = Slot::find($request->id);

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not Found, Please Try Again...',
            ], 422);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query,
            'legal_area_name' => $query->LegalArea ? $query->LegalArea->name : '',
        ]);
    }
}
