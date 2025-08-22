<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function Banner()
    {
        return view('backend.banner',);
    }
    public function BannerData(Request $request)
    {

        $accounts_customer_accounts = Banner::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('description', function ($data) {
                return Str::limit($data->description ,100);
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-info btn-sm tableEdit"><i class="fa fa-edit"></i></a>';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';
                return $htmlData;
            })
            ->rawColumns(['description','action'])
            ->toJson();
    }
    public function BannerInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = Banner::find($request->delete);

            $query->delete();

            $message = 'Banner Deleted Successfully!';
        } else {

            if ($request->has('id')) {
                $request->validate([
                    'icon' => 'required',
                    'name' => 'required',
                ]);
            } else {
                $request->validate([
                    'icon' => 'required',
                    'name' => 'required',

                    'image' => 'required',
                ]);
            }

            $message = 'Banner  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = Banner::find($request->id);
                    $message = 'Banner Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new Banner();

                }

                $query->title = $request->title;
                $query->name = $request->name;
                $query->sub_title = $request->sub_title;
                $query->description = $request->description;
                $query->status = $request->status;
                $query->icon = $request->icon;

                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/Banner' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/Banner'),  $filenamefavicon);

                    $query->image = 'image/Banner/' . $filenamefavicon;
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
    public function BannerEditData(Request $request)
    {
        $query = Banner::find($request->id);

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
