<?php

namespace App\Http\Controllers;

use App\Models\LawCategory;
use App\Models\LegalArea;
use App\Models\SubLegalArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class LegalAreaController extends Controller
{
    public function LegalArea()
    {
        $lawCategories = LawCategory::where('status','Active')->get();
        return view('backend.lega_area',compact('lawCategories'));
    }
    public function LegalAreaData(Request $request)
    {

        $accounts_customer_accounts = LegalArea::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('description', function ($data) {
                return Str::limit($data->description, 100);
            })
            ->addColumn('law_category', function ($data) {
                return $data->lawCategory ? $data->lawCategory->name : '';
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
    public function LegalAreaInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = LegalArea::find($request->delete);

            $query->delete();

            $message = 'LegalArea  Deleted Successfully!';
        } else {
            if ($request->has('id')) {
                $request->validate([

                    'name' => 'required',
                    'law_category_id' => 'required',
                    'icon' => 'required',
                ]);
            } else {
                $request->validate([
                    'name' => 'required',
                    'law_category_id' => 'required',
                    'icon' => 'required',
                    'image' => 'required',
                ]);
            }


            $message = 'LegalArea  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = LegalArea::find($request->id);
                    $message = 'LegalArea Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new LegalArea();
                }

                $query->name = $request->name;
                $query->icon = $request->icon;

                $query->description = $request->description;
                $query->law_category_id = $request->law_category_id;
                $query->status = $request->status;
                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/LegalArea' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/LegalArea'),  $filenamefavicon);

                    $query->image = 'image/LegalArea/' . $filenamefavicon;
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
    public function LegalAreaEditData(Request $request)
    {
        $query = LegalArea::find($request->id);

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

    //sublegal
    public function SubLegalArea()
    {
        $leaglAreas = LegalArea::where('status', 'Active')->get();
        return view('backend.sub_lega_area', compact('leaglAreas'));
    }
    public function SubLegalAreaData(Request $request)
    {

        $SubLegalArea = SubLegalArea::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($SubLegalArea)

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
    public function SubLegalAreaInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = SubLegalArea::find($request->delete);

            $query->delete();

            $message = 'LegalArea  Deleted Successfully!';
        } else {
            if ($request->has('id')) {
                $request->validate([

                    'name' => 'required',
                    'icon' => 'required',
                ]);
            } else {
                $request->validate([
                    'image' => 'required',
                ]);
            }

            $message = 'LegalArea  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = SubLegalArea::find($request->id);
                    $message = 'LegalArea Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {

                    $query = new SubLegalArea();
                }

                $query->name = $request->name;
                $query->icon = $request->icon;

                $query->description = $request->description;
                $query->status = $request->status;
                $query->legal_area_id = $request->legal_area_id;
                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/LegalArea' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/LegalArea'),  $filenamefavicon);

                    $query->image = 'image/LegalArea/' . $filenamefavicon;
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
    public function SubLegalAreaEditData(Request $request)
    {
        $query = SubLegalArea::find($request->id);

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
    public function LegalAreaSearch(Request $request)
    {
        if (!isset($request['searchTerm'])) {
            $defaultdata = LegalArea::where('status', 'Active')->limit(5)->orderBy('id', 'desc')->get();
            $json = [];
            foreach ($defaultdata as $key => $index) {
                $json[] = ['id' => $index->id, 'text' => $index->name];
            }
        } else {
            $search = $request['searchTerm'];
            $result = LegalArea::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->limit(30)->get();
            $json = [];
            foreach ($result as $key => $index) {
                $json[] = ['id' => $index->id, 'text' => $index->name];
            }
        }
        return json_encode($json);
    }
    public function SubLegalAreaSearch(Request $request)
    {
        if (!isset($request['searchTerm'])) {
            $defaultdata = SubLegalArea::where('status', 'Active')->limit(5)->orderBy('id', 'desc')->get();
            $json = [];
            foreach ($defaultdata as $key => $index) {
                $json[] = ['id' => $index->id, 'text' => $index->name];
            }
        } else {
            $search = $request['searchTerm'];
            $result = SubLegalArea::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->limit(30)->get();
            $json = [];
            foreach ($result as $key => $index) {
                $json[] = ['id' => $index->id, 'text' => $index->name];
            }
        }
        return json_encode($json);
    }
}
