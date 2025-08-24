<?php

namespace App\Http\Controllers;

use App\Models\PaymentReceive;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentReceiveController extends Controller
{
    public function index()
    {

        return view('backend.payment_receive');
    }
    public function PaymentReceiveData(Request $request)
    {

        $accounts_customer_accounts = PaymentReceive::with('appointment')->orderBy('id', 'desc');

        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('name', function ($data) {
                return $data->appointment->name;
            })
            ->addColumn('team', function ($data) {
                return $data->appointment->employee->name;
            })
            ->addColumn('date', function ($data) {
                return $data->appointment->booking_date .'time'. $data->appointment->booking_time;
            })
            ->addColumn('amount', function ($data) {
                return $data->appointment->amount;
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';
            $htmlData .= ' <a href="' . route('pdf.download', $data->appointment->id) . '"class="btn btn-info btn-sm py-0 px-1">Invoice</a>';
                return $htmlData;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
