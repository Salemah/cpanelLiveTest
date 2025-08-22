@extends('frontend.layers.master')
@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    <section id="subheader" class="jarallax text-white">
        <img src="images/background/subheader3.jpg" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="spacer-single"></div>
                        <h1>About Us</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section aria-label="section" data-bgcolor="#ffffff">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <span class="p-title"> {{ $abouts->title }}</span><br>
                    <h2>{{ $abouts->name }}</h2>
                    <p>{!! $abouts->description !!}</p>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="de-images">
                        <div class="di-text text-white bg-color">
                            @if ($abouts->cases)
                                <h1>{{ $abouts->cases }}</h1><span>Solved Cases</span>
                            @endif

                        </div>
                        <img class="di-small-2" src="{{ asset($abouts->image )}}" alt="{{ $abouts->name }}" />
                        <img class="di-big img-fluid" src="{{ asset($abouts->image_two )}}" alt="{{ $abouts->name }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
 <section data-bgcolor="#002552" class="text-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 offset-lg-7">
                <span class="p-title">
                    @if ($Experiences)
                        {{ $Experiences[0]->name }}
                    @endif
                </span><br>
                <h2>
                    @if ($Experiences)
                        {{ $Experiences[0]->title }}
                    @endif
                </h2>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @if ($Experiences)
                        @foreach ($Experiences as $key=>$experience)
                            <li class="nav-item">
                                <a class="nav-link @if ($key == 0) active   @endif" id="pills-{{ $experience->id }}-tab" data-toggle="pill"
                                    href="#pills-{{ $experience->id }}" role="tab"
                                    aria-controls="pills-{{ $experience->id }}"
                                    aria-selected="true">{{ $experience->tab }}</a>
                            </li>
                        @endforeach
                    @endif

                    {{-- <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                            role="tab" aria-controls="pills-profile" aria-selected="false">Our Expertise</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                            role="tab" aria-controls="pills-contact" aria-selected="false">Our Firm</a>
                    </li> --}}
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @if ($Experiences)
                        @foreach ($Experiences as $key=>$experience)
                            <div class="tab-pane fade @if ($key == 0) show active   @endif" id="pills-{{ $experience->id }}" role="tabpanel"
                                aria-labelledby="pills-{{ $experience->id }}-tab">
                                <p>@sanitizeHtml($experience->description)</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <p>We brings extensive experience and specialized knowledge to a wide range of legal practice
                            areas. We are dedicated to providing top-tier legal services, tailored to meet the unique
                            needs of each client. Whether you're facing a personal legal challenge or require
                            sophisticated business counsel, our attorneys are here to guide you with unparalleled
                            expertise and unwavering commitment.</p>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <p>We are dedicated to providing exceptional legal services tailored to meet the unique needs
                            of our clients. Our firm is built on a foundation of integrity, professionalism, and a
                            commitment to excellence. Whether you're facing a personal legal challenge or require
                            sophisticated business counsel, our team of experienced attorneys is here to guide you
                            through every step of the legal process.</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="jarallax image-container col-lg-6">
        <img src="@if ($Experiences) {{ asset($Experiences[0]->image) }} @endif" class="jarallax-img"
            alt="">
    </div>
</section>
     <section aria-label="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="wow fadeInUp">Our Lawyer Team</h2>
                    <div class="small-border"></div>
                </div>

                @if ($Teams)
                    @foreach ($Teams as $team)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb30 wow fadeInRight" data-wow-delay=".2s">
                            <div class="f-profile text-center">
                                <div class="fp-wrap f-invert">
                                    <div class="fpw-overlay">
                                        <div class="fpwo-wrap">
                                            <div class="fpwow-icons">
                                                <a href="{{ $team->facebook }}"><i class="fa fa-facebook fa-lg"></i></a>
                                                <a href="{{ $team->twitter }}"><i class="fa fa-twitter fa-lg"></i></a>
                                                <a href="{{ $team->linkedin }}"><i class="fa fa-linkedin fa-lg"></i></a>
                                                {{-- <a href="#"><i class="fa fa-pinterest fa-lg"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fpw-overlay-btm"></div>
                                    <img src="{{ asset($team->image) }}" class="fp-image img-fluid"
                                        alt="{{ $team->name }} {{ $team->position }}">
                                </div>
                                <h4>{{ $team->name }}</h4>
                                {{ $team->positions }}
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="col-lg-4 col-md-6 col-sm-6 mb30 wow fadeInRight" data-wow-delay=".4s">
                    <div class="f-profile text-center">
                        <div class="fp-wrap f-invert">
                            <div class="fpw-overlay">
                                <div class="fpwo-wrap">
                                    <div class="fpwow-icons">
                                        <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="fpw-overlay-btm"></div>
                            <img src="images/team/2.jpg" class="fp-image img-fluid" alt="">
                        </div>
                        <h4>Sasha Welsh</h4>
                        Senior Partner
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 mb30 wow fadeInRight" data-wow-delay=".6s">
                    <div class="f-profile text-center">
                        <div class="fp-wrap f-invert">
                            <div class="fpw-overlay">
                                <div class="fpwo-wrap">
                                    <div class="fpwow-icons">
                                        <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-pinterest fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="fpw-overlay-btm"></div>
                            <img src="images/team/3.jpg" class="fp-image img-fluid" alt="">
                        </div>
                        <h4>John Shepard</h4>
                        Associate
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-text" data-bgcolor="#111111" class="text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12 wow fadeInRight" data-wow-delay=".2s">
                    <div class="de_count ultra-big s2 text-center">
                        <h3 class="timer" data-to="20" data-speed="1000">20</h3>
                        <span class="id-color">Years of Experience</span>
                    </div>
                </div>
                <div class="col-lg-4 p-lg-5  mb-sm-30 wow fadeInRight" data-wow-delay=".4s">
                    <span class="p-title">Welcome</span><br>
                    <h2>Justica is Your Best Partner for Legal Solutions</h2>
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
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box f-boxed style-3 text-center">
                        <i class="id-color icofont-letter"></i>
                        <div class="text">
                            <h4>Request Quote</h4>
                            Our experienced attorneys are ready to provide personalized solutions to meet your goals.
                        </div>
                        <i class="wm icofont-letter"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box f-boxed style-3 text-center">
                        <i class="id-color icofont-investigation"></i>
                        <div class="text">
                            <h4>Investigation</h4>
                            Our experienced attorneys are ready to provide personalized solutions to meet your goals.
                        </div>
                        <i class="wm icofont-investigation"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-box f-boxed style-3 text-center">
                        <i class="id-color icofont-hand-power"></i>
                        <div class="text">
                            <h4>Case Fight</h4>
                            Our experienced attorneys are ready to provide personalized solutions to meet your goals.
                        </div>
                        <i class="wm icofont-hand-power"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
