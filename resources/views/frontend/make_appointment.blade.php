@extends('frontend.layers.master')
@section('css')
    <style>
        /* Custom styling for time slots */
        .time-slot {
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .time-slot:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e0;
        }

        .time-slot h6 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .time-slot p {
            margin: 0;
            font-size: 12px;
            color: #718096;
        }

        /* Custom title and section styling */
        .section-title {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .category-title {
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    <section id="subheader" class="jarallax text-white">
        <img src="images/background/subheader3.jpg" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="spacer-single"></div>
                        <h1>FAQ</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-features">
        <div class="container">
            <div class="row">
                <h4 class="text-center">Book an Appointment</h4>
                <div class="">
                    <div class="row">
                        <div class="col align-self-center">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-3">
                                            <div class="">
                                                <label for="flatpickr-inline" class="form-label">Inline Picker</label>
                                                <input type="text" class="form-control mb-1" placeholder="YYYY-MM-DD"
                                                    id="flatpickr-inline" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-9">
                                            <div class="slot">

                </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

        </div>
        </div>
    @endsection
    @section('script')
        <script>
            $(document).on("change", "#flatpickr-inline", function() {
                GetData();
            });

            function GetData() {

                let date = $('#flatpickr-inline').val();
                $.ajax({
                    url: "{{ route('frontend.slot_get') }}",
                    data: {
                        "date": date,
                    },
                    method: 'GET',
                    success: function(staffs) {

                        $('.slot').html(staffs);
                    }
                });

            };

            function UpdateAttendenceDetail(data) {
                data.forEach(function(row) {
                    if (row.attendence == "Present") {
                        document.getElementById("check_attendence_" + row.employee_id).checked = true;
                        // Hours Cal
                        var dateTimeF = moment(row.punch_in)
                            .format("YYYY-MM-DD HH:mm:ss");
                        var dateTimeT = moment(row.punch_out)
                            .format("YYYY-MM-DD HH:mm:ss");
                        var dateOneObj = new Date(dateTimeF);
                        var dateTwoObj = new Date(dateTimeT);
                        var milliseconds = Math.abs(dateTwoObj - dateOneObj);
                        var att_hours = milliseconds / 36e5;
                        $("#dif_" + row.employee_id).html(att_hours + " hours");
                    } else {
                        document.getElementById("check_attendence_" + row.employee_id).checked = false;
                    }
                    $("#from_time_" + row.employee_id).val(row.punch_in);
                    $("#to_time_" + row.employee_id).val(row.punch_out);
                    // alert(row.punch_out);

                });
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {


                // Initialize the inline Flatpickr for the calendar view
                flatpickr("#flatpickr-inline", {
                    inline: true, // Display the calendar inline
                    defaultDate: "2024-10-17", // Set the default date
                    dateFormat: "Y-m-d" // Date format matching the input
                });
            });
        </script>
    @endsection
