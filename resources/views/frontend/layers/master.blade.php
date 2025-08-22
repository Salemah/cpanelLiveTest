<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from www.madebydesignesia.com/themes/justica/index-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Sep 2024 15:08:37 GMT -->

<head>
    <meta charset="utf-8" />
    <title>
        @if ($dashboard_settings)
            {{ $dashboard_settings->title }}
        @endif
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
        content="@if ($dashboard_settings) {{ $dashboard_settings->title }} @endif @if ($dashboard_settings) {{ $dashboard_settings->about }} @endif"
        name="description" />
    <meta content="" name="keywords" />
    <meta content="" name="author" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
    <!-- CSS Files

    ================================================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @include('frontend.layers.style')
    @yield('css')
</head>

<body>
    <div id="wrapper">
        @yield('top_bar')

        <!-- header begin -->
        @yield('header')
        <!-- header close -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

            @yield('content')

        </div>
        <!-- content close -->
        <a href="#" id="back-to-top"></a>
        @yield('contact')
        <!-- footer begin -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget">
                            <a href="{{ url('/') }}"><img alt="" class="img-fluid mb20"
                                    src="@if ($dashboard_settings) {{ asset('/image/dashboard/' . $dashboard_settings->logo) }} @else  {{ asset('logo2.png') }} @endif"></a>
                            <address class="s1">
                                <span><i class="id-color fa fa-map-marker fa-lg"></i>
                                    @if ($dashboard_settings)
                                        {{ $dashboard_settings->address }}
                                    @endif
                                </span>
                                <span><i class="id-color fa fa-phone fa-lg"></i>
                                    @if ($dashboard_settings)
                                        {{ $dashboard_settings->phone }}
                                    @endif
                                </span>
                                <span><i class="id-color fa fa-envelope-o fa-lg"></i><a
                                        href="mailto:contact@example.com">
                                        @if ($dashboard_settings)
                                            {{ $dashboard_settings->email }}
                                        @endif
                                    </a></span>
                                {{-- <span><i class="id-color fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span> --}}
                            </address>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="id-color mb20">Area of Consultation</h4>
                        <ul class="ul-style-2">
                            @if ($comsultationArea)
                                @foreach ($comsultationArea as $legalArea)
                                    <li>{{ $legalArea->name }}</li>
                                @endforeach
                            @endif

                            {{-- <li>Construction and Real Estate</li>
                            <li>Commercial Duspute Resolution</li>
                            <li>Employment</li>
                            <li>Banking and Finance</li> --}}
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h4 class="id-color">Newsletter</h4>
                        <p>Signup for our newsletter to get the latest news, updates and special offers in your inbox.
                        </p>
                        <form action="https://www.madebydesignesia.com/themes/justica/blank.php" class="row"
                            id="form_subscribe" method="post" name="form_subscribe">
                            <div class="col text-center">
                                <input class="form-control" id="name_1" name="name_1" placeholder="enter your email"
                                    type="text" /> <a href="#" id="btn-submit"><i
                                        class="fa fa-long-arrow-right"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                        <div class="spacer-10"></div>
                        <small>Your email is safe with us. We don't spam.</small>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            &copy; Copyright {{ now()->year }} - {{ $dashboard_settings->copyright }}
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <div class="social-icons">
                                <a href="@if ($dashboard_settings) {{ $dashboard_settings->facebook }} @endif"><i
                                        class="fa fa-facebook fa-lg"></i></a>
                                <a href="@if ($dashboard_settings) {{ $dashboard_settings->facebook }} @endif"><i
                                        class="fa fa-twitter fa-lg"></i></a>
                                <a
                                    href="@if ($dashboard_settings) {{ $dashboard_settings->facebook }} @endif"><i
                                        class="fa fa-linkedin fa-lg"></i></a>
                                {{-- <a
                                    href="@if ($dashboard_settings) {{ $dashboard_settings->facebook }} @endif"><i
                                        class="fa fa-pinterest fa-lg"></i></a>
                                <a
                                    href="@if ($dashboard_settings) {{ $dashboard_settings->facebook }} @endif"><i
                                        class="fa fa-rss fa-lg"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer close -->
        <div id="preloader">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>

    <!-- Javascript Files
    ================================================== -->
    @include('frontend.layers.script')
    @yield('script')

</body>

</html>
