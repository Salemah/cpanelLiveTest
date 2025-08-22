{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('backend.layouts.backendapp')
@section('content')
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Personal Info</h6>
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                <div class="card-block container py-2">
                    <div class="row">
                        <form class="col-sm-12" method="POST" action="{{ route('account.profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">



                                    <div class="col-lg-6 col-md-6">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $users_details->email }}" readonly>
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Your Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $users_details->name }}" required>
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="mobile"
                                            value="{{ $users_details->phone }}" required>
                                        @error('mobile')
                                            <span class="error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                        <label>Profile Picture <span class="text-danger">Size :(100*100)</span></label>
                                        <input type="file" class="form-control" name="image">
                                        @error('image')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($users_details->image)
                                        <div class="col-lg-2 col-md-2">
                                            <img src="{{ asset($users_details->image) }}" class="mt-3"
                                                style="width: 40px; height:auto;" alt="Not Found!">
                                        </div>
                                    @else
                                        <div class="col-lg-2 col-md-2">
                                            <span>No Image!</span>
                                        </div>
                                    @endif

                                    {{-- <div class="col-lg-2 col-md-2">
                                                <label>Signature</label>
                                                <input type="file" class="form-control" name="signature"  >
                                                @error('signature') <span class="error">{{ $message }}</span> @enderror
                                            </div> --}}
                                    {{-- @if ($users_details->signature)
                                            <div class="col-lg-2 col-md-2">
                                                <img src="{{ asset($users_details->signature) }}" class="mt-3" style="width: 40px; height:auto;" alt="Not Found!">
                                            </div>
                                            @else
                                            <div class="col-lg-2 col-md-2">
                                            <span>No Image!</span>
                                            </div>
                                            @endif --}}


                                    <!--div class="form-group row">
                                                <div class="col-lg-6 col-md-6">
                                                <label>Subdomain</label>
                                                <input type="subdomain" class="form-control" placeholder="subdomain">
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                <label>Service Type:</label>
                                                <input type="text" class="form-control" placeholder="Service Type:" >
                                                </div>
                                            </div-->


                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Address"
                                                value="{{ $users_details->address }}">
                                            @error('address')
                                                <span class="error">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 my-2">
                                            <center><button type="submit" class="btn btn-primary">Update Profile</button>
                                            </center>
                                        </div>
                                    </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
