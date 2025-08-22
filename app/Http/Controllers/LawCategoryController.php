<?php

namespace App\Http\Controllers;

use App\Models\LawCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LawCategoryController extends Controller
{
    public function LawCategory()
    {
        return view('backend.law_category',);
    }
    public function LawCategoryData(Request $request)
    {

        $accounts_customer_accounts = LawCategory::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

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
    public function LawCategoryInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = LawCategory::find($request->delete);

            $query->delete();

            $message = 'Law Category  Deleted Successfully!';
        } else {

                $request->validate([

                    'name' => 'required',

                ]);



            $message = 'Law Category  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = LawCategory::find($request->id);
                    $message = 'Law Category Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new LawCategory();
                }

                $query->name = $request->name;



                $query->status = $request->status;
                $query->added_by = Auth::id();



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
    public function LawCategoryEditData(Request $request)
    {
        $query = LawCategory::find($request->id);

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




    public function LawCategorySearch(Request $request)
    {
        if (!isset($request['searchTerm'])) {
            $defaultdata = LawCategory::where('status', 'Active')->limit(5)->orderBy('id', 'desc')->get();
            $json = [];
            foreach ($defaultdata as $key => $index) {
                $json[] = ['id' => $index->id, 'text' => $index->name];
            }
        } else {
            $search = $request['searchTerm'];
            $result = LawCategory::where(function ($query) use ($search) {
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
