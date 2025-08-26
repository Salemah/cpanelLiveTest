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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Contact</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Payment Receive</li>
                                </ol>
                            </nav>

                            <a type="button" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"
                                href="{{ route('admin.account.team.create') }}">+ Add New Team</a>

                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="team_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <form id="appointmentStatusForm" method="POST" action="{{ route('admin.payment.update.status') }}">
        @csrf
        <input type="hidden" name="appointment_id" id="modalAppointmentId">

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


                        <div class="form-group ">
                            <label><strong>Status:</strong></label>
                            <select name="status" class="form-control" id="modalStatusSelect">
                                <option value="Pending payment">Pending payment</option>
                                <option value="Processing">Processing</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Completed">Completed</option>
                                <option value="On Hold">On Hold</option>
                                {{-- <option value="Rescheduled">Rescheduled</option> --}}
                                <option value="No Show">No Show</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" onclick="return confirm('Are you sure you want to update booking status?')"
                            class="btn btn-danger">Update Status</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {


            $('#team_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.payment_recieve.data') }}",
                    type: 'GET',
                    cache: false
                },
                columns: [{
                        title: 'SL',
                        data: 'id',
                        name: 'id'
                    },

                    {
                        title: 'Booking Date',
                        data: 'date',
                        name: 'date'
                    },
                    {
                        title: 'Payment Date',
                        data: 'payment_date',
                        name: 'payment_date'
                    },
                    {
                        title: 'Payer Number',
                        data: 'payer_number',
                        name: 'payer_number'
                    },
                    {
                        title: 'Transaction ID',
                        data: 'trx_id',
                        name: 'trx_id'
                    },
                    {
                        title: 'Customer Name',
                        data: 'name',
                        name: 'name'
                    },
                    {
                        title: 'Consultant',
                        data: 'team',
                        name: 'team'
                    },

                    {
                        title: 'amount',
                        data: 'amount',
                        name: 'amount'
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
                    },

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
