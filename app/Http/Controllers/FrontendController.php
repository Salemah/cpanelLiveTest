<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Appointment;
use App\Models\Article;
use App\Models\Banner;
use App\Models\CompanySetting;
use App\Models\ContactUs;
use App\Models\Experience;
use App\Models\FaqCategory;
use App\Models\LawCategory;
use App\Models\LegalArea;
use App\Models\Reputation;
use App\Models\Slot;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\OpeningHours\OpeningHours;


class FrontendController extends Controller
{
    public function Home(Request $request)
    {
        $banners = Banner::where('status', 'Active')->get();
        $Reputations = Reputation::where('status', 'Active')->get();
        $Experiences = Experience::where('status', 'Active')->get();
        $Testimonials = Testimonial::where('status', 'Active')->get();
        $LegalAreas = LegalArea::where('status', 'Active')->take(12)->get()->chunk(4);
        $Teams = Team::where('status', 'Active')->get();
        $Articles = Article::where('status', 'Active')->take(3)->get();

        $categories = LawCategory::with('LegalArea')->get();
        //dd($categories->shift()->LegalArea);
        $firstCategory = $categories->shift(); // This will remove and return the first category
        $remainingCategories = $categories;
        return view('frontend.home', compact('banners', 'Reputations', 'Experiences', 'Testimonials', 'LegalAreas', 'Teams', 'Articles', 'firstCategory', 'remainingCategories'));
    }
    public function AboutUs(Request $request)
    {
        return view('frontend.about_us', [
            'Teams' => Team::where('status', 'Active')->get(),
            'abouts' => AboutUs::where('status', 'Active')->first(),
            'Experiences' => Experience::where('status', 'Active')->get(),
        ]);
    }
    public function OurTeam(Request $request)
    {
        return view('frontend.our_team', [
            'teams' => Team::where('status', 'Active')->get(),
        ]);
    }
    public function TeamDetails(Request $request)
    {

        $categories = LegalArea::get();

        $employees = Team::get();
        $team = Team::find($request->id);
        $Setting = CompanySetting::first();

        return view('frontend.team_details', compact('categories', 'Setting', 'employees', 'team'));

    }
    public function getEmployeeAvailability(Team $employee, $date = null)
    {
        // Use current date if not provided
        $date = $date ? Carbon::parse($date) : now();

        // Validate slot duration exists
        if (!$employee->slot_duration) {
            return response()->json(['error' => 'Slot duration not set for this employee'], 400);
        }

        // dd($employee);
        try {
            // Function to ensure proper time formatting
            function formatTimeRange($timeRange)
            {
                // Handle appointment format (e.g., "06:00 AM - 06:30 AM")
                if (str_contains($timeRange, 'AM') || str_contains($timeRange, 'PM')) {
                    $timeRange = str_replace([' AM', ' PM', ' '], '', $timeRange);
                }

                $times = explode('-', $timeRange);
                $formattedTimes = array_map(function ($time) {
                    $parts = explode(':', $time);
                    $hours = str_pad(trim($parts[0]), 2, '0', STR_PAD_LEFT);
                    return $hours . ':' . $parts[1];
                }, $times);

                return implode('-', $formattedTimes);
            }

            // Process holidays expections
            $holidaysExceptions = $employee->holidays->mapWithKeys(function ($holiday) {
                $hours = !empty($holiday->hours)
                    ? collect($holiday->hours)->map(function ($timeRange) {
                        return formatTimeRange($timeRange);
                    })->toArray()
                    : [];

                return [$holiday->date => $hours];
            })->toArray();

            $employeeDays = json_decode($employee->days, true);
            // using spatie opening hours package to process data and expections
            $openingHours = OpeningHours::create(array_merge(
                $employeeDays,
                ['exceptions' => $holidaysExceptions]
            ));
           // dd($openingHours);
            // Get available time ranges for the requested date
            $availableRanges = $openingHours->forDate($date);

            // If no availability for this date
            if ($availableRanges->isEmpty()) {
                return response()->json(['available_slots' => []]);
            }

            // Generate time slots - NOW PASSING THE EMPLOYEE ID
            $slots = $this->generateTimeSlots(
                $availableRanges,
                $employee->slot_duration,
                $employee->break_duration ?? 0,
                $date,
                $employee->id  // This is the crucial addition
            );

            return response()->json([
                'employee_id' => $employee->id,
                'date' => $date->toDateString(),
                'available_slots' => $slots,
                'slot_duration' => $employee->slot_duration,
                'break_duration' => $employee->break_duration,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error processing availability: ' . $e->getMessage()], 500);
        }
    }
    public function Faq(Request $request)
    {
        $categories = FaqCategory::with('faqs')->get();

        $firstCategory = $categories->shift(); // This will remove and return the first category


        $remainingCategories = $categories;
        return view('frontend.faq', [
            'firstCategory' => $firstCategory,
            'remainingCategories' => $remainingCategories,

        ]);
    }
    public function Articles(Request $request)
    {

        return view('frontend.articles', [
            'Articles' => Article::where('status', 'Active')->paginate(12),
        ]);
    }
    public function ArticlesByLegalArea(Request $request)
    {
        $Articles = Article::where('status', 'Active')->whereRaw('FIND_IN_SET(?, legal_area_id)', [(int)$request->id])->paginate(12);
        return view('frontend.articles', compact('Articles'));
    }
    public function ArticlesByTag(Request $request)
    {
        $Articles = Article::where('status', 'Active')->where('tag_id', (int)$request->id)->paginate(12);
        return view('frontend.articles', compact('Articles'));
    }
    public function ContactUs(Request $request)
    {
        return view('frontend.contact_us', [
            'ContactUs' => ContactUs::where('status', 'Active')->get(),
        ]);
    }
    public function MakeAppointment(Request $request)
    {
        return view('frontend.make_appointment', [
            'ContactUs' => ContactUs::where('status', 'Active')->get(),
        ]);
    }
    function SlotGet(Request $request)
    {
        if ($request->ajax()) {
            if ($request->date) {
                $date =   Carbon::parse($request->date)->dayName;
                $slots = Slot::where('day', $date)->get();

            } else {
                $slots = [];
            }

            return view('frontend.slot_data', compact('slots'))->render();
        }
    }
    public function practiceArea(Request $request)
    {
        if ($request->id) {
            $LegalAreas = LegalArea::where('status', 'Active')->where('law_category_id', $request->id)->paginate(12);
        }
        else{
            $LegalAreas = LegalArea::where('status', 'Active')->paginate(12);
        }

        return view('frontend.practice_area', compact('LegalAreas'));
    }
    public function ArticlesDetails(Request $request)
    {
        $article = Article::find($request->id);
        $articles = Article::where('status', 'Active')->latest()->take(6)->get();
        $tags = Tag::whereIn('id', explode(',', $article->tag_id))->get(['id', 'name']);
        return view('frontend.article_details', compact('article', 'tags', 'articles'));
    }
    protected function generateTimeSlots($availableRanges, $slotDuration, $breakDuration, $date, $employeeId)
    {
        $slots = [];
        $now = now();
        $isToday = $date->isToday();

        // Get existing appointments for this date and employee
        $existingAppointments = Appointment::where('booking_date', $date->toDateString())
            ->where('team_id', $employeeId)
            ->whereNotIn('status', ['Cancelled']) // Exclude cancelled/ here could add more status to make expection
            ->get(['booking_time']);

        // Convert existing appointments to time ranges we can compare against
        $bookedSlots = $existingAppointments->map(function ($appointment) {
            $times = explode(' - ', $appointment->booking_time);
            return [
                'start' => Carbon::createFromFormat('g:i A', trim($times[0]))->format('H:i'),
                'end' => Carbon::createFromFormat('g:i A', trim($times[1]))->format('H:i')
            ];
        })->toArray();

        foreach ($availableRanges as $range) {
            $start = Carbon::parse($date->toDateString() . ' ' . $range->start()->format('H:i'));
            $end = Carbon::parse($date->toDateString() . ' ' . $range->end()->format('H:i'));

            // Skip if the entire range is in the past (only for today)
            if ($isToday && $end->lte($now)) {
                continue;
            }

            $currentSlotStart = clone $start;

            // If today and current slot start is in the past, adjust to current time
            if ($isToday && $currentSlotStart->lt($now)) {
                $currentSlotStart = clone $now;

                // Round up to nearest slot interval
                $minutes = $currentSlotStart->minute;
                $remainder = $minutes % $slotDuration;
                if ($remainder > 0) {
                    $currentSlotStart->addMinutes($slotDuration - $remainder)->second(0);
                }
            }

            while ($currentSlotStart->copy()->addMinutes($slotDuration)->lte($end)) {
                $slotEnd = $currentSlotStart->copy()->addMinutes($slotDuration);

                // Check if this slot conflicts with any existing booking
                $isAvailable = true;
                foreach ($bookedSlots as $bookedSlot) {
                    $bookedStart = Carbon::parse($date->toDateString() . ' ' . $bookedSlot['start']);
                    $bookedEnd = Carbon::parse($date->toDateString() . ' ' . $bookedSlot['end']);

                    if ($currentSlotStart->lt($bookedEnd) && $slotEnd->gt($bookedStart)) {
                        $isAvailable = false;
                        break;
                    }
                }

                // Only add slots that are available and in the future (for today)
                if ($isAvailable && (!$isToday || $slotEnd->gt($now))) {
                    $slots[] = [
                        'start' => $currentSlotStart->format('H:i'),
                        'end' => $slotEnd->format('H:i'),
                        'display' => $currentSlotStart->format('g:i A') . ' - ' . $slotEnd->format('g:i A'),
                    ];
                }

                // Add break duration if specified
                $currentSlotStart->addMinutes($slotDuration + $breakDuration);

                // Check if next slot would exceed end time
                if ($currentSlotStart->copy()->addMinutes($slotDuration)->gt($end)) {
                    break;
                }
            }
        }

        return $slots;
    }
    public function getEmployees(Request $request, Service $service)
    {
        $employees = $service->employees()
            ->whereHas('user', function ($query) {
                $query->where('status', 1);
            })
            ->with('user') // Eager load user details
            ->get();

        if ($employees->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No employees available for this service'
            ]);
        }

        return response()->json([
            'success' => true,
            'employees' => $employees,
            'service' => $service
        ]);
    }
}
