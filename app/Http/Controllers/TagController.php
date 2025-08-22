<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function Tag()
    {
        return view('backend.tags',);
    }
    public function TagData(Request $request)
    {

        $accounts_customer_accounts = Tag::orderBy('id', 'desc');


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
            ->rawColumns(['description', 'address', 'action'])
            ->toJson();
    }
    public function TagInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = Tag::find($request->delete);

            $query->delete();

            $message = 'Tag Deleted Successfully!';
        } else {


                $request->validate([
                    'name' => 'required',

                ]);


            $message = 'Tag  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = Tag::find($request->id);
                    $message = 'Tag Updated Successfully!';
                    $query->updated_by = Auth::id();
                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new Tag();
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
    public function TagEditData(Request $request)
    {
        $query = Tag::find($request->id);

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
    public function TagSearch(Request $request)
    {
        if (!isset($request['searchTerm'])) {
            $defaultdata = Tag::where('status', 'Active')->limit(5)->orderBy('id', 'desc')->get();
            $json = [];
            foreach ($defaultdata as $key => $index) {
                $json[] = ['id' => $index->id, 'text' => $index->name];
            }
        } else {
            $search = $request['searchTerm'];
            $result = Tag::where(function ($query) use ($search) {
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
