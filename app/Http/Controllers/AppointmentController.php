<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Events\StatusUpdated;
use App\Mail\Appointmail;
use App\Mail\DemoMail;
use App\Mail\InvoiceMail;
use App\Models\Appointment;
use App\Models\BkashPaymentSubmit;
use App\Models\CompanySetting;
use App\Models\PaymentReceive;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'team_id' => 'required|exists:teams,id',

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
            'amount' => 'required|numeric',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'status' => 'required|string',
        ]);

        // Set user_id if not provided but user is authenticated
        // if (auth()->check() && !$request->has('user_id')) {
        //     $validated['user_id'] = auth()->id();
        // }

        $isPrivilegedRole = auth()->check() && (
            auth()->user()->hasRole('admin') ||
            auth()->user()->hasRole('moderator') ||
            auth()->user()->hasRole('employee')
        );

        // If admin/moderator/employee is booking, user_id should be null
        if ($isPrivilegedRole) {
            $validated['user_id'] = null;
        } elseif (auth()->check() && !$request->has('user_id')) {
            // Otherwise, assign user_id to the authenticated user
            $validated['user_id'] = auth()->id();
        }


        // Generate unique booking ID
        // $validated['booking_id'] = 'BK-' . strtoupper(uniqid());
        $validated['booking_id'] = $this->generateBookingId();

        $appointment = Appointment::create($validated);
        $Setting = CompanySetting::first();
        $mailData = [
            'logo' => $Setting->logo,
            'title' => $Setting->title,
            'website' => $Setting->website,
            'facebook' => $Setting->facebook,
            'instagram' => $Setting->instagram,
            'Setting' => $Setting,

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'amount' => $request->amount,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'team_id' => $appointment->employee->name,

        ];

        $dynamicSubject = $Setting->title . ' - Welcome ' . $request->name;

        Mail::to($request->email)->send(new Appointmail($mailData, $dynamicSubject));

        // invoice mail send
        $appointment = $appointment;

        $data = [
            'logo' => $Setting->logo,
            'title' => $Setting->title,
            'appointment' => $appointment,
            'Setting' => $Setting,

        ];
        $datas["title"] = $Setting->title;

        $datas["appointment"] = $appointment;

        $datas["Setting"] = $Setting;

        $pdf = Pdf::loadView('backend.appointment.invoicepdf', $datas);

        $dynamicSubject = $Setting->title . ' - Booking Invoice ' . $request->name;
        Mail::to($request->email)->send(new InvoiceMail($data, $dynamicSubject, $pdf));
        //invoice mail end


        event(new BookingCreated($appointment));

        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'booking_id' => $appointment->booking_id,
            'appointment' => $appointment,
            'appointment_id' => $appointment->id,
        ]);
    }

    private function generateBookingId()
    {
        do {
            // Example: BK-20250824-ABCD1234
            $bookingId = 'BK-' . random_int(10000000, 99999999);
        } while (Appointment::where('booking_id', $bookingId)->exists()); // Check uniqueness

        return $bookingId;
    }

    public function index()
    {
        $appointments = Appointment::with('employee')->latest()->get();
        //dd($appointments); // for debuggin'g only
        return view('backend.appointment.index', compact('appointments'));
    }
    public function PaymentInstruction(Request $request)
    {
        $Setting = CompanySetting::first();
        $appointment = Appointment::find($request->id);

        //dd($appointments); // for debuggin'g only
        return view('backend.appointment.payment_instruction', compact('appointment', 'Setting'));
    }


    public function updateStatus(Request $request)
    {

        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|string',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status = $request->status;
        $appointment->save();


        if ($request->status == 'Confirmed') {


            $paymentReceive = PaymentReceive::firstOrCreate(
                ['appointment_id' => $appointment->id], // only check this field
                [
                    'amount' => $appointment->amount,                 // values to set if creating
                    'added_by' => Auth::id(),
                    'user_id' => $appointment->user_id,
                    'appointment_id' => $appointment->id,
                    'payment_date' => Carbon::now(),
                    'team_id' => $appointment->team_id,
                    'status' => $request->status,

                ]
            );
        }

        event(new StatusUpdated($appointment));

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
    public function PaymentUpdateStatus(Request $request)
    {

        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|string',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status = $request->status;
        $appointment->save();


        if ($request->status == 'Confirmed') {


            $paymentReceive = PaymentReceive::updateOrCreate(
                ['appointment_id' => $appointment->id], // only check this field
                [
                    'amount' => $appointment->amount,                 // values to set if creating
                    'added_by' => Auth::id(),
                    'user_id' => $appointment->user_id,
                    'appointment_id' => $appointment->id,
                    'payment_date' => Carbon::now(),
                    'team_id' => $appointment->team_id,
                    'status' => $request->status,

                ]
            );
        }

        event(new StatusUpdated($appointment));

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    public function DashboardUpdateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:Pending payment,Processing,Confirmed,Cancelled,Completed,On Hold,No Show'
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status = $request->status;
        $appointment->save();

        event(new StatusUpdated($appointment));

        return back()->with('success', 'Status updated successfully');
    }
    public function downloadPdf(Request $request)
    {
        $Setting = CompanySetting::first();
        $appointment = Appointment::findOrFail($request->id);
        $data = [

            'date'  => now()->toDateString(),
            'logo' => $Setting->logo,
            'title' => $Setting->title,
            'appointment' => $appointment,
            'Setting' => $Setting,

        ];
        return view('backend.appointment.invoice', compact('data'));
        $pdf = Pdf::loadView('backend.appointment.invoice', $data);

        return $pdf->download('appointments.pdf');
    }
    public function PaymentSubmit(Request $request)
    {

        // Validate inputs
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:1',
            'payer_number' => 'required|string|min:11|max:15',
            'trx_id' => 'required|string|max:50',
        ]);
        //dd($request->all());
        $appointment = Appointment::findOrFail($request->appointment_id);
        // Create new payment record
        PaymentReceive::create([
            'appointment_id' => $request->appointment_id,
            'amount' => $request->amount,
            'team_id' =>  $appointment->team_id,
            'payment_date' => now(),
            'number' => $request->payer_number,
            'trx_id' => $request->trx_id,
            'status' => 'Processing',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status = 'Processing';
        $appointment->save();

        event(new StatusUpdated($appointment));
        // Return JSON success + redirect route
        return response()->json([
            'success'  => true,
            'message'  => 'Payment submitted successfully.',
            'redirect' => route('pdf.download', $request->appointment_id) // 👉 create this route
        ]);
    }
}
