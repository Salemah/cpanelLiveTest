@extends('backend.layouts.backendapp')
@push('css')
@endpush
@section('content')
      <div class="">
        <div class="">
            <div class="row">
                <div class="col-sm-16 col-md-16">
                    <div class="card">
                        <div class="card-header align-items-center justify-content-between d-flex">
                            <nav aria-label="breadcrumb" style="margin-top:-10px;">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">User Role List</li>

                                </ol>
                            </nav>
                            <a href="{{route('admin.user-role')}}"><button class="btn btn-primary btn-sm UserAddButton" style="float: right;margin-top:-20px;"><i
                                class="fa fa-plus"></i>Add New Role</button></a>
                        </div>
                        {{-- <div class="card-footer align-items-center justify-content-between d-flex">
                            <button class="btn btn-outline-success pull-right">User Role</button>
                            <a href="{{route('user-role')}}"><button class="btn btn-primary LeaveApplicationAddButton"><i class="fa fa-plus"></i>Add New Role') }} </button></a>
                        </div> --}}
                        <div class="card-block">
                            <div class="table-responsive">
                                <table id="leave_application_table" class="table table-striped table-bordered table-hover"
                                    >
                                    <thead class="bg-primary text-light" >
                                        <tr>
                                            <th  style="color:white">SL</th>
                                            <th style="color:white">Role Name</th>
                                            <th style="color:white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($role_permissions as $role_permission)
                                        <tr>
                                            <td>{{$role_permission->id}}</td>
                                            <td style="text-transform:capitalize;">{{$role_permission->name}}</td>
                                            <td>
                                                <a href="{{route('admin.user-role',['role'=>$role_permission->name])}}" class="btn btn-primary"> View</a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        $(document).ready(function() {

            $('#leave_application_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#leave_application_table').DataTable().draw(true);
                    $("#LeaveApplicationAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");

                },
                clearForm: true,
                resetForm: true
            });

        });
    </script>
@endsection
