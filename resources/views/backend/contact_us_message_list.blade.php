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
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us Message List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm ContactUsMessageAddButton"
                                style="float: right;margin-top:-20px;"><i class="fa fa-plus"></i>Contact Us Message
                                Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="ContactUsMessage_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="ContactUsMessageAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="ContactUsMessage_insert_update" action="{{ route('account.contact_us_message.insert') }}"
                accept-charset="utf-6" enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Us Message Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="" id="hidden-id" />
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" id="name" placeholder="Office Loc...."
                                    class="form-control">
                            </div>

                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Phone:</label>
                                <input name="phone" class="form-control" id="phone">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input name="email" class="form-control" id="email">
                            </div>

                            <div class="form-group col-4 mb-2" style="display: none">
                                <label for="favicon">Upload Image<span class="text-danger">*</span> <span
                                        class="text-danger">( Size: 600*600)</span></label>
                                <input type="file" id="image" data-height="290" class="dropify form-control "
                                    name="image">

                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Message:</label>
                                <textarea name="message" id="message" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                              <div class="form-group col-6 col-sm-6 col-md-6 mb-2">
                                <label for="favicon">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Replied">Replied</option>
                                </select>

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


            $('#ContactUsMessage_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.contact_us_message.data') }}",
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
                        title: 'Message',
                        data: 'message',
                        name: 'message'
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

            $('#ContactUsMessage_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#ContactUsMessage_table').DataTable().draw(true);

                    $("#ContactUsMessageAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

            $(document).on('click', '.ContactUsMessageAddButton', function() {

                $("#customer_insert_update").trigger("reset");
                $('#hidden-id').attr("disabled", "true");
                $("#ContactUsMessageAdd").modal('show');
                var customerId = "T" + generator.ContactUsMessageAdd();
                $('input[name^="contact_code"]').val(customerId);

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
                            url: "{{ route('account.contact_us_message.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#ContactUsMessage_table').DataTable().draw(true);

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
                    url: "{{ route('admin.account.contact_us_message.edit') }}",
                    success: function(responseText) {

                        $('input[name^="name"]').val(responseText.data.name);
                        $('input[name^="phone"]').val(responseText.data.phone);
                        $('input[name^="email"]').val(responseText.data.email);
                        $('#message').val(responseText.data.message);
                        $('select[name^="status"]').val(responseText.data.status);
                        // const baseUrl = "{{ asset('/') }}";
                        // $('select[name^="status"]').val(responseText.data.status);
                        // let imageName = responseText.data.image;
                        // let imageUrl = baseUrl + imageName;


                        console.log(responseText.data.message);

                        // $('#imageedit').attr('src', imageUrl);


                        $("#ContactUsMessageAdd").modal('show');
                    }
                });
            });
            $('#ContactUsMessageAdd').on('hidden.bs.modal', function() {
                $('#ContactUsMessage_insert_update')[0].reset(); // Clear the form data
            });
            $('.modal').on('show.bs.modal', function() {
                let drEvent = $('#image').dropify();
                drEvent = drEvent.data('dropify');
                drEvent.resetPreview();
                drEvent.clearElement();
            });
        });
    </script>
@endsection
