<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    public function UserAppointment()
    {
        if (Auth::user()->hasAnyRole('user')) {
        $appointments = Appointment::with('employee')->where('user_id', Auth::user()->id)->latest()->get();
        }
        else{
            $appointments = Appointment::with('employee')->latest()->get();
        }
        return view('backend.user.my_appointment',compact('appointments'));
    }
    public function UserAppointmentData(Request $request)
    {

        $accounts_customer_accounts = Appointment::with('payment')->where('user_id', Auth::user()->id)->orderBy('id', 'desc');

        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('consultant', function ($data) {
                return $data->employee->name;
            })
            ->addColumn('date', function ($data) {
                return $data->booking_date . ' -time- ' . $data->booking_time;
            })
            ->addColumn('payment_date', function ($data) {
                return $data->payment ? $data->payment->payment_date : 'N/A' ;
            })
            ->addColumn('payer_number', function ($data) {
                return $data->number;
            })
            ->addColumn('trx_id', function ($data) {
                return $data->trx_id;
            })
            ->addColumn('amount', function ($data) {
                return $data->amount;
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
        data-id="' . $data->id . '"
        data-name="' . $data->name . '"
        data-email="' . $data->email . '"
        data-phone="' . $data->phone . '"
        data-employee="' . ($data->employee->user->name ?? '') . '"
        data-start="' . $data->booking_date . ' ' . $data->booking_time . '"
        data-amount="' . $data->amount . '"
        data-notes="' . $data->notes . '"
        data-status="' . $data->status . '">
        View
    </button> ';
                $htmlData .= ' <a href="' . route('pdf.download', $data->id) . '"class="btn btn-info btn-sm py-0 px-1">Invoice</a>';
                return $htmlData;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
