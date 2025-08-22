<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ContactUsController extends Controller
{
    public function ContactUs()
    {
        return view('backend.contact_us',);
    }
    public function ContactUsData(Request $request)
    {

        $accounts_customer_accounts = ContactUs::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('description', function ($data) {
                return Str::limit($data->description, 50);
            })
            ->addColumn('address', function ($data) {
                return Str::limit($data->address, 50);
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
    public function ContactUsInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = ContactUs::find($request->delete);

            $query->delete();

            $message = 'ContactUs Deleted Successfully!';
        } else {

            if ($request->has('id')) {
                $request->validate([
                    'office' => 'required',
                    'address' => 'required',
                    'phone' =>['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/'],
                    'email' => 'required',
                ]);
            } else {
                $request->validate([
                    'office' => 'required',
                    'address' => 'required',
                    'phone' =>['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/'],
                    'email' => 'required',
                    'image' => 'required',
                ]);
            }

            $message = 'ContactUs  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = ContactUs::find($request->id);
                    $message = 'ContactUs Updated Successfully!';

                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new ContactUs();
                }

                $query->office = $request->office;
                $query->address = $request->address;
                $query->phone = $request->phone;
                $query->email = $request->email;
                $query->status = $request->status;

                $query->added_by = Auth::id();

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/ContactUs' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/ContactUs'),  $filenamefavicon);

                    $query->image = 'image/ContactUs/' . $filenamefavicon;
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
    public function ContactUsEditData(Request $request)
    {
        $query = ContactUs::find($request->id);

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
