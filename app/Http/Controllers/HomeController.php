<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class HomeController extends Controller
{
     public function Dashboard(Request $request)
    {

            $user = auth()->user();

            //dd($user);
            // Start with base query
            $query = Appointment::query()->with(['employee.user', 'user']);

            // Only admins can see all data - no conditions added
            if (!$user->hasRole('admin')) {
                $query->where(function ($q) use ($user) {
                    if ($user->employee) {
                        $q->where('employee_id', $user->employee->id);
                    }
                    $q->orWhere('user_id', $user->id);
                });
            }

            // Format the appointments with proper date handling
            $appointments = $query->get()->map(function ($appointment) {
                try {
                    if (!str_contains($appointment->booking_time ?? '', '-')) {
                        throw new \Exception("Invalid time format");
                    }

                    // Parse booking date
                    $bookingDate = Carbon::parse($appointment->booking_date);

                    // Parse start and end times
                    [$startTime, $endTime] = array_map('trim', explode('-', $appointment->booking_time));

                    // Create proper datetime objects
                    $startDateTime = Carbon::createFromFormat('h:i A', $startTime)
                        ->setDate($bookingDate->year, $bookingDate->month, $bookingDate->day);

                    $endDateTime = Carbon::createFromFormat('h:i A', $endTime)
                        ->setDate($bookingDate->year, $bookingDate->month, $bookingDate->day);

                    // Handle overnight appointments (if end time is next day)
                    if ($endDateTime->lt($startDateTime)) {
                        $endDateTime->addDay();
                    }

                    return [
                        'id' => $appointment->id, // Add appointment ID
                        'title' => sprintf(
                            '%s - %s',
                            $appointment->name,
                            $appointment->service->title ?? 'Service'
                        ),
                        'start' => $startDateTime->toIso8601String(),
                        'end' => $endDateTime->toIso8601String(),
                        'description' => $appointment->notes,
                        'email' => $appointment->email,
                        'phone' => $appointment->phone,
                        'amount' => $appointment->amount,
                        'status' => $appointment->status,
                        'staff' => $appointment->employee->user->name ?? 'Unassigned',
                        'color' => $this->getStatusColor($appointment->status),
                        'service_title' => 'Service', // Add service title
                        'name' => $appointment->name, // Add client name
                        'notes' => $appointment->notes, // Add notes
                    ];
                } catch (\Exception $e) {
                    \Log::error("Format error for appointment {$appointment->id}: {$e->getMessage()}");
                    return null;
                }
            })->filter();
     
        //     return view('backend.dashboard.index', compact('appointments'));
        // }
        return view('backend.admin_dashboard', compact('appointments'));
    }
    private function getStatusColor($status)
    {
        $colors = [
            'Pending payment' => '#f39c12',
            'Processing' => '#3498db',
            'Confirmed' => '#2ecc71',
            'Cancelled' => '#ff0000',
            'Completed' => '#008000',
            'On Hold' => '#95a5a6',
            'Rescheduled' => '#f1c40f',
            'No Show' => '#e67e22',
        ];

        return $colors[$status] ?? '#7f8c8d';
    }
     public function UserDashboard(Request $request)
    {
        return view('backend.user_dashboard');
    }
}
