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
                                    <li class="breadcrumb-item active" aria-current="page">AboutUs List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm AboutUsAddButton"
                                style="float: right;margin-top:-20px;"><i class="fa fa-plus"></i>AboutUs Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="AboutUs_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="AboutUsAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="AboutUs_insert_update" action="{{ route('admin.account.about_us.insert') }}" accept-charset="utf-6"
                enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">AboutUs Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="" id="hidden-id" />

                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" name="title" id="title" placeholder="Title...."
                                    class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" id="name" placeholder="name...."
                                    class="form-control">
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Description:</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control ckeditor"></textarea>
                            </div>

                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Cases:</label>
                                <input name="cases" placeholder="Cases" class="form-control" id="cases">
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

                            <div class="form-group col-4 mb-2">
                                <label for="favicon">Upload Image Two<span class="text-danger">*</span> <span
                                        class="text-danger">( Size: 600*399)</span></label>
                                <input type="file" id="image_two" data-height="290" class="dropify form-control "
                                    name="image_two">

                            </div>
                            <div class="form-group col-2">
                                <img src="" id="image_two_edit" style="width: 40px; height:auto;" alt="">
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


            $('#AboutUs_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.about_us.data') }}",
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
                        title: 'Title',
                        data: 'title',
                        name: 'title'
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

            $('#AboutUs_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#AboutUs_table').DataTable().draw(true);

                    $("#AboutUsAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

            $(document).on('click', '.AboutUsAddButton', function() {

                $('#hidden-id').attr("disabled", "true");
                $("#AboutUsAdd").modal('show');
                var customerId = "T" + generator.AboutUsAdd();
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
                            url: "{{ route('admin.account.about_us.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#AboutUs_table').DataTable().draw(true);

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
                    url: "{{ route('admin.account.about_us.edit') }}",
                    success: function(responseText) {
                        console.log(responseText);

                        $('input[name^="title"]').val(responseText.data.title);
                        // $('input[name^="description"]').val(responseText.data.description);
                        $('input[name^="name"]').val(responseText.data.name);
                        $('input[name^="cases"]').val(responseText.data.cases);
                        // $('textarea[name^="address"]').val(responseText.data.address);


                        if (responseText.data.description) {
                            tinymce.get('description').setContent(responseText.data
                                .description);
                        }

                        $('select[name^="status"]').val(responseText.data.status);


                        const baseUrl = "{{ asset('/') }}";

                        let imageName = responseText.data.image;

                        let imageUrl = baseUrl + imageName;

                        let imageNameTwo = responseText.data.image_two;
                        let imageUrleTwo = baseUrl + imageNameTwo;


                        $('#imageedit').attr('src', imageUrl);
                        $('#image_two_edit').attr('src', imageUrleTwo);
                        $("#AboutUsAdd").modal('show');
                    }
                });
            });
            $('#AboutUsAdd').on('hidden.bs.modal', function() {
                $('#AboutUs_insert_update')[0].reset(); // Clear the form data
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
