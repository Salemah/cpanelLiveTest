@extends('backend.layouts.backendapp')
@push('css')
@endpush
@section('content')
    <form id="remainder_insert_update" action="{{ route('admin.company.setting.insert') }}" accept-charset="utf-8"
        enctype="multipart/form-data" method="post" class="form-horizontal validatable">
        @csrf
        <div class="row">

            <div class="card">

                <div class="card-block container py-5">
                    <div class="row">
                        <input type="hidden" name="id" value="@if($DashboardSetting){{$DashboardSetting->id}}@endif" id="hidden-id" disabled />
                        <div class="col-12 my-3">
                            <label class="form-label" for="fullname">Company Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="title" value="@if($DashboardSetting){{$DashboardSetting->title}}@endif" name="system_title" class="form-control" placeholder="Ac..." />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Phone <span class="text-danger">*</span> </label>
                            <input type="text" id="phone" name="phone" value="@if($DashboardSetting){{$DashboardSetting->phone}}@endif"  class="form-control"
                                placeholder="01111111111" />
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Email <span class="text-danger">*</span> </label>
                            <input type="email" id="email" name="email" value="@if($DashboardSetting){{$DashboardSetting->email}}@endif" class="form-control" placeholder="Email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Facebook <span class="text-danger">*</span> </label>
                            <input type="text" id="facebook" name="facebook" value="@if($DashboardSetting){{$DashboardSetting->facebook}}@endif" class="form-control"
                                placeholder="Facebook" />
                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Linkedin <span class="text-danger">*</span> </label>
                            <input type="text" id="linkedin" name="linkedin" value="@if($DashboardSetting){{$DashboardSetting->linkedin}}@endif" class="form-control"
                                placeholder="Linkedin" />
                            @error('linkedin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Twitter <span class="text-danger">*</span> </label>
                            <input type="text" id="twitter" name="twitter" value="@if($DashboardSetting){{$DashboardSetting->twitter}}@endif" class="form-control"
                                placeholder="Twitter" />
                            @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Address <span class="text-danger">*</span> </label>
                            <input type="text" id="address" name="address" value="@if($DashboardSetting){{$DashboardSetting->address}}@endif" class="form-control"
                                placeholder="Address" />
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Copyright <span class="text-danger">*</span> </label>
                            <input type="text" id="copyright" name="copyright" value="@if($DashboardSetting){{$DashboardSetting->copyright}}@endif" class="form-control"
                                placeholder="Copyright" />
                            @error('copyright')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 my-3">
                            <label class="form-label" for="fullname">Website <span class="text-danger">*</span> </label>
                            <input type="text" id="website" name="website" value="@if($DashboardSetting){{$DashboardSetting->website}}@endif" class="form-control"
                                placeholder="Website" />
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 my-3">
                            <label class="form-label" for="fullname">Description <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="description" value="@if($DashboardSetting){{$DashboardSetting->description}}@endif" name="description" class="form-control"
                                placeholder="Description" />
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 mb-2">
                            <label for="logo">Upload Logo<span class="text-danger">*</span></label>
                            <input type="file" id="logo" data-height="290"
                                @if ($DashboardSetting) data-default-file="{{ asset('image/dashboard/' . $DashboardSetting->logo) }}" @endif
                                class="dropify form-control @error('logo') is-invalid @enderror" name="logo">
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 mb-2">
                            <label for="favicon">Upload Favicon<span class="text-danger">*</span></label>
                            <input type="file" id="favicon" data-height="290"
                                @if ($DashboardSetting) data-default-file="{{ asset('image/dashboard/' . $DashboardSetting->favicon) }}" @endif
                                class="dropify form-control " name="favicon">

                        </div>
                        <button type="submit" style="width: 10%;margin:auto" class="btn btn-primary">Submit</button>

                    </div>

                </div>
            </div>

        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            console.log('Form submitted successfully');
                $('#remainder_insert_update').ajaxForm({
                beforeSend: formBeforeSend,
                beforeSubmit: formBeforeSubmit,
                error: formError,
                success: function(responseText, statusText, xhr, $form) {
                    formSuccess(responseText, statusText, xhr, $form);
                    $('#pending_task_table').DataTable().draw(true);
                    $("#RemainderAdd").modal('hide');
                    $('#hidden-id').setAttribute("disabled");
                },
                clearForm: true,
                resetForm: true


            });
        });
    </script>
@endsection
