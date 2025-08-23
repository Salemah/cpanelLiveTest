<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\CompanySetting;
use App\Models\Holiday;
use App\Models\LegalArea;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class TeamController extends Controller
{
    public function TeamAccounts()
    {
        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];
        return view('backend.team_accounts', compact('days'));
    }
    public function TeamCreate()
    {
        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];
        return view('backend.team_create', compact('days'));
    }
    public function TeamData(Request $request)
    {

        $accounts_customer_accounts = Team::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)
            // ->addColumn('user_id', function ($data) {
            //     return $data->User ? $data->User->name : '';
            // })
            // ->addColumn('contact_category_id', function ($data) {
            //     return $data->ContactCategory ? $data->ContactCategory->name : '';
            // })
            // ->addColumn('district_id', function ($data) {
            //     if (session()->get('locale') == 'bn') {
            //         return $data->District ? $data->District->bn_name : '';
            //     } else {
            //         return $data->District ? $data->District->name : '';
            //     }
            // })
            // ->addColumn('upazilla_id', function ($data) {
            //     if (session()->get('locale') == 'bn') {
            //         return $data->Upazila ? $data->Upazila->bn_name : '';
            //     } else {
            //         return $data->Upazila ? $data->Upazila->name : '';
            //     }
            // })
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                $htmlData = '';



                $htmlData .= '<a href="' . route('admin.account.team.editnew', $data->user_id) . '" data-id="' . $data->user_id . '" class="btn btn-info btn-sm "><i class="fa fa-edit"></i></a>';



                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';



                return $htmlData;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function TeamInsert(Request $request)
    {

        // if ($request->has('delete')) {
        //     $query = Team::find($request->delete);
        //     $user = User::where('id', $query->user_id)->first();

        //     if ($user) {
        //         $user->delete();
        //     }
        //     $query->delete();

        //     $message = 'Team Member Deleted Successfully!';
        // } else {
        $request->validate([

            'name' => 'required',
            'fees' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $message = 'Team Member Create Successfully!';

        // try {
        //     DB::beginTransaction();

        //     if ($request->has('id')) {
        //         $query = Team::find($request->id);
        //         $message = 'Team MemberUpdated Successfully!';

        //         if (!$query) {
        //             return response()->json([
        //                 'status' => 'error',
        //                 'message' => 'Not Found, Please Try Again...',
        //             ], 422);
        //         }
        //     } else {
        $query = new Team();


        $User = User::where('id', $query->user_id)->firstOrNew();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->phone = $request->phone;

        $User->added_by = Auth::id();
        $User->password = Hash::make($request->password);
        $User->type = 'team';
        $User->assignRole('team');
        $User->save();

        $Setting = CompanySetting::first();

        $mailData = [
            'logo' => $Setting->logo,
            'title' => $Setting->title,
            'website' => $Setting->website,
            'facebook' => $Setting->facebook,
            'instagram' => $Setting->instagram,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ];
        $dynamicSubject = $Setting->title . ' - Welcome ' . $request->name;
        // dd($mailData);
         Mail::to($request->email)->send(new DemoMail($mailData, $dynamicSubject));
        // }

        $query->name = $request->name;
        $query->details = $request->details;
        $query->positions = $request->positions;
        $query->fees = $request->fees;
        $query->legal_area = implode(",", $request->legal_area_id);
        $query->sub_legal_area = $request->sub_legal_area;

        $query->phone = $request->phone;
        $query->email = $request->email;
        $query->status = $request->status;
        $query->details = $request->details;
        $query->facebook = $request->facebook;
        $query->twitter = $request->twitter;
        $query->linkedin = $request->linkedin;
        $query->added_by = Auth::id();
        $query->user_id = $User['id'];


        $transformedData = $this->transformOpeningHours($request->days); // Use $this->transformOpeningHours
        $data['days'] = $transformedData;
        $query->days = json_encode($data['days']);
        $query->slot_duration = $request->slot_duration;
        $query->break_duration = $request->break_duration;


        if ($request->file('image')) {
            $file = $request->file('image');
            $old_img = public_path('/image/team' . $request->image);
            if (file_exists($old_img)) {
                @unlink($old_img);
            }
            $filenamefavicon = time() . $file->getClientOriginalName();
            $file->move(public_path('/image/team'),  $filenamefavicon);

            $query->image = 'image/team/' . $filenamefavicon;
        }


        $query->save();


        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback(); //Transaction rollback

        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Server Error' . json_encode($e->errorInfo),
        //     ], 422);
        // }
        // }

        // return response()->json([
        //     'status' => 'success',
        //     'message' => $message,

        // ]);
        return redirect()->back()->withSuccess('Team has been created successfully!');
    }
    public function TeamEdit(string $id)
    {

        // Available days of the week
        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday',
        ];

        // Available slot duration steps
        $steps = ['10', '15', '20', '30', '45', '60'];

        // Available break duration steps
        $breaks = ['5', '10', '15', '20', '25', '30'];

        // Get the user and the related employee data
        $user = User::with('employee.holidays')->findOrFail($id);

        //dd($user);

        // Get the employee's availability (days) data if it exists and convert to an array
        $employeeDays = $user->employee->days ?? [];

        $employeeDays = json_decode($employeeDays, true);

        //print_r($data);
        //dd($data);
        // Transform availability slots
        $employeeDays = $this->transformAvailabilitySlotsForEdit($employeeDays);

        //;

        // Get all roles excluding 'admin'
        $roles = Role::all();
        // $roles = Role::where('name', '!=', 'admin')->get();
        $legalareas = LegalArea::get();
        // Get all active services


        // Return the view with data
        return view('backend.team_edit', compact('user', 'roles', 'legalareas', 'days', 'steps', 'breaks', 'employeeDays'));
    }
    public function TeamUpdate(Request $request, User $user)
    {
        $user = User::find($request->user_id);
        // Validate request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $request->user_id,
            'password' => 'nullable|string|min:8',
            'break_duration' => 'nullable',
            'days' => 'nullable',
            'fees' => 'required',
            'holidays.date.*' => 'sometimes|required',
            'holidays.from_time' => 'nullable',
            'holidays.to_time' => 'nullable',
            'holidays.recurring' => 'nullable',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? $user->phone,
            'password' => $request->password ? \Hash::make($request->password) : $user->password,

        ]);
        if (!empty($data['days'])) {
            $data['days'] = $this->transformOpeningHours($data['days']);
        }
        $updateData = [
            'days'           => json_encode($data['days']) ?? null,
            'slot_duration'  => $request->slot_duration ?? null,
            'break_duration' => $request->break_duration ?? null,
            'name' => $request->name ?? null,
            'details' => $request->details ?? null,
            'positions' => $request->positions ?? null,
            'sub_legal_area' => $request->sub_legal_area ?? null,
            'phone' => $request->phone ?? null,
            'email' => $request->email ?? null,
            'status' => $request->status ?? null,
            'facebook' => $request->facebook ?? null,
            'twitter' => $request->twitter ?? null,
            'linkedin' => $request->linkedin ?? null,
            'legal_area' => implode(",", $request->legal_area_id),
        ];
        if ($request->file('image')) {
            $file = $request->file('image');
            $old_img = public_path('/image/team' . $request->image);
            if (file_exists($old_img)) {
                @unlink($old_img);
            }
            $filenamefavicon = time() . $file->getClientOriginalName();
            $file->move(public_path('/image/team'),  $filenamefavicon);

            $updateData['image'] = 'image/team/' . $filenamefavicon;
        }

        $employee = Team::updateOrCreate(
            ['user_id' => $user->id], // condition
            $updateData
        );
        if ($request->has('holidays.date') && is_array($request->input('holidays.date'))) {
            // Get all existing holiday IDs for this employee
            $existingHolidayIds = $user->employee->holidays->pluck('id')->toArray();
            $submittedHolidayIds = [];

            $dates = $request->input('holidays.date');
            $fromTimes = $request->input('holidays.from_time');
            $toTimes = $request->input('holidays.to_time');
            $recurring = $request->input('holidays.recurring');
            $holidayIds = $request->input('holidays.id', []); // Add hidden input for holiday IDs in your form

            foreach ($dates as $index => $date) {
                $holidayData = [
                    'team_id' => $user->employee->id,
                    'hours' => isset($fromTimes[$index]) && isset($toTimes[$index])
                        ? [$fromTimes[$index] . '-' . $toTimes[$index]]
                        : [],
                    'recurring' => isset($recurring[$index]) && $recurring[$index] == 1,
                ];

                // Handle date format based on recurring
                if ($holidayData['recurring']) {
                    $holidayData['date'] = \Carbon\Carbon::parse($date)->format('m-d');
                } else {
                    $holidayData['date'] = $date;
                }

                // Check if this is an existing holiday (has an ID)
                if (isset($holidayIds[$index])) {
                    $holiday = Holiday::find($holidayIds[$index]);
                    if ($holiday) {
                        $holiday->update($holidayData);
                        $submittedHolidayIds[] = $holiday->id;
                    }
                } else {
                    // Create new holiday
                    $holiday = Holiday::create($holidayData);
                    $submittedHolidayIds[] = $holiday->id;
                }
            }

            // Delete any holidays that weren't submitted in the form
            $holidaysToDelete = array_diff($existingHolidayIds, $submittedHolidayIds);
            if (!empty($holidaysToDelete)) {
                Holiday::whereIn('id', $holidaysToDelete)->delete();
            }
        } else {
            // If no holidays were submitted but there were existing ones, delete them all
            if ($user->employee->holidays()->exists()) {
                $user->employee->holidays()->delete();
            }
        }

        return redirect()->route('admin.account.team')->with('success', 'Profile has been updated successfully!');
    }
    protected function transformAvailabilitySlotsForEdit(array $employeeDays)
    {
        foreach ($employeeDays as $day => $slots) {
            $transformedSlots = [];
            foreach ($slots as $slot) {
                list($startTime, $endTime) = explode('-', $slot);
                $transformedSlots[] = $startTime;
                $transformedSlots[] = $endTime;
            }
            $employeeDays[$day] = $transformedSlots;
        }

        // dd($employeeDays);
        return $employeeDays;
    }

    // Transform the data
    function transformOpeningHours($data)
    {
        $result = [];

        foreach ($data as $day => $times) {
            $dayHours = [];
            for ($i = 0; $i < count($times); $i += 2) {
                if (isset($times[$i + 1])) {
                    $dayHours[] = $times[$i] . '-' . $times[$i + 1];
                }
            }
            $result[$day] = $dayHours;
        }

        return $result;
    }
    public function TeamEditData(Request $request)
    {
        $query = Team::find($request->id);

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not Found, Please Try Again...',
            ], 422);
        }
        $legalAreas = LegalArea::whereIn('id', explode(',', $query->legal_area))->get(['id', 'name']);
        return response()->json([
            'status' => 'success',
            'data' => $query,
            'legal_areas' => $legalAreas,
        ]);
    }
    public function TeamDestroy(Request $request)
    {
        $query = Team::find($request->id);

        if (!$query) {
            $query = Team::find($request->delete);
                $user = User::where('id', $query->user_id)->first();

                if ($user) {
                    $user->delete();
                }
                $query->delete();

        }

        return response()->json([
            'status' => 'success',

        ]);
    }
}
