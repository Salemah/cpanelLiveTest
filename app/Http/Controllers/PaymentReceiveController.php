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
                return $data->appointment->booking_date . ' -time- ' . $data->appointment->booking_time;
            })
            ->addColumn('payment_date', function ($data) {
                return $data->payment_date;
            })
            ->addColumn('payer_number', function ($data) {
                return $data->number;
            })
            ->addColumn('trx_id', function ($data) {
                return $data->trx_id;
            })
            ->addColumn('amount', function ($data) {
                return $data->appointment->amount;
            })
            ->addColumn('status', function ($data) {
                // Define status colors
                $statusColors = [
                    'Pending payment' => '#f39c12',
                    'Processing'      => '#3498db',
                    'Confirmed'       => '#2ecc71',
                    'Cancelled'       => '#ff0000',
                    'Completed'       => '#008000',
                    'On Hold'         => '#95a5a6',
                    'Rescheduled'     => '#f1c40f',
                    'No Show'         => '#e67e22',
                ];

                // Get color by status (default: gray)
                $color = $statusColors[$data->status] ?? '#7f8c8d';

                // Return badge with dynamic color
                return '<span class="badge px-2 py-1" style="background-color: ' . $color . '; color: #fff;">
                ' . $data->status . '
            </span>';
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';
                $htmlData .= '<button
        class="btn btn-primary btn-sm py-0 px-1 view-appointment-btn"
        data-bs-toggle="modal"
        data-bs-target="#appointmentModal"
        data-id="' . $data->appointment->id . '"
        data-name="' . $data->appointment->name . '"
        data-email="' . $data->appointment->email . '"
        data-phone="' . $data->appointment->phone . '"
        data-employee="' . ($data->appointment->employee->user->name ?? '') . '"
        data-start="' . $data->appointment->booking_date . ' ' . $data->appointment->booking_time . '"
        data-amount="' . $data->appointment->amount . '"
        data-notes="' . $data->appointment->notes . '"
        data-status="' . $data->appointment->status . '">
        View
    </button> ';
                $htmlData .= ' <a href="' . route('pdf.download', $data->appointment->id) . '"class="btn btn-info btn-sm py-0 px-1">Invoice</a>';
                return $htmlData;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
