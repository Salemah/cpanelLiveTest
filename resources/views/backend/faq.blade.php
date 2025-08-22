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
                                    <li class="breadcrumb-item active" aria-current="page">Faq List</li>
                                </ol>
                            </nav>
                            {{-- <a href="{{ route('account.sale_list') }}" class="btn btn-primary btn-sm" style="float: right;margin-top:-20px;"><i class="fa fa-angle-double-left"></i> {{ __('messages.Sale List') }}</a> --}}
                            <button class="btn btn-primary btn-sm FaqAddButton"
                                style="float: right;margin-top:-20px;"><i class="fa fa-plus"></i>Faq Add</button>
                        </div>

                        <div class="card-block container">
                            <div class="table-responsive" id="tab">
                                <table class="table table-striped table-bordered table-hover"
                                    style="border: solid 1px rgba(255, 193, 193, 0.1);" id="Faq_table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="FaqAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="Faq_insert_update" action="{{ route('admin.account.faq.insert') }}"
                accept-charset="utf-6" enctype="multipart/form-data" method="post" class="form-horizontal validatable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Faq Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="" id="hidden-id" />
                            <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Question:</label>
                                <input type="text" name="question" id="question" class="form-control">
                            </div>
                             <div class="col-6 mb-6">
                                <label for="recipient-name" class="col-form-label">Answer:</label>
                                <textarea name="answer" class="form-control ckeditor" id="answer" cols="30" rows="5"></textarea>
                            </div>
                                <div class="form-group col-6 mb-3">
                                <label for="recipient-name" class="col-form-label">Faq Category:</label>
                                <select name="faq_category" id="faq_category" class="form-control" >


                                </select>
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


            $('#Faq_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.account.faq.data') }}",
                    type: 'GET',
                    cache: false
                },
                columns: [{
                        title: 'SL',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Question',
                        data: 'question',
                        name: 'question'
                    },


                    {
                        title: 'Answer',
                        data: 'answer',
                        name: 'answer'
                    },
                    {
                        title: 'Category',
                        data: 'category',
                        name: 'category'
                    },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

            $('#Faq_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#Faq_table').DataTable().draw(true);

                    $("#FaqAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

            $(document).on('click', '.FaqAddButton', function() {

                $("#customer_insert_update").trigger("reset");
                $('#hidden-id').attr("disabled", "true");
                $("#FaqAdd").modal('show');
                var customerId = "T" + generator.FaqAdd();
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
                            url: "{{ route('admin.account.faq.insert') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Include CSRF token for security
                                delete: Id
                            },
                            success: function(response) {
                                // Assuming the deletion was successful, refresh the table
                                $('#Faq_table').DataTable().draw(true);

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
                    url: "{{ route('admin.account.faq.edit') }}",
                    success: function(responseText) {

                        $('input[name^="question"]').val(responseText.data.question);
                        $('select[name^="status"]').val(responseText.data.status);
                        if (responseText.data.answer) {
                            tinymce.get('answer').setContent(responseText.data
                            .answer);
                        }

                        $("#FaqAdd").modal('show');
                    }
                });
            });
            $('#faq_category').select2({
                dropdownParent: $('#FaqAdd .modal-content'),
                placeholder: 'Select Faq Category',
                ajax: {
                    url: '{{ route('admin.account.faq_category.search') }}',
                    dataType: 'json',
                    type: "GET",
                    data: function(data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }

            });

        });
    </script>
@endsection
