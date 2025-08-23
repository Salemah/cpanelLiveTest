@extends('backend.layouts.backendapp')

@section('content')
    <div class="">
        <div class="">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header align-items-center justify-content-between d-flex">
                            <nav aria-label="breadcrumb" style="margin-top:-10px;">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Contact</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Team </li>
                                </ol>
                            </nav>
                            <a   class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;" href="{{ route('admin.account.team') }}"> Team List</a>

                            {{-- <button class="btn btn-primary btn-sm TeamAddButton" style="float: right;margin-top:-20px;"><i
                                    class="fa fa-plus"></i>Team</button> --}}
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{!! session()->get('success') !!}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-dismissible alert-danger mt-3  fade show">

                                <strong>Whoops!</strong> There were some problems with your input. <button type="button"
                                    class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.account.team.update',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-block container">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{$user->id}}" id="hidden-id" />
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $user->name) }}" class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Positions:</label>
                                        <input type="text" name="positions" id="positions"
                                            value="{{ old('positions', $user->employee->positions) }}" class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Fees:</label>
                                        <input type="text" name="fees"
                                            value="{{ old('fees', $user->employee->fees) }}" id="fees"
                                            class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Legal Area:</label>
                                        <select name="legal_area_id[]" id="legal_area_id" class="form-control"
                                            multiple="multiple">
                                            <option>--Select Legal Area--</option>

                                            @php
                                                $selectedAreas = explode(',', $user->employee->legal_area ?? ''); // convert "1,2" into [1, 2]
                                            @endphp


                                            @foreach ($legalareas as $legalarea)
                                                <option value="{{ $legalarea->id }}"
                                                    {{ in_array($legalarea->id, $selectedAreas) ? 'selected' : '' }}>
                                                    {{ $legalarea->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                        <input type="text" name="email" id="email"
                                            value="{{ old('fees', $user->email) }}" class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Phone:</label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ old('fees', $user->phone) }}" class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Password:</label>
                                        <input type="password" name="password" class="form-control"placeholder="Password"
                                            id="password">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Facebook:</label>
                                        <input type="text" name="facebook"
                                            value="{{ old('facebook', $user->employee->facebook) }}"
                                            class="form-control"placeholder="facebook" id="facebook">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Twitter:</label>
                                        <input type="text" name="twitter"
                                            value="{{ old('twitter', $user->employee->facebook) }}"
                                            class="form-control"placeholder="twitter" id="twitter">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="recipient-name" class="col-form-label">Linkedin:</label>
                                        <input type="text" name="linkedin"
                                            value="{{ old('linkedin', $user->employee->facebook) }}"
                                            class="form-control"placeholder="linkedin" id="linkedin">
                                    </div>
                                    <div class="form-group col-10 mb-2">
                                        <label for="favicon">Upload Image<span class="text-danger">*</span> <span
                                                class="text-danger">( Size: 500*500)</span></label>
                                        {{-- <input type="file" id="image" data-height="290"
                                            class="dropify form-control "  name="image"> --}}
                                        <input class="form-control" name="image" accept="image/*" type="file"
                                            id="imgInp">
                                        <img style="width: 150px; margin-top:10px; border:1px solid black;" id="blah"
                                            src="{{ asset($user->employee->image) }}" alt="your image">
                                    </div>
                                    <div class="form-group col-2">
                                        <img src="" id="imageedit" style="width: 40px; height:auto;"
                                            alt="">
                                    </div>
                                    <div class="col-12 mb-6">
                                        <label for="recipient-name" class="col-form-label">Details:</label>
                                        <textarea name="details" id="details" cols="30" rows="10" class="form-control ckeditor"> {{ old('details', $user->employee->details) }}</textarea>
                                    </div>
                                    <div class="form-group col-6 col-sm-6 col-md-6 mb-2">
                                        <label for="favicon">Status<span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="mb-3">
                                            <h4 class="mb-0">Only For Employees </h4>
                                            <small class="text-muted">Fill these details if adding an employee only</small>
                                        </div>

                                        <div class="row">


                                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                                <label for="slot_duration" class="my-0"><i
                                                        class="fas fa-stopwatch"></i>
                                                    Service
                                                    Duration</label> <small class="text-muted"> Create booking slots based
                                                    on
                                                    your preferred time duration.</small>
                                                @php
                                                    $steps = ['10', '15', '20', '30', '45', '60'];
                                                    $selectedStep = old('slot_duration'); // Get the selected step value from old input
                                                @endphp
                                                <select class="form-control @error('slot_duration') is-invalid @enderror"
                                                    name="slot_duration" id="slot_duration">
                                                    <option value=""
                                                        {{ old('slot_duration', optional($user->employee)->slot_duration) == '' ? 'selected' : '' }}>
                                                        Select Duration
                                                    </option>

                                                    @foreach ($steps as $stepValue)
                                                        <option value="{{ $stepValue }}"
                                                            {{ old('slot_duration', optional($user->employee)->slot_duration) == $stepValue ? 'selected' : '' }}>
                                                            {{ $stepValue }} minutes
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('slot_duration')
                                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                                @enderror
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                                <label for="break_duration" class="my-0"><i class="fas fa-coffee"></i>
                                                    Preparation or Break time</label> <small class="text-muted"> Break
                                                    between
                                                    one to another appointment</small>
                                                @php
                                                    $breaks = ['5', '10', '15', '20', '25', '30'];
                                                    $selectedBreak = old('break_duration'); // Get the selected step value from old input
                                                @endphp
                                                <select class="form-control @error('break_duration') is-invalid @enderror"
                                                    name="break_duration" id="break_duration">
                                                    <option value=""
                                                        {{ old('break_duration', optional($user->employee)->break_duration) == '' ? 'selected' : '' }}>
                                                        No Break
                                                    </option>

                                                    @foreach ($breaks as $breakValue)
                                                        <option value="{{ $breakValue }}"
                                                            {{ old('break_duration', optional($user->employee)->break_duration) == $breakValue ? 'selected' : '' }}>
                                                            {{ $breakValue }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('break_duration')
                                                    <small class="text-danger"><strong>{{ $message }}</strong></small>
                                                @enderror
                                            </div>


                                        </div>

                                        <hr>
                                        <div class="row mb-5">
                                            <div class="mb-3">
                                                <h4 class="mb-0">Set Availibity - For Employee</h4>
                                                <small class="text-muted">Select days and timings, with the option to add
                                                    multiple time slots in a day, e.g., 9 AM–12 PM and 4 PM–8 PM</small>
                                            </div>
                                            <div class="col-md-12">
                                                @foreach ($days as $day)
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="{{ $day }}"
                                                                        @if (old('days.' . $day) || isset($employeeDays[$day])) checked @endif>
                                                                    <label class="custom-control-label"
                                                                        for="{{ $day }}">
                                                                        {{ ucfirst($day) }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- First Time Input Row -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <strong>From:</strong>
                                                                <input type="time" class="form-control from"
                                                                    name="days[{{ $day }}][]"
                                                                    id="{{ $day }}From"
                                                                    value="{{ old('days.' . $day . '.0') ?? ($employeeDays[$day][0] ?? '') }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <strong>To:</strong>
                                                                <input type="time" class="form-control to"
                                                                    name="days[{{ $day }}][]"
                                                                    id="{{ $day }}To"
                                                                    value="{{ old('days.' . $day . '.1') ?? ($employeeDays[$day][1] ?? '') }}" />
                                                                <div style="margin-top:15px; margin-bottom:10px;"
                                                                    id="{{ $day }}AddMore"
                                                                    class="text-right d-none text-primary">
                                                                    Add More
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Render Additional Rows -->
                                                    @if (old('days.' . $day) || isset($employeeDays[$day]))
                                                        @foreach (old('days.' . $day) ?: $employeeDays[$day] as $index => $time)
                                                            @if ($index > 1 && $index % 2 == 0)
                                                                <div class="row additional-{{ $day }}">
                                                                    <div class="col-md-2"></div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <strong>From:</strong>
                                                                            <input type="time"
                                                                                class="form-control from"
                                                                                name="days[{{ $day }}][]"
                                                                                value="{{ $time }}"
                                                                                id="{{ $day }}MoreFrom" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <strong>To</strong>
                                                                            <input type="time" class="form-control to"
                                                                                name="days[{{ $day }}][]"
                                                                                value="{{ old('days.' . $day . '.' . ($index + 1)) ?? ($employeeDays[$day][$index + 1] ?? '') }}"
                                                                                id="{{ $day }}" />
                                                                            <div class="remove-field text-danger text-right"
                                                                                style="margin-top:15px; margin-bottom:10px;">
                                                                                Remove</div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <hr>

                                    <div class="row d-flex">
                                        <div class="col-md-10">
                                            <h2 class="mb-0">Add Holidays</h2>
                                            <p class="text-muted">
                                                No need to add time for a full day; for part-time work, specify the day and
                                                time.
                                            </p>
                                            <span id="addHoliday" class="btn btn-primary mb-2 btn-sm">
                                                <i class="fa fa-plus"></i> Add Holiday
                                            </span>
                                            <div class="holidayContainer">
                                                @php
                                                    // Get holidays from old input or database
                                                    $holidaysInput = old('holidays.date', []);
                                                    $dbHolidays = $user->employee->holidays ?? [];
                                                    $holidaysToDisplay = !empty($holidaysInput)
                                                        ? $holidaysInput
                                                        : $dbHolidays;
                                                @endphp

                                                @forelse($holidaysToDisplay as $index => $holidayItem)
                                                    @php
                                                        // Determine if we're using old input or database data
                                                        $usingOldInput = !empty($holidaysInput);

                                                        if ($usingOldInput) {
                                                            $date = old("holidays.date.$index");
                                                            $holiday = null;
                                                        } else {
                                                            $holiday = $holidayItem;
                                                            $date = $holiday->date;
                                                            // Format date for input field if it's not already in YYYY-MM-DD format
                                                                                                                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                                                                try {
                                                                    $date = \Carbon\Carbon::parse($date)->format(
                                                                        'Y-m-d',
                                                                    );
                                                                } catch (Exception $e) {
                                                                    $date = '';
                                                                }
                                                            }
                                                        }

                                                        $fromTime = old(
                                                            "holidays.from_time.$index",
                                                            $holiday && $holiday->hours
                                                                ? explode('-', $holiday->hours[0])[0] ?? ''
                                                                : '',
                                                        );
                                                        $toTime = old(
                                                            "holidays.to_time.$index",
                                                            $holiday && $holiday->hours
                                                                ? explode('-', $holiday->hours[0])[1] ?? ''
                                                                : '',
                                                        );
                                                        $recurring = old(
                                                            "holidays.recurring.$index",
                                                            $holiday->recurring ?? 0,
                                                        );
                                                    @endphp
                                                    <div class="row holiday-row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0">Date</label>
                                                                <input class="form-control" type="date"
                                                                    name="holidays[date][]" value="{{ $date }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <strong>From:</strong>
                                                                <input type="time" class="form-control from"
                                                                    name="holidays[from_time][]"
                                                                    value="{{ $fromTime }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <strong>To:</strong>
                                                                <input type="time" class="form-control to"
                                                                    name="holidays[to_time][]"
                                                                    value="{{ $toTime }}">
                                                                <div class="text-right text-danger removeHoliday"
                                                                    style="cursor:pointer;">
                                                                    Remove
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="holidays[recurring][]"
                                                            value="{{ $recurring }}">
                                                    </div>
                                                @empty
                                                    <p>No holidays found for this user. Click "Add Holiday" to create one.
                                                    </p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 pt-3 pl-md-3 my-5 text-center">
                                    <button type="submit" class="btn btn-primary">Update Team</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function toggleDayFields(dayId) {
                var isChecked = $('#' + dayId).prop('checked');
                $('#' + dayId + 'From, #' + dayId + 'To').prop('disabled', !isChecked);

                // Show or hide the "Add More" button based on the checkbox state
                if (isChecked) {
                    $('#' + dayId + 'AddMore').removeClass('d-none');
                } else {
                    $('#' + dayId + 'AddMore').addClass('d-none');
                    // Remove all additional fields for the day if unchecked
                    $('.additional-' + dayId).remove();
                }
            }

            function addMoreFields(dayId) {
                // Clone the original row for the specific day
                var originalRow = $('#' + dayId + 'AddMore').closest('.row');
                var clonedRow = originalRow.clone();

                // Reset the values in the cloned row (but don't enable the fields yet)
                clonedRow.find('input').each(function() {
                    $(this).val(''); // Clear the value
                });

                // Replace the col-md-2 section with a blank div for the cloned row
                clonedRow.find('.col-md-2').replaceWith('<div class="col-md-2"></div>');

                // Update "Add More" to "Remove" for the cloned row
                clonedRow.find(`#${dayId}AddMore`).text('Remove').attr('id', '').addClass(
                    'remove-field text-danger');

                // Add a unique class to the cloned row for targeting specific day rows
                clonedRow.addClass('additional-' + dayId);

                // Append the cloned row after the original row or the last cloned row
                if (originalRow.closest('.row').siblings('.additional-' + dayId).length === 0) {
                    originalRow.after(clonedRow);
                } else {
                    originalRow.closest('.row').siblings('.additional-' + dayId).last().after(clonedRow);
                }
            }

            // Remove cloned rows
            $(document).on('click', '.remove-field', function() {
                $(this).closest('.row').remove();
            });

            // Bind change and add-more events to all days
            ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'].forEach(function(day) {
                $('#' + day).on('change', function() {
                    toggleDayFields(day);
                }).trigger('change');

                $('#' + day + 'AddMore').on('click', function() {
                    addMoreFields(day);
                });
            });
        });
    </script>


    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#legal_area_id').select2({

                placeholder: 'Select Legal Area',
                ajax: {
                    url: '{{ route('admin.account.legal_area.search') }}',
                    dataType: 'json',
                    type: "GET",
                    data: function(data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }

            });
        });
    </script>
     {{-- show image --}}
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
 <script>
        $(document).ready(function() {
            // Add new holiday row
            $('#addHoliday').click(function() {
                const holidayRow = `
                <div class="row holiday-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="mb-0">Date</label>
                            <input class="form-control" type="date" name="holidays[date][]" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>From:</strong>
                            <input type="time" class="form-control from" name="holidays[from_time][]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <strong>To:</strong>
                            <input type="time" class="form-control to" name="holidays[to_time][]">
                            <div class="text-right text-danger removeHoliday" style="cursor:pointer;">Remove</div>
                        </div>
                    </div>
                    <input type="hidden" name="holidays[recurring][]" value="0">
                </div>`;
                $('.holidayContainer').append(holidayRow);
            });

            // Remove holiday row
            $(document).on('click', '.removeHoliday', function() {
                $(this).closest('.holiday-row').remove();
            });
        });
    </script>
@endsection
