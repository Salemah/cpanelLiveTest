@extends('frontend.layers.master')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    <!-- section begin -->
    <section id="subheader" class="jarallax text-white">
        <img src="images/background/subheader2.jpg" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Contact Us</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section aria-label="section">
        <div class="container">
            <div class="row">
                @if ($ContactUs)
                    @foreach ($ContactUs as $contact)
                        <div class="col-12">
                            <img src="{{ asset($contact->image) }}" alt="" class="img-fluid mb30">
                            <h3>{{ $contact->office }}</h3>
                            <address class="s1">
                                <span><i class="id-color fa fa-map-marker fa-lg me-1"></i> {{ $contact->address }}</span>
                                <span><i class="id-color fa fa-phone fa-lg"></i>{{ $contact->phone }}</span>
                                <span><i class="id-color fa fa-envelope-o fa-lg"></i><a
                                        href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></span>
                                {{-- <span><i class="id-color fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span> --}}
                            </address>
                        </div>
                    @endforeach
                @endif

                {{-- <div class="col-md-4">
                    <img src="images/misc/p2.jpg" alt="" class="img-fluid mb30">
                    <h3>UK Office</h3>
                    <address class="s1">
                        <span><i class="id-color fa fa-map-marker fa-lg"></i>100 Mainstreet Center, Sydney</span>
                        <span><i class="id-color fa fa-phone fa-lg"></i>+61 333 9296</span>
                        <span><i class="id-color fa fa-envelope-o fa-lg"></i><a
                                href="mailto:contact@example.com">contact@example.com</a></span>
                        <span><i class="id-color fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span>
                    </address>
                </div>
                <div class="col-md-4">
                    <img src="images/misc/p3.jpg" alt="" class="img-fluid mb30">
                    <h3>AU Office</h3>
                    <address class="s1">
                        <span><i class="id-color fa fa-map-marker fa-lg"></i>100 Mainstreet Center, Sydney</span>
                        <span><i class="id-color fa fa-phone fa-lg"></i>+61 333 9296</span>
                        <span><i class="id-color fa fa-envelope-o fa-lg"></i><a
                                href="mailto:contact@example.com">contact@example.com</a></span>
                        <span><i class="id-color fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span>
                    </address>
                </div> --}}
            </div>
        </div>
    </section>
    <section aria-label="section" class="text-light" data-bgcolor="#111111">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully completed!</strong>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>{{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 offset-lg-2 mb-sm-30 text-center">
                    <h3>Do you have any question?</h3>
                    <form name="contactForm" id="contact_form" class="form-border" method="post"
                        action="{{ route('account.contact_us_message.insert') }}">
                        @csrf
                        <div class="field-set">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Your Name" />
                            @error('name')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="field-set">
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Your Email" />
                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="field-set">
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="Your Phone" />
                            @error('phone')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="field-set">
                            <textarea name="message" id="message" class="form-control" placeholder="Your Message"></textarea>
                            @error('message')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="spacer-half"></div>
                        <div id="submit">
                            <input type="submit" id="submit_form" value="Submit Form" class="btn btn-custom" />
                        </div>
                        {{-- <div id="mail_success" class="success">Your message has been sent successfully.</div>
                        <div id="mail_fail" class="error">Sorry, error occured this time sending your message.</div> --}}
                    </form>
                </div>
                <div class="col-lg-4">
                </div>
            </div>
        </div>
    </section>
    <section class="jarallax text-light">
        <img src="images/background/2.jpg" class="jarallax-img" alt="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay=".2s">
                    <div class="de_count ultra-big s2 border-light text-center">
                        <h3 class="timer" data-to="20" data-speed="1000">20</h3>
                        <span class="id-color">Years of Experience</span>
                    </div>
                </div>
                <div class="col-lg-4 p-lg-5  mb-sm-30 wow fadeInRight" data-wow-delay=".4s">
                    <span class="p-title">About Us</span><br>
                    <h2>
                        @if ($dashboard_settings)
                            {{ $dashboard_settings->title }}
                        @endif is Your Best Partner for Legal Solutions
                    </h2>
                </div>
                <div class="col-lg-4 wow fadeInRight" data-wow-delay=".6s">
                    <p>
                        We take pride in the depth and breadth of experience that our team of lawyers brings to the table.
                        With years of dedicated practice in various areas of law, our attorneys have honed their skills,
                        developed specialized knowledge, and earned a reputation for excellence in their respective fields.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#contact_form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                var formData = new FormData(this); // Serialize the form data

                $.ajax({
                    url: $(this).attr('action'), // Use the form action URL
                    type: 'POST',
                    data: formData,
                    processData: false, // Required for sending FormData
                    contentType: false, // Don't set content type header, jQuery will do that automatically
                    success: function(response) {
                        // Show success SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent',
                            text: 'Your message has been sent successfully!',
                        });
                        // Optionally reset the form
                        $('#contact_form')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        // Show error SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong. Please try again.',
                        });
                    }
                });
            });
        });
    </script>
@endsection
