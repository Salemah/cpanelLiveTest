@extends('frontend.layers.master')
@section('css')
    <style>
        .pagination .page-item .page-link {
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .pagination .page-item.active .page-link {
            background-color: #EAA636;
            color: white;
            border-color: #007bff;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
        }
    </style>
@endsection
@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    <!-- section begin -->
    <section id="subheader" class="jarallax text-light">
        <img src="{{asset('images/background/subheader1.jpg')}}" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="spacer-single"></div>
                        <h1>Practice Areas</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section>
        <div class="container">
            <div class="row">
                @foreach ($LegalAreas as $LegalArea)
                    <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                        <div class="dcg-four dcg-item">
                            <a class="dcg-url" href="{{route('frontend.articles.by_legal_area',['id' => $LegalArea->id])}}"></a>
                            <img class="dcg-image" src="{{asset($LegalArea->image)}}" alt="" />
                            <div class="dcg-title"><i class="{{$LegalArea->icon}}"></i>{{$LegalArea->name}}</div>
                            <div class="dcg-content">{!!$LegalArea->name!!}
                            </div>
                            <div class="dcg-text">Read More</div>
                            <div class="dcg-overlay"></div>
                        </div>
                    </div>
                @endforeach
<div class="spacer-single"></div>
                    {{ $LegalAreas->links('pagination::bootstrap-4') }}


                {{-- <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/2.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-medical-sign-alt"></i>Medical &amp;
                            Health Care</div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/3.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-mining"></i>Mining</div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/4.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-law-order"></i>Civil &amp; Criminal</div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/5.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-group-students"></i>Family &amp; Marriage
                        </div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/6.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-money"></i>Corporate &amp; Investment
                        </div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/7.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-building"></i>Property</div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/8.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-bank"></i>Banking &amp; Insurance</div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 mb30">
                    <div class="dcg-four dcg-item">
                        <a class="dcg-url" href="#"></a>
                        <img class="dcg-image" src="images/practice-areas/9.jpg" alt="" />
                        <div class="dcg-title"><i class="dcg-icon id-color icofont-light-bulb"></i>Intellectual &amp;
                            Property</div>
                        <div class="dcg-content">Lorem ipsum elit officia sint reprehenderit ullamco voluptate enim ut
                            voluptate cupidatat ut dolor aute ex cupidatat ea ut ex elit fugiat laborum laboris elit.</div>
                        <div class="dcg-text">Read More</div>
                        <div class="dcg-overlay"></div>
                    </div>
                </div> --}}

            </div>
        </div>
    </section>
@endsection
@section('contact')
    <section class="pt40 pb40 bg-color text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 mb-sm-30 text-lg-start text-sm-center">
                    <h3 class="no-bottom">Contact Us Now! Get a Free Consultation for Your Case.</h3>
                </div>
                <div class="col-md-4 text-lg-right text-sm-center">
                    <a href="#" class="btn-custom btn-black light">Make Appointment</a>
                </div>
            </div>
        </div>
    </section>
@endsection
