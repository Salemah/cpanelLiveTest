<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    public function Faq()
    {
        return view('backend.faq',);
    }
    public function FaqData(Request $request)
    {

        $accounts_customer_accounts = Faq::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('category', function ($data) {
                return $data->FaqCategory? $data->FaqCategory->name : '';
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
    public function FaqInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = Faq::find($request->delete);

            $query->delete();

            $message = 'Faq Deleted Successfully!';
        } else {


            $request->validate([
                'question' => 'required',
                'answer' => 'required',
                'faq_category' => 'required',
            ]);

            $message = 'Faq  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = Faq::find($request->id);
                    $message = 'Faq Updated Successfully!';

                    $query->updated_by = Auth::id();
                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new Faq();
                }

                $query->question = $request->question;
                $query->answer = $request->answer;
                $query->faq_category = $request->faq_category;
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
    public function FaqEditData(Request $request)
    {
        $query = Faq::find($request->id);

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
