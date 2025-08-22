@extends('backend.layouts.backendapp')
@section('content')

<div class="">
<div class="">
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h6>Password Change</h6>
        </div>
    </div>
    <div class="card-block container py-2">
        <form method="POST" action="{{ route('account.profile.change.password.insert') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6">

                            <label>Current Password:</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="">
                            @if(Session::has('current_password_not_valid'))

                                <strong>{{ Session::get('current_password_not_valid') }}</strong>

                            @endif
                            @error('current_password')

                                <strong>{{ $message }}</strong>
                          
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label>New Password:</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="">
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(Session::has('current_password_and_new_password_not_correct'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ Session::get('current_password_and_new_password_not_correct') }}</strong>
                            </span>
                            @endif
                        </div>
                        @if(Session::has('success'))
                        <label>{{ Session::get('success') }}</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-lg-12 my-2">
                    <hr>
                    <center>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

</div>
@endsection
