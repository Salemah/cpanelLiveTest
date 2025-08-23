@extends('frontend.layers.master')
@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
<style>
    .ripple-wave.active {
        /* Do nothing */
        all: unset;
        /* removes styles from active */
        /* Or just override specific styles */
        background: inherit;
        animation: none;
    }

    .ripple-wave {
        pointer-events: none;
    }

    .ripple-wave.active {
        all: unset;
        /* Remove all styles applied by active */
    }

    .ripple-wave.active {
        /* Do nothing */
        all: unset;
        /* removes styles from active */
        /* Or just override specific styles */
        background: inherit;
        animation: none;
    }

    .booking-container {
        max-width: 1000px;
        margin: 50px auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        overflow: hidden;
    }

    .booking-header {
        background: var(--primary-color);
        color: white;
        padding: 20px;
        text-align: center;
    }

    .booking-steps {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        background-color: #f1f3f9;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
        margin-right: 20px;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .step.active .step-number {
        background-color: var(--primary-color);
        color: white;
    }

    .step.completed .step-number {
        background-color: #28a745;
        color: white;
    }

    .step-title {
        font-size: 14px;
        text-align: center;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .step.active .step-title {
        color: var(--primary-color);
        font-weight: bold;
    }

    .step.completed .step-title {
        color: #28a745;
    }

    .booking-content {
        padding: 15px;
        min-height: 400px;
    }


    .booking-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .booking-step.active {
        display: block;
    }

    .booking-footer {
        padding: 20px;
        border-top: 1px solid #e3e6f0;
        display: flex;
        justify-content: space-between;
    }

    .category-card,
    .service-card,
    .employee-card {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        margin-bottom: 20px;
        height: 100%;
    }

    .category-card:hover,
    .service-card:hover,
    .employee-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .category-card.selected,
    .service-card.selected,
    .employee-card.selected {
        border-color: var(--primary-color);
        background-color: rgba(78, 115, 223, 0.1);
        border: 1px solid #4087ff !important;
    }


    .card-icon {
        font-size: 2rem;
        margin-bottom: 15px;
        color: var(--primary-color);
    }

    .time-slot {
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 10px;
        margin: 5px;
        text-align: center;
    }

    .time-slot:hover {
        background-color: rgba(78, 115, 223, 0.1);
    }

    .time-slot.selected {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .time-slot.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f8f9fa;
    }

    .calendar-day {
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .calendar-day:hover:not(.disabled) {
        background-color: rgba(78, 115, 223, 0.1);
    }

    .calendar-day.selected {
        background-color: var(--primary-color);
        color: white;
    }

    .calendar-day.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f8f9fa;
    }

    .summary-item {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e3e6f0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            transform: translateX(50px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slide-in {
        animation: slideIn 0.5s ease forwards;
    }

    /* Progress bar between steps */
    .booking-steps::before {
        content: '';
        /* position: absolute; */
        top: 80px;
        left: 20%;
        right: 20%;
        height: 2px;
        background-color: transparent;
        z-index: 0;
    }

    .progress-bar-steps {
        position: relative;
        height: 4px;
        background-color: #e0e0e0;
        /* margin: 0 40px; */
        top: -22px;
        z-index: 0;
    }

    .progress-bar-steps .progress {
        height: 100%;
        background-color: var(--primary-color);
        width: 0%;
        transition: width 0.5s ease;
    }

    @media(min-width:720px) {
        .booking-content {
            padding: 30px;
            min-height: 400px;
        }

    }

    .ripple-wave {
        pointer-events: none;
    }

    .ripple-wave.active {
        all: unset;
        /* Remove all styles applied by active */
    }
</style>
@section('content')
    <section id="subheader" class="text-white" data-bgcolor="#111111">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="spacer-single"></div>
                        <h1>The Team</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section aria-label="section">
        <div class="container">
            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12  wow fadeInRight" data-wow-delay=".4s">
                    <div class="f-profile text-center">
                        <input type="hidden" name="team_id" id="team_id" value="{{ $team->id }}">
                        <h4>{{ $team->name }}</h4>
                        <h5>{{ $team->positions }}</h5>
                        <p>{!! $team->details !!}</p>
                        <input type="hidden" name="team_name" id="team_name" value="{{ $team->name }}">
                        <input type="hidden" name="fees" id="fees" value="{{ $team->fees }}">
                        <input type="hidden" name="slot_duration" id="slot_duration" value="{{ $team->slot_duration }}">
                    </div>
                </div>
                {{-- -----------------make appointment --}}
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="text-center">
                        {{-- <div class="container"> --}}
                        <div class="booking-container">
                            <div class="booking-header">
                                <h2><i class="bi bi-calendar-check"></i> Appointment Booking</h2>
                                <p class="mb-0">Book your appointment in a few simple steps</p>
                            </div>

                            <div class="booking-steps position-relative">

                                <div class="step  active" data-step="1">
                                    <div class="step-number">1</div>
                                    <div class="step-title">Date & Time</div>
                                </div>
                                <div class="step" data-step="2">
                                    <div class="step-number">2</div>
                                    <div class="step-title">Confirm</div>
                                </div>
                                <div class="progress-bar-steps">
                                    <div class="progress"></div>
                                </div>
                            </div>

                            <div class="booking-content">


                                <!-- Step 4: Date and Time Selection -->
                                <div class="booking-step active" id="step1">
                                    <h3 class="mb-4">Select Date & Time</h3>
                                    <div class="selected-employee-name mb-3 fw-bold"></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-sm btn-outline-secondary" id="prev-month"><i
                                                            class="fa-solid fa-angle-left"></i></button>
                                                    <h5 class="mb-0" id="current-month">March 2023</h5>
                                                    <button class="btn btn-sm " id="next-month"><i
                                                            class="fa-solid fa-angle-right"></i></button>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-calendar">
                                                        <thead>
                                                            <tr>
                                                                <th>Sun</th>
                                                                <th>Mon</th>
                                                                <th>Tue</th>
                                                                <th>Wed</th>
                                                                <th>Thu</th>
                                                                <th>Fri</th>
                                                                <th>Sat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="calendar-body">
                                                            <!-- Calendar will be generated dynamically -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Available Time Slots</h5>
                                                    <div id="selected-date-display" class="text-muted small"></div>
                                                </div>
                                                <div class="card-body">
                                                    <div id="time-slots-container" class="d-flex flex-wrap">
                                                        <!-- Time slots will be loaded dynamically -->
                                                        <div class="text-center text-muted w-100 py-4">
                                                            Please select a date to view available times
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 5: Confirmation -->
                                <div class="booking-step" id="step2">
                                    <h3 class="mb-4">Confirm Your Booking</h3>
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Booking Summary</h5>
                                        </div>
                                        <div class="card-body">
                                            {{-- <div class="summary-item">
                                                <div class="row">
                                                    <div class="col-md-4 text-muted">Category:</div>
                                                    <div class="col-md-8" id="summary-category"></div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="summary-item">
                                                <div class="row">
                                                    <div class="col-md-4 text-muted">Service:</div>
                                                    <div class="col-md-8" id="summary-service"></div>
                                                </div>
                                            </div> --}}
                                            <div class="summary-item">
                                                <div class="row">
                                                    <div class="col-md-4 text-muted">Team Member:</div>
                                                    <div class="col-md-8" id="summary-employee"></div>
                                                </div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="row">
                                                    <div class="col-md-4 text-muted">Date & Time:</div>
                                                    <div class="col-md-8" id="summary-datetime"></div>
                                                </div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="row">
                                                    <div class="col-md-4 text-muted">Duration:</div>
                                                    <div class="col-md-8" id="summary-duration"></div>
                                                </div>
                                            </div>
                                            <div class="summary-item">
                                                <div class="row">
                                                    <div class="col-md-4 text-muted">Price:</div>
                                                    <div class="col-md-8" id="summary-price"></div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <h5>Your Information</h5>
                                                <form id="customer-info-form">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="customer-name" class="form-label">Full
                                                                Name</label>
                                                            <input type="text" class="form-control" id="customer-name"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="customer-email" class="form-label">Email</label>
                                                            <input type="email" class="form-control"
                                                                id="customer-email" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="customer-phone" class="form-label">Phone</label>
                                                            <input type="tel" class="form-control"
                                                                id="customer-phone" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="customer-notes" class="form-label">Notes
                                                                (Optional)</label>
                                                            <textarea class="form-control" id="customer-notes" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="booking-footer">
                                <button class="btn btn-outline-secondary" id="prev-step" disabled>
                                    <i class="bi bi-arrow-left"></i> Previous
                                </button>
                                <button class="btn btn-primary" id="next-step">
                                    Next <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Success Modal -->
    <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Booking Confirmed!</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Thank You!</h4>
                    <p>Your appointment has been successfully booked.</p>
                    <div class="alert alert-info mt-3">
                        <p class="mb-0">A confirmation email has been sent to your email address.</p>
                    </div>
                    <div class="booking-details mt-4 text-start">
                        <h5>Booking Details:</h5>
                        <div id="modal-booking-details"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}

                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Booking Confirmed!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Thank You!</h4>
                    <p>Your appointment has been successfully booked.</p>
                    <div class="alert alert-info mt-3">
                        <p class="mb-0">A confirmation email has been sent to your email address.</p>
                    </div>
                    <div class="booking-details mt-4 text-start">
                        <h5>Booking Details:</h5>
                        <div id="modal-booking-details"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            const categories = @json($categories);

            const container = $('#categories-container'); // Target the container by ID

            let html = '';
            $.each(categories, function(index, category) {
                html += `
            <div class="col">
                <div class="card border h-100 category-card text-center rounded p-2" data-category="${category.id}">
                    <div class="card-body">
                         ${category.image ? `<img class="img-fluid w-25 mb-2" src="${category.image}">` : ""}
                        <h5 class="card-title">${category.name}</h5>
                        <p class="card-text">${category.name}</p>
                    </div>
                </div>
            </div>
        `;
            });

            container.html(html); // Insert all generated HTML at once


            const employees = @json($employees);
            // console.log(employees);

            // Booking state
            let bookingState = {
                currentStep: 1,
                selectedCategory: null,
                selectedService: null,
                selectedEmployee: null,
                selectedDate: null,
                selectedTime: null
            };

            // Initialize the booking system
            updateProgressBar();
            generateCalendar();

            // Step navigation
            $("#next-step").click(function() {
                const currentStep = bookingState.currentStep;

                // Validate current step before proceeding
                if (!validateStep(currentStep)) {
                    return;
                }

                if (currentStep < 2) {
                    goToStep(currentStep + 1);
                } else {
                    // Submit booking
                    if ($("#customer-info-form")[0].checkValidity()) {
                        submitBooking();
                    } else {
                        $("#customer-info-form")[0].reportValidity();
                    }
                }
            });

            $("#prev-step").click(function() {
                if (bookingState.currentStep > 1) {
                    goToStep(bookingState.currentStep - 1);
                }
            });

            // Category selection
            $(document).on("click", ".category-card", function() {
                $(".category-card").removeClass("selected");
                $(this).addClass("selected");

                const categoryId = $(this).data("category");
                // console.log(categoryId);
                bookingState.selectedCategory = categoryId;

                // Reset subsequent selections
                bookingState.selectedService = null;
                bookingState.selectedEmployee = null;
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;

                // Update the service step with services for this category
                //updateServicesStep(categoryId);
            });






            // Date selection
            $(document).on("click", ".calendar-day:not(.disabled)", function() {
                $(".calendar-day").removeClass("selected");
                $(this).addClass("selected");

                const date = $(this).data("date");
                bookingState.selectedDate = date;

                // Reset time selection
                bookingState.selectedTime = null;

                // Update time slots based on employee availability
                updateTimeSlots(date);
            });

            // Time slot selection
            $(document).on("click", ".time-slot:not(.disabled)", function() {
                $(".time-slot").removeClass("selected");
                $(this).addClass("selected");

                const time = $(this).data("time");
                bookingState.selectedTime = time;
            });

            // Calendar navigation
            $("#prev-month").click(function() {
                navigateMonth(-1);
            });

            $("#next-month").click(function() {
                navigateMonth(1);
            });

            // Functions
            function goToStep(step) {
                // Hide all steps
                $(".booking-step").removeClass("active");

                // Show the target step
                $(`#step${step}`).addClass("active");

                // Update the step indicators
                $(".step").removeClass("active completed");

                for (let i = 1; i <= 2; i++) {
                    if (i < step) {
                        $(`.step[data-step="${i}"]`).addClass("completed");
                    } else if (i === step) {
                        $(`.step[data-step="${i}"]`).addClass("active");
                    }
                }

                // Update the current step
                bookingState.currentStep = step;

                // Update the navigation buttons
                updateNavigationButtons();

                // Update the progress bar
                updateProgressBar();

                // If we're on the confirmation step, update the summary
                if (step === 2) {
                    updateSummary();
                }

                // Scroll to top of booking container
                $(".booking-container")[0].scrollIntoView({
                    behavior: "smooth"
                });
            }


            function updateProgressBar() {
                const progress = ((bookingState.currentStep - 1) / 4) * 100;
                $(".progress-bar-steps .progress").css("width", `${progress}%`);
            }


            function updateNavigationButtons() {
                // Enable/disable previous button
                if (bookingState.currentStep === 1) {
                    $("#prev-step").prop("disabled", true);
                } else {
                    $("#prev-step").prop("disabled", false);
                }

                // Update next button text
                if (bookingState.currentStep === 2) {
                    $("#next-step").html('Confirm Booking <i class="bi bi-check-circle"></i>');
                } else {
                    $("#next-step").html('Next <i class="bi bi-arrow-right"></i>');
                }
            }


            function validateStep(step) {
                switch (step) {

                    case 1:
                        if (!bookingState.selectedDate) {
                            alert("Please select a date");
                            return false;
                        }
                        if (!bookingState.selectedTime) {
                            alert("Please select a time slot");
                            return false;
                        }
                        return true;
                    default:
                        return true;
                }
            }






            function generateCalendar() {
                const today = new Date();
                const currentMonth = today.getMonth();
                const currentYear = today.getFullYear();

                renderCalendar(currentMonth, currentYear);
            }

            function renderCalendar(month, year) {
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDay = firstDay.getDay(); // 0 = Sunday

                // Update month display
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
                    "September", "October", "November", "December"
                ];
                $("#current-month").text(`${monthNames[month]} ${year}`);

                // Clear calendar
                $("#calendar-body").empty();

                // Build calendar
                let date = 1;
                for (let i = 0; i < 6; i++) {
                    // Create a table row
                    const row = $("<tr></tr>");

                    // Create cells for each day of the week
                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < startingDay) {
                            // Empty cells before the first day of the month
                            row.append("<td></td>");
                        } else if (date > daysInMonth) {
                            // Break if we've reached the end of the month
                            break;
                        } else {
                            // Create a cell for this date
                            const today = new Date();
                            const cellDate = new Date(year, month, date);
                            const formattedDate =
                                `${year}-${(month + 1).toString().padStart(2, '0')}-${date.toString().padStart(2, '0')}`;

                            // Check if this date is in the past
                            const isPast = cellDate < new Date(today.setHours(0, 0, 0, 0));

                            // Create the cell with appropriate classes
                            const cell = $(
                                `<td class="text-center calendar-day${isPast ? ' disabled' : ''}" data-date="${formattedDate}">${date}</td>`
                            );

                            row.append(cell);
                            date++;
                        }
                    }

                    // Add the row to the calendar if it has cells
                    if (row.children().length > 0) {
                        $("#calendar-body").append(row);
                    }
                }
            }

            function navigateMonth(direction) {
                const currentMonthText = $("#current-month").text();
                const [monthName, year] = currentMonthText.split(" ");

                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
                    "September", "October", "November", "December"
                ];
                let month = monthNames.indexOf(monthName);
                let yearNum = parseInt(year);

                month += direction;

                if (month < 0) {
                    month = 11;
                    yearNum--;
                } else if (month > 11) {
                    month = 0;
                    yearNum++;
                }

                renderCalendar(month, yearNum);
            }


            function updateCalendar() {
                // Update employee name display
                console.log($('#team_name').val());
                const employee = $('#team_name').val();
                $(".selected-employee-name").text(`Selected Staff: ${employee}`);

                // Clear previous selections
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;
                $(".calendar-day").removeClass("selected");
                $(".time-slot").removeClass("selected");

                // Show loading state for time slots
                $("#time-slots-container").html(`
                <div class="text-center w-100 py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);
            }

            function updateCalendar() {
                // Update employee name display
                console.log($('#team_name').val());
                const employee = $('#team_name').val();
                $(".selected-employee-name").text(`Selected Staff: ${employee}`);

                // Clear previous selections
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;
                $(".calendar-day").removeClass("selected");
                $(".time-slot").removeClass("selected");

                // Show initial state instead of loading spinner
                $("#time-slots-container").html(`
                    <div class="text-center w-100 py-4">
                        <div class="alert alert-info">
                            <i class="bi bi-calendar-event me-2"></i>
                            Please select a date to view available time slots
                        </div>
                    </div>
                `);
            }

            function updateTimeSlots(selectedDate) {
                if (!selectedDate) {
                    $("#time-slots-container").html(`
                    <div class="text-center w-100 py-4">
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            No date selected
                        </div>
                    </div>
                `);
                    return;
                }

                const employeeId = $("#team_id").val();
                const apiDate = new Date(selectedDate).toISOString().split('T')[0];

                // Show loading state only when actually fetching
                $("#time-slots-container").html(`
                    <div class="text-center w-100 py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="mt-2">Checking availability...</div>
                    </div>
                `);

                $.ajax({
                    url: `/employees/${employeeId}/availability/${apiDate}`,
                    success: function(response) {
                        $("#time-slots-container").empty();

                        if (response.available_slots.length === 0) {
                            $("#time-slots-container").html(`
                    <div class="text-center py-4">
                        <div class="alert alert-warning">
                            <i class="bi bi-clock-history me-2"></i>
                            No available slots for this date
                        </div>
                        <button class="btn btn-sm btn-outline-primary mt-2" onclick="updateCalendar()">
                            <i class="bi bi-arrow-left me-1"></i> Back to calendar
                        </button>
                    </div>
                `);
                            return;
                        }

                        // Add slot duration info
                        $("#time-slots-container").append(`
                            <div class="slot-info mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Each slot: ${response.slot_duration} mins
                                        ${response.break_duration ? ` | Break: ${response.break_duration} mins` : ''}
                                    </small>

                                </div>
                            </div>
                        `);

                        // Add each time slot
                        const $slotsContainer = $("<div class='slots-grid'></div>");
                        response.available_slots.forEach(slot => {
                            const slotElement = $(`
                            <div class="time-slot btn btn-outline-primary mb-2"
                                data-start="${slot.start}"
                                data-end="${slot.end}"
                                title="Select ${slot.display}"
                                data-time="${slot.display}">
                                <i class="bi bi-clock me-1"></i>
                                ${slot.display}
                            </div>
                        `);

                            slotElement.on('click', function() {
                                $(".time-slot").removeClass("selected active");
                                $(this).addClass("selected active");
                                bookingState.selectedTime = {
                                    start: $(this).data('start'),
                                    end: $(this).data('end'),
                                    display: $(this).text()
                                };
                                updateBookingSummary();
                            });

                            $slotsContainer.append(slotElement);
                        });
                        $("#time-slots-container").append($slotsContainer);
                    },
                    error: function(xhr) {
                        $("#time-slots-container").html(`
                            <div class="text-center py-4">
                                <div class="alert alert-danger">
                                    <i class="bi bi-exclamation-octagon me-2"></i>
                                    Error loading availability
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-2" onclick="updateTimeSlots('${selectedDate}')">
                                            <i class="bi bi-arrow-repeat me-1"></i> Try again
                                        </button>
                                    </div>
                                `);
                    }
                });
            }



            function updateSummary() {
                console.log($('#team_name').val());
                // Find the selected category
                const selectedCategory = categories.find(cat => cat.id == bookingState.selectedCategory);

                const team = $('#team_name').val();
                const fees = $('#fees').val();
                const slot_duration = $('#slot_duration').val();
                // Update summary with booking details
                $("#summary-category").text(selectedCategory ? selectedCategory.title : 'Not selected');

                // Update service info - using the stored service object
                // if (bookingState.selectedService) {
                //     $("#summary-service").text(
                //         `${bookingState.selectedService.title} (${bookingState.selectedService.price})`);
                $("#summary-duration").text(slot_duration);
                $("#summary-price").text(fees);
                //  }

                // Update employee info
                //i//f (bookingState.selectedEmployee) {
                $("#summary-employee").text(team);
                //}

                // Update date/time info
                if (bookingState.selectedDate && bookingState.selectedTime) {
                    const formattedDate = new Date(bookingState.selectedDate).toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    $("#summary-datetime").text(
                        `${formattedDate} at ${bookingState.selectedTime.display || bookingState.selectedTime}`);
                }
            }



            // function submitBooking() {

            function submitBooking() {
                // Get form data
                const form = $('#customer-info-form');
                const csrfToken = form.find('input[name="_token"]').val(); // Get CSRF token from form
                const team = $('#team_name').val();
                const fees = $('#fees').val();
                const slot_duration = $('#slot_duration').val();
                const employeeId = $("#team_id").val();
                const bookingData = {
                    team_id: employeeId,

                    name: $('#customer-name').val(),
                    email: $('#customer-email').val(),
                    phone: $('#customer-phone').val(),
                    notes: $('#customer-notes').val(),
                    amount: parseFloat(1200),
                    booking_date: bookingState.selectedDate,
                    booking_time: bookingState.selectedTime.start || bookingState.selectedTime,
                    status: 'Pending payment',
                    _token: csrfToken // Include CSRF token in payload
                };

                // Add user_id if authenticated (using JavaScript approach)
                if (typeof currentAuthUser !== 'undefined' && currentAuthUser) {
                    bookingData.user_id = currentAuthUser.id;
                }

                // Show loading state
                const nextBtn = $("#next-step");
                nextBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status"></span> Processing...'
                );

                // Submit via AJAX
                $.ajax({
                    url: '/bookings',
                    method: 'POST',
                    data: bookingData,
                    success: function(response) {
                        // Update modal with booking details
                        const formattedDate = new Date(bookingState.selectedDate).toLocaleDateString(
                            'en-US', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });

                        const bookingDetails = `
                                <div class="mb-2"><strong>Customer:</strong> ${$("#customer-name").val()}</div>

                                <div class="mb-2"><strong>Staff:</strong> ${team}</div>
                                <div class="mb-2"><strong>Date & Time:</strong> ${formattedDate} at ${bookingState.selectedTime.display || bookingState.selectedTime}</div>
                                 <div class="mb-2"><strong>Amount:</strong> ${fees}</div>
                                <div><strong>Reference:</strong> ${response.booking_id || 'BK-' + Math.random().toString(36).substr(2, 8).toUpperCase()}</div>
                            `;

                        $('#modal-booking-details').html(bookingDetails);
                        // Show success modal
                        const modalEl = document.getElementById(
                            'bookingSuccessModal'); // get DOM element
                        const successModal = new bootstrap.Modal(modalEl);
                        successModal.show();

                        // Reset form after delay
                        setTimeout(resetBooking, 1000);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Booking failed. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.status === 422) {
                            errorMessage = 'Validation error: Please check your information.';
                        }

                        alert(errorMessage);
                        nextBtn.prop('disabled', false).html(
                            'Confirm Booking <i class="bi bi-check-circle"></i>');
                    },
                    complete: function() {
                        // Re-enable button if request fails
                        if (nextBtn.prop('disabled')) {
                            setTimeout(() => {
                                nextBtn.prop('disabled', false).html(
                                    'Confirm Booking <i class="bi bi-check-circle"></i>');
                            }, 2000);
                        }
                    }
                });
            }

            function resetBooking() {
                // Reset booking state
                bookingState = {
                    currentStep: 1,
                    selectedCategory: null,
                    selectedService: null,
                    selectedEmployee: null,
                    selectedDate: null,
                    selectedTime: null
                };

                // Reset UI
                $(".category-card, .service-card, .employee-card, .calendar-day, .time-slot").removeClass(
                    "selected");
                $("#customer-info-form")[0].reset();

                // Go to first step
                goToStep(1);
            }
        });
    </script>
@endsection
