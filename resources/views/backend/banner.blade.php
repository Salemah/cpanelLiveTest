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
                                    <li class="breadcrumb-item active" aria-current="page">Banner List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm bannerAddButton" style="float: right;margin-top:-20px;"><i
                                    class="fa fa-plus"></i>Banner Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="banner_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="bannerAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="banner_insert_update" action="{{ route('admin.account.banner.insert') }}" accept-charset="utf-6"
                enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Banner Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="" id="hidden-id" />
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Sub Title:</label>
                                <input type="text" name="sub_title" id="sub_title" class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Icon:</label>
                                <input type="text" name="icon" id="icon" class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Description:</label>
                                <textarea name="description" class="form-control ckeditor" id="description" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group col-4 mb-2">
                                <label for="favicon">Upload Image<span class="text-danger">*</span> <span class="text-danger">( Size: 600*600)</span></label>
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


            $('#banner_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.banner.data') }}",
                    type: 'GET',
                    cache: false
                },
                columns: [{
                        title: 'SL',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Title',
                        data: 'title',
                        name: 'title'
                    },
                    {
                        title: 'Name',
                        data: 'name',
                        name: 'name'
                    },
                    {
                        title: 'Sub Title',
                        data: 'sub_title',
                        name: 'sub_title'
                    },
                    {
                        title: 'Description',
                        data: 'description',
                        name: 'description'
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

            $('#banner_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#banner_table').DataTable().draw(true);

                    $("#bannerAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

            $(document).on('click', '.bannerAddButton', function() {
                $('#hidden-id').attr("disabled", "true");
                $("#bannerAdd").modal('show');
                var customerId = "T" + generator.bannerAdd();
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
                            url: "{{ route('admin.account.banner.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#banner_table').DataTable().draw(true);

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
                    url: "{{ route('admin.account.banner.edit') }}",
                    success: function(responseText) {

                        $('input[name^="title"]').val(responseText.data.title);
                        $('input[name^="sub_title"]').val(responseText.data.sub_title);
                        $('input[name^="name"]').val(responseText.data.name);
                        $('input[name^="icon"]').val(responseText.data.icon);
                        tinymce.get('description').setContent(responseText.data.description);

                        const baseUrl = "{{ asset('/') }}";
                        $('select[name^="status"]').val(responseText.data.status);
                        let imageName = responseText.data.image;
                        let imageUrl = baseUrl + imageName;


                        console.log(imageUrl);

                        $('#imageedit').attr('src', imageUrl);


                        $("#bannerAdd").modal('show');
                    }
                });
            });
            $('#bannerAdd').on('hidden.bs.modal', function() {
                $('#banner_insert_update')[0].reset(); // Clear the form data
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
