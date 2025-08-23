@extends('frontend.layers.master')
@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    <section id="subheader" class="text-white" data-bgcolor="#111111">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="spacer-single"></div>
                        <h1>The Team</h1>
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
                {{-- <div class="col-md-12 text-center">
                    <h2 class="wow fadeInUp">Our Lawyer Team</h2>
                    <div class="small-border"></div>
                </div> --}}

                @if ($teams)
                    @foreach ($teams as $team)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb30 wow fadeInRight" data-wow-delay=".2s">
                            <div class="f-profile text-center">
                                <div class="fp-wrap f-invert">
                                    <div class="fpw-overlay">
                                        <div class="fpwo-wrap">
                                            <div class="fpwow-icons">
                                                {{-- <a href="{{ $team->facebook }}"><i class="fa fa-facebook fa-lg"></i></a>
                                                <a href="{{ $team->twitter }}"><i class="fa fa-twitter fa-lg"></i></a>
                                                <a href="{{ $team->linkedin }}"><i class="fa fa-linkedin fa-lg"></i></a> --}}
                                                <a class="" title="Make Appointment" href="{{ route('frontend.team_details',['id' => $team->id]) }}">Make Appointment</a>
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
@endsection
