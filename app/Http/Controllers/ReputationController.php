<?php

namespace App\Http\Controllers;

use App\Models\Reputation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class ReputationController extends Controller
{
    public function Reputation()
    {
        return view('backend.reputation',);
    }
    public function ReputationData(Request $request)
    {

        $accounts_customer_accounts = Reputation::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('legal_area', function ($data) {
                return $data->LegalArea ? $data->LegalArea->name : '';
            })
            ->addColumn('description', function ($data) {
                return Str::limit($data->description, 100);
            })
            ->addColumn('law_details', function ($data) {
                return Str::limit($data->law_details, 100);
            })


            ->addColumn('action', function ($data) {
                $htmlData = '';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-info btn-sm tableEdit"><i class="fa fa-edit"></i></a>';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';
                return $htmlData;
            })
            ->rawColumns(['description', 'law_details','action'])
            ->toJson();
    }
    public function ReputationInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = Reputation::find($request->delete);

            $query->delete();

            $message = 'Reputation Deleted Successfully!';
        } else {

            if ($request->has('id')) {
                $request->validate([
                    'title' => 'required',
                    'name' => 'required',
                    'description' => 'required',
                    'law_details' => 'required',
                    'legal_area_id' => 'required',
                    'icon' => 'required',
                ]);
            } else {
                $request->validate(['title' => 'required',
                    'name' => 'required',
                    'description' => 'required',
                    'law_details' => 'required',
                    'legal_area_id' => 'required',
                    'icon' => 'required',
                    'image' => 'required',
                ]);
            }

            $message = 'Reputation  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = Reputation::find($request->id);
                    $message = 'Reputation Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new Reputation();
                }

                $query->title = $request->title;
                $query->name = $request->name;
                $query->description = $request->description;
                $query->icon = $request->icon;
                $query->law_details = $request->law_details;
                $query->status = $request->status;
                $query->legal_area_id = $request->legal_area_id;

                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/Reputation' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/Reputation'),  $filenamefavicon);

                    $query->image = 'image/Reputation/' . $filenamefavicon;
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
    public function ReputationEditData(Request $request)
    {
        $query = Reputation::find($request->id);

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
