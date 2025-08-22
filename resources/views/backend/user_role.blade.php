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
                                    <li class="breadcrumb-item dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Settings</li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        User Role</li>

                                </ol>
                            </nav>
                            <a href="{{ url('/accounts/user_role_list') }}"><button
                                            class="btn btn-primary btn-sm UserAddButton"
                                            style="float: right;margin-top:-20px;"><i
                                                class="fa fa-angle-double-left"></i>User Role List</button></a>
                        </div>
                        {{-- <div class="card-header">
                                    <h5 class="card-title">User Permission List</h5>
                                </div> --}}
                        <div class="card-block container">
                            <form id="permission_update_form" action="{{ route('admin.user_role.update') }}" method="post"
                                class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-search-input"
                                            class="col-12 col-form-label">Role Name</label>
                                        <div class="col-12">
                                            <input type="text" name="role"
                                                value="@if ($role) {{ $role->name }} @endif"
                                                class="form-control" placeholder="Role Name"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive p-2">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th style="color:white">SL</th>
                                                <th style="color:white">Module Name</th>
                                                <th style="color:white">Restictions <input type="checkbox"
                                                        class="form-check-input" onclick="checkAll(this)"
                                                        style="margin-left: 10px;">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissionCategorys as $key => $value)
                                                <tr
                                                    style="background-color:#6C8BEF; color:white;text-align:center;text-transform:capitalize;font-weight:bolder;">
                                                    <td colspan="3">{{ $key }}</td>
                                                </tr>
                                                @foreach ($value as $permissionCategory)
                                                    <tr>
                                                        <td>{{ $permissionCategory->id }}</td>
                                                        <td>{{ $permissionCategory->title }}</td>
                                                        <td>
                                                            <label class="" style="padding-left: 24px">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="permission[]"
                                                                    value="view {{ $permissionCategory->name }}"
                                                                    @if (in_array("view $permissionCategory->name", $permissions)) checked @endif />
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description">View</span>
                                                            </label>
                                                            <label class="" style="padding-left: 24px">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="permission[]"
                                                                    value="edit {{ $permissionCategory->name }}"
                                                                    @if (in_array("edit $permissionCategory->name", $permissions)) checked @endif />
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description">Edit</span>
                                                            </label>
                                                            <label class="" style="padding-left: 24px">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="permission[]"
                                                                    value="delete {{ $permissionCategory->name }}"
                                                                    @if (in_array("delete $permissionCategory->name", $permissions)) checked @endif />
                                                                <span class="custom-control-indicator"></span>
                                                                <span class="custom-control-description">Delete</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <center>
                                    <button type="submit" class="btn btn-success ">
                                        Update
                                    </button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function checkAll(bx) {
            var cbs = document.getElementsByTagName('input');
            for (var i = 0; i < cbs.length; i++) {
                if (cbs[i].type == 'checkbox') {
                    cbs[i].checked = bx.checked;
                }
            }
        }
        $(document).ready(function() {
            $('#permission_update_form').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                },
                clearForm: false,
                resetForm: false
            });
        });
    </script>
@endsection
