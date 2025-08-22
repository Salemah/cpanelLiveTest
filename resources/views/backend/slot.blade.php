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
                                    <li class="breadcrumb-item active" aria-current="page">Slot List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm SlotAddButton" style="float: right;margin-top:-20px;"><i
                                    class="fa fa-plus"></i>Slot Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="Slot_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="SlotAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="Slot_insert_update" action="{{ route('admin.account.slot.insert') }}" accept-charset="utf-6"
                enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Slot Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-12 mb-4">
                                <label for="team_id"><b>User</b><span class="text-danger">*</span></label>
                                <select name="team_id" id="team_id" class="form-select">
                                    <option>--Select User--</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">
                                            {{ $team->name }}</option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    <span class="alert text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Saturday" name="days[1]" value="Saturday">
                                <label for="Saturday"> Saturday</label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="time" class="Saturday form-control" name="from_time_saturday[]" />
                                    </div>
                                    <div class="col-2"> <button type="button" class="btn btn-sm btn-primary add_document"
                                            data-ids="satutdayRow" data-dayname="from_time_saturday"
                                            data-day_week="Saturday"><i class="fa-solid fa-plus "></i></button></div>
                                </div>


                                <div class="" id="satutdayRow">

                                </div>

                            </div>
                            {{-- <div class="col-md-2">

                                </div> --}}

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Sunday" name="days[2]" value="Sunday">
                                <label for="Sunday"> Sunday</label>

                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10"><input type="time" class="Sunday form-control"
                                            name="from_time_sunday[]" /></div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-sm btn-primary add_document"
                                            data-ids="sundayRow" data-dayname="from_time_sunday" data-day_week="Sunday"
                                            id="add_sunday"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>


                                <div class="" id="sundayRow">

                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Monday" name="days[3]" value="Monday">
                                <label for="Monday"> Monday</label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10"> <input type="time" class="Monday form-control"
                                            name="from_time_monday[]" /></div>
                                    <div class="col-2"><button type="button"
                                            class="btn btn-sm btn-primary  add_document" data-ids="mondayRow"
                                            data-dayname="from_time_monday" data-day_week="Monday" id="add_monday"><i
                                                class="fa-solid fa-plus"></i></button></div>
                                </div>


                                <div class="" id="mondayRow">

                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Tuesday" name="days[4]" value="Tuesday">
                                <label for="Tuesday"> Tuesday</label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10"> <input type="time" class="Tuesday form-control"
                                            name="from_time_tuesday[]" /></div>
                                    <div class="col-2"><button type="button"
                                            class="btn btn-sm btn-primary  add_document" data-ids="tuesdayRow"
                                            data-dayname="from_time_tuesday" data-day_week="Tuesday" id="add_tuesday"><i
                                                class="fa-solid fa-plus"></i></button></div>
                                </div>


                                <div class="" id="tuesdayRow">

                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Wednesday" name="days[5]" value="Wednesday">
                                <label for="Wednesday"> Wednesday</label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10"> <input type="time" class="Wednesday form-control"
                                            name="from_time_wednesday[]" /></div>
                                    <div class="col-2"> <button type="button"
                                            class="btn btn-sm btn-primary  add_document" data-ids="wednesdayRow"
                                            data-dayname="from_time_wednesday" data-day_week="Wednesday"
                                            id="add_wednesday"><i class="fa-solid fa-plus"></i></button></div>
                                </div>


                                <div class="" id="wednesdayRow">

                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Thursday" name="days[6]" value="Thursday">
                                <label for="Thursday"> Thursday</label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10"><input type="time" class="Thursday form-control"
                                            name="from_time_thursday[]" /></div>
                                    <div class="col-2"> <button type="button"
                                            class="btn btn-sm btn-primary  add_document" data-ids="thursdayRow"
                                            data-dayname="from_time_thursday" data-day_week="Thursday"
                                            id="add_thursday"><i class="fa-solid fa-plus"></i></button></div>
                                </div>


                                <div class="" id="thursdayRow">

                                </div>
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Friday" name="days[7]" value="Friday">
                                <label for="Friday"> Friday</label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10"><input type="time" class="Friday form-control"
                                            name="from_time_friday[]" /></div>
                                    <div class="col-2"> <button type="button"
                                            class="btn btn-sm btn-primary  add_document" data-ids="fridayRow"
                                            data-dayname="from_time_friday" data-day_week="Friday" id="add_friday"><i
                                                class="fa-solid fa-plus"></i></button></div>
                                </div>


                                <div class="" id="fridayRow">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="SlotEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="Slot_edit_insert_update" action="{{ route('admin.account.slot.insert') }}" accept-charset="utf-6"
                enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Slot Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="" id="hidden-id" />
                            <div class="form-group col-12 mb-4">
                                <label for="team_id"><b>User</b><span class="text-danger">*</span></label>
                                <select name="team_id" id="team_id" class="form-select">
                                    <option>--Select User--</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">
                                            {{ $team->name }}</option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    <span class="alert text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 my-2">
                                <input type="checkbox" id="Saturday" name="days[1]" value="Saturday">
                                <label for="Saturday" id="editday"> </label>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="time" class="form-control"
                                            name="from_time" id="editday_time" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#Slot_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.slot.data') }}",
                    type: 'GET',
                    cache: false
                },
                columns: [{
                        title: 'SL',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Team',
                        data: 'team',
                        name: 'team'
                    },
                    {
                        title: 'Day',
                        data: 'day',
                        name: 'day'
                    },
                    {
                        title: 'Time',
                        data: 'time',
                        name: 'time'
                    },
                    // {
                    //     title: 'Practice Area',
                    //     data: 'legal_area',
                    //     name: 'legal_area'
                    // },
                    // {
                    //     title: 'Status',
                    //     data: 'status',
                    //     name: 'status'
                    // },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $(document).on('click', '.SlotAddButton', function() {
                // $("#customer_insert_update").trigger("reset");
                $('#hidden-id').attr("disabled", "true");
                $("#SlotAdd").modal('show');
            });
            $('#Slot_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#Slot_table').DataTable().draw(true);

                    $("#SlotAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });
            $('#Slot_edit_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#Slot_table').DataTable().draw(true);

                    $("#SlotEdit").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });
            var satutdayx = 0;
            $(".add_document").click(function() {
                let rowId = $(this).data("ids");
                let dayName = $(this).data("dayname");
                let day_week = $(this).data("day_week");

                satutdayx++;
                $('#' + rowId).append('<div class="row mt-2 document-table-tr" id="document-table-tr-' +
                    satutdayx +
                    '">' +
                    '<div class="col-md-5 document">' +
                    ' <div class="form-group">' +
                    '<input type="time" class="form-control  ' + day_week + '" name="' + dayName +
                    '[]" />' +
                    '</div>' +
                    ' </div>' +
                    '<div class="col-sm-1 ">' +
                    '<button type="button"  class=" btn btn-sm btn-danger " onclick="documentRemove(' +
                    satutdayx + ')">' +
                    'X' +
                    '</button>' +
                    '</div>' +
                    '</div>');
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
                            url: "{{ route('admin.account.slot.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#Slot_table').DataTable().draw(true);

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
            $(document).on('click', '.tableEdit', function() {
                let Id = $(this).data('id');
                $('#hidden-id').removeAttr("disabled");
                $('#hidden-id').val(Id);

                $(this).ajaxSubmit({
                    error: formError,
                    data: {
                        "id": Id
                    },
                    dataType: 'json',
                    method: 'GET',
                    url: "{{ route('admin.account.slot.edit') }}",
                    success: function(responseText) {

                        $('input[name^="title"]').val(responseText.data.title);
                        $('#editday_time').val(responseText.data.from_time);
                        $('select[name^="team_id"]').val(responseText.data.team_id);
                        $('#editday').html(responseText.data.day)

                        $("#SlotEdit").modal('show');
                    }
                });
            });
        });

        function documentRemove(id) {
            $('#document-table-tr-' + id).remove();
        }
    </script>
@endsection
