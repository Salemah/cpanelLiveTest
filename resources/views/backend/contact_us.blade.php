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
                                    <li class="breadcrumb-item active" aria-current="page">ContactUs List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm ContactUsAddButton"
                                style="float: right;margin-top:-20px;"><i class="fa fa-plus"></i>ContactUs Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="ContactUs_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="ContactUsAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="ContactUs_insert_update" action="{{ route('admin.account.contact_us.insert') }}"
                accept-charset="utf-6" enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">ContactUs Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="" id="hidden-id" />
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Office:</label>
                                <input type="text" name="office" id="office" placeholder="Office Loc...."
                                    class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Address:</label>
                                <textarea name="address" id="address" cols="30" rows="10" class="form-control "></textarea>

                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Phone:</label>
                                <input name="phone" class="form-control" id="phone">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input name="email" class="form-control" id="email">
                            </div>

                            <div class="form-group col-4 mb-2">
                                <label for="favicon">Upload Image<span class="text-danger">*</span> <span
                                        class="text-danger">( Size: 600*399)</span></label>
                                <input type="file" id="image" data-height="290" class="dropify form-control "
                                    name="image">

                            </div>
                            <div class="form-group col-2">
                                <img src="" id="imageedit" style="width: 40px; height:auto;" alt="">


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


            $('#ContactUs_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.contact_us.data') }}",
                    type: 'GET',
                    cache: false
                },
                columns: [{
                        title: 'SL',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Office',
                        data: 'office',
                        name: 'office'
                    },
                    {
                        title: 'Address',
                        data: 'address',
                        name: 'address'
                    },
                    {
                        title: 'Phone',
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        title: 'Email',
                        data: 'email',
                        name: 'email'
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

            $('#ContactUs_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#ContactUs_table').DataTable().draw(true);

                    $("#ContactUsAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

            $(document).on('click', '.ContactUsAddButton', function() {

                $("#customer_insert_update").trigger("reset");
                $('#hidden-id').attr("disabled", "true");
                $("#ContactUsAdd").modal('show');
                var customerId = "T" + generator.ContactUsAdd();
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
                            url: "{{ route('admin.account.contact_us.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#ContactUs_table').DataTable().draw(true);

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
                    url: "{{ route('admin.account.contact_us.edit') }}",
                    success: function(responseText) {

                        $('input[name^="office"]').val(responseText.data.office);
                        $('input[name^="phone"]').val(responseText.data.phone);
                        $('input[name^="email"]').val(responseText.data.email);
                         $('textarea[name^="address"]').val(responseText.data.address);
///tinymce.get('address').setContent(responseText.data.address);
                        const baseUrl = "{{ asset('/') }}";
                        $('select[name^="status"]').val(responseText.data.status);
                        let imageName = responseText.data.image;
                        let imageUrl = baseUrl + imageName;


                        console.log(imageUrl);

                        $('#imageedit').attr('src', imageUrl);


                        $("#ContactUsAdd").modal('show');
                    }
                });
            });
            $('#ContactUsAdd').on('hidden.bs.modal', function() {
                $('#ContactUs_insert_update')[0].reset(); // Clear the form data
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
