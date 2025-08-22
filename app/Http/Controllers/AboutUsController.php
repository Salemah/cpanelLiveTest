<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    public function AboutUs()
    {
        return view('backend.about_us',);
    }
    public function AboutUsData(Request $request)
    {

        $accounts_customer_accounts = AboutUs::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('description', function ($data) {
                return Str::limit($data->description, 100);
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-info btn-sm tableEdit"><i class="fa fa-edit"></i></a>';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';
                return $htmlData;
            })
            ->rawColumns(['description', 'action'])
            ->toJson();
    }
    public function AboutUsInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = AboutUs::find($request->delete);

            $query->delete();

            $message = 'AboutUs Deleted Successfully!';
        } else {

            if ($request->has('id')) {
                $request->validate([
                    'title' => 'required',
                    'name' => 'required',
                    'description' => 'required',

                ]);
            } else {
                $request->validate([
                    'title' => 'required',
                    'name' => 'required',
                    'description' => 'required',
                    'image' => 'required',
                    'image_two' => 'required',
                ]);
            }

            $message = 'AboutUs  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = AboutUs::find($request->id);
                    $message = 'AboutUs Updated Successfully!';
                    $query->updated_by = Auth::id();
                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new AboutUs();
                }

                $query->title = $request->title;
                $query->name = $request->name;
                $query->description = $request->description;
                $query->cases = $request->cases;
                $query->status = $request->status;

                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/AboutUs' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/AboutUs'),  $filenamefavicon);

                    $query->image = 'image/AboutUs/' . $filenamefavicon;
                }
                if ($request->file('image_two')) {
                    $file = $request->file('image_two');
                    $old_img = public_path('/image/AboutUs' . $request->image_two);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/AboutUs'),  $filenamefavicon);

                    $query->image_two = 'image/AboutUs/' . $filenamefavicon;
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
    public function AboutUsEditData(Request $request)
    {
        $query = AboutUs::find($request->id);

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not Found, Please Try Again...',
            ], 422);
        }

        return response()->json([
            'status' => 'success',
            'data' => $query,
        ]);
    }
}
