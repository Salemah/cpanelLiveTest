@extends('backend.user_layouts.backendapp')
@section('content')
    <div class="row g-6">
        <!-- Website Analytics -->
        <div class="col-lg-6">
            <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                id="swiper-with-pagination-cards">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Today Appointment</h5>
                                <small>Booking Time: @if ($appointmenttoday)
                                        {{ $appointmenttoday->booking_time }}
                                    @endif
                                </small>
                                <br>
                                <small>Booking Date: @if ($appointmenttoday)
                                        {{ $appointmenttoday->booking_date }}
                                    @endif
                                </small>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Consultant: @if ($appointmenttoday)
                                            {{ $appointmenttoday->employee->name }}
                                        @endif
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0  me-3">Payment Status: </p> <span
                                                        class="badge text-bg-danger">
                                                        @if ($appointmenttoday)
                                                            {{ $appointmenttoday->status }}
                                                        @endif
                                                    </span>
                                                    {{-- <p class="mb-0 bg-danger p-1" >@if ($appointment){{$appointment->status}}@endif</p> --}}
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                    <img src="../../assets/img/illustrations/card-website-analytics-1.png"
                                        alt="Website Analytics" height="150" class="card-website-analytics-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Today Appointment</h5>
                                <small>Booking Time: @if ($appointmentUpComing)
                                        {{ $appointmentUpComing->booking_time }}
                                    @endif
                                </small>
                                <br>
                                <small>Booking Date: @if ($appointmentUpComing)
                                        {{ $appointmentUpComing->booking_date }}
                                    @endif
                                </small>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Consultant: @if ($appointmentUpComing)
                                            {{ $appointmentUpComing->employee->name }}
                                        @endif
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0  me-3">Payment Status: </p> <span
                                                        class="badge text-bg-danger">
                                                        @if ($appointmentUpComing)
                                                            {{ $appointmentUpComing->status }}
                                                        @endif
                                                    </span>
                                                    {{-- <p class="mb-0 bg-danger p-1" >@if ($appointment){{$appointment->status}}@endif</p> --}}
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                    <img src="../../assets/img/illustrations/card-website-analytics-1.png"
                                        alt="Website Analytics" height="150" class="card-website-analytics-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--/ Website Analytics -->
        <div class="col-xl-12 col-sm-12">
            <div class="card-block container">
                <div class="table-responsive" id="tab">
                    <table class="table table-striped table-bordered table-hover"
                        style="border: solid 1px rgba(255, 193, 193, 0.1);" id="team_table">
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Appointment Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Client:</strong> <span id="modalAppointmentName">N/A</span></p>

                        <p><strong>Email:</strong> <span id="modalEmail">N/A</span></p>
                        <p><strong>Phone:</strong> <span id="modalPhone">N/A</span></p>
                        <p><strong>Staff:</strong> <span id="modalStaff">N/A</span></p>
                        <p><strong>Start:</strong> <span id="modalStartTime">N/A</span></p>
                        <p><strong>Amount:</strong> <span id="modalAmount">N/A</span></p>
                        <p><strong>Notes:</strong> <span id="modalNotes">N/A</span></p>
                        <p><strong>Current Status:</strong> <span id="modalStatusBadge">N/A</span>
                        </p>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Average Daily Sales -->
        {{-- <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5 class="mb-3 card-title">Cancel Appointment</h5>
                    <h4 class="mb-0">$28,450</h4>
                </div>
                <div class="card-body px-0">
                    <div id="averageDailySales"></div>
                </div>
            </div>
        </div>
        <!--/ Average Daily Sales -->

        <!-- Sales Overview -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-body">Today Appointment</p>
                        <p class="card-text fw-medium text-success">+18.2%</p>
                    </div>
                    <h4 class="card-title mb-1">$42.5k</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <span class="badge bg-label-info p-1 rounded"><i
                                        class="ti ti-shopping-cart ti-sm"></i></span>
                                <p class="mb-0">Order</p>
                            </div>
                            <h5 class="mb-0 pt-1">62.2%</h5>
                            <small class="text-muted">6,440</small>
                        </div>
                        <div class="col-4">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0">Visits</p>
                                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-sm"></i></span>
                            </div>
                            <h5 class="mb-0 pt-1">25.5%</h5>
                            <small class="text-muted">12,749</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-6">
                        <div class="progress w-100" style="height: 10px;">
                            <div class="progress-bar bg-info" style="width: 70%" role="progressbar" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--/ Sales Overview -->


    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#team_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.myappointment.data') }}",
                    type: 'GET',
                    cache: false
                },
                columns: [{
                        title: 'SL',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Name',
                        data: 'name',
                        name: 'name'
                    },
                    {
                        title: 'Email',
                        data: 'email',
                        name: 'email'
                    },
                    {
                        title: 'Phone',
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        title: 'Consultant',
                        data: 'consultant',
                        name: 'consultant'
                    },
                    {
                        title: 'Date',
                        data: 'date',
                        name: 'date'
                    },

                    {
                        title: 'Payment Date',
                        data: 'payment_date',
                        name: 'payment_date'
                    },

                    {
                        title: 'Status',
                        data: 'status',
                        name: 'status'
                    },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $(document).on('click', '.tableDelete', function() {
                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let Id = $(this).data('id'); // Retrieve the ID for deletion
                        $.ajax({
                            url: "{{ route('admin.account.team.destroy') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#team_table').DataTable().draw(true);

                                Swal.fire("Deleted!",
                                    "The item has been deleted successfully.", {
                                        icon: "success",
                                    });
                            },
                            error: function(xhr) {
                                // Handle error
                                Swal.fire("Error!",
                                    "There was an issue deleting the item.", "error"
                                );
                            }
                        });
                    } else {
                        Swal.fire("Your item is safe!");
                    }
                });
            });


        });
    </script>
    <script>
        $(document).on('click', '.view-appointment-btn', function() {

            // Set modal fields
            $('#modalAppointmentId').val($(this).data('id'));
            $('#modalAppointmentName').text($(this).data('name'));

            $('#modalEmail').text($(this).data('email'));
            $('#modalPhone').text($(this).data('phone'));
            $('#modalStaff').text($(this).data('employee'));
            $('#modalStartTime').text($(this).data('start'));
            $('#modalAmount').text($(this).data('amount'));
            $('#modalNotes').text($(this).data('notes'));
            $('#modalStatus').text($(this).data('nostatustes'));

            // Set status select dropdown
            var status = $(this).data('status');
            $('#modalStatusSelect').val(status);

            // Set status badge
            var statusColors = {
                'Pending payment': '#f39c12',
                'Processing': '#3498db',
                'Confirmed': '#2ecc71',
                'Cancelled': '#ff0000',
                'Completed': '#008000',
                'On Hold': '#95a5a6',
                'Rescheduled': '#f1c40f',
                'No Show': '#e67e22',
            };

            var badgeColor = statusColors[status] || '#7f8c8d';
            $('#modalStatusBadge').html(
                `<span class="badge px-2 py-1" style="background-color: ${badgeColor}; color: white;">${status}</span>`
            );
        });
    </script>
@endsection
