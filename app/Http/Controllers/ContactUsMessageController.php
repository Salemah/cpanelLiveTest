<?php

namespace App\Http\Controllers;

use App\Models\ContactUsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class ContactUsMessageController extends Controller
{
    public function ContactUsMessage()
    {
        return view('backend.contact_us_message_list',);
    }
    public function ContactUsMessageData(Request $request)
    {

        $accounts_customer_accounts = ContactUsMessage::orderBy('id', 'desc');


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
            ->setRowClass(function ($data) {
                if ($data->status == 'Replied') {
                    return 'table-success';
                } else if ($data->status == 'Inactive') {
                    return 'table-warning';
                }
            })

            ->rawColumns(['action'])
            ->toJson();
    }
    public function ContactUsMessageInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = ContactUsMessage::find($request->delete);

            $query->delete();

            $message = 'ContactUsMessage Deleted Successfully!';
        } else {
            $request->validate([
                'message' => 'required',
                'phone'   => 'required|digits_between:10,15',
                'email'   => 'required|email',
                'name'    => 'required',
            ]);


            $message = 'ContactUvsvMessage  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = ContactUsMessage::find($request->id);
                    $message = 'ContactUsMessage Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new ContactUsMessage();
                }
                $query->name = $request->name;
                $query->message = $request->message;
                $query->phone = $request->phone;
                $query->email = $request->email;
                $query->status = $request->status;


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
        return response()->json(['success' => true]);

        // return redirect()->route('frontend.contact')->with('message', 'Your message has been sent successfully.');
    }
    public function ContactUsMessageEditData(Request $request)
    {
        $query = ContactUsMessage::find($request->id);

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
