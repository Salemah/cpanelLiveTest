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
                                    <li class="breadcrumb-item active" aria-current="page">Testimonial List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm TestimonialAddButton"
                                style="float: right;margin-top:-20px;"><i class="fa fa-plus"></i>Testimonial Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="Testimonial_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="TestimonialAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="Testimonial_insert_update" action="{{ route('admin.account.testimonial.insert') }}"
                accept-charset="utf-6" enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Testimonial Add</h1>
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
                                <label for="recipient-name" class="col-form-label">Description:</label>
                                <textarea name="description" class="form-control ckeditor" id="description" cols="30" rows="10"></textarea>
                            </div>
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Quote By:</label>
                                <input name="quote_by" class="form-control" id="quote_by">
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


            $('#Testimonial_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.testimonial.data') }}",
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
                        title: 'Quote By',
                        data: 'quote_by',
                        name: 'quote_by'
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

            $('#Testimonial_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#Testimonial_table').DataTable().draw(true);

                    $("#TestimonialAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

            $(document).on('click', '.TestimonialAddButton', function() {

                $("#customer_insert_update").trigger("reset");
                $('#hidden-id').attr("disabled", "true");
                $("#TestimonialAdd").modal('show');
                var customerId = "T" + generator.TestimonialAdd();
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
                            url: "{{ route('admin.account.testimonial.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#Testimonial_table').DataTable().draw(true);

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
                    url: "{{ route('admin.account.testimonial.edit') }}",
                    success: function(responseText) {

                        $('input[name^="title"]').val(responseText.data.title);
                        $('input[name^="quote_by"]').val(responseText.data.quote_by);

                      tinymce.get('description').setContent(responseText.data.description);
                        $('select[name^="status"]').val(responseText.data.status);

                        $("#TestimonialAdd").modal('show');
                    }
                });
            });

        });
    </script>
@endsection
