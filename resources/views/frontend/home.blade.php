@extends('frontend.layers.master')
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    @include('frontend.banner')

    @include('frontend.reputation')

    @include('frontend.wedid')

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
    <section aria-label="section" class="jarallax text-light">
        <img src="images/background/3.jpg" class="jarallax-img" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-light">
                        <h2 class="wow fadeInUp">Testimonials</h2>
                        <div class="small-border"></div>
                    </div>
                    <div class="owl-carousel owl-theme" id="testimonial-carousel">
                        @if ($Testimonials)
                            @foreach ($Testimonials as $testimonials)
                                <div class="item">
                                    <div class="de_testi opt-2 review">
                                        <blockquote style="min-height: 20vh !important">
                                            <i class="fa fa-quote-left id-color"></i>
                                            <h3>{{ $testimonials->title }}</h3>
                                            <p>@sanitizeHtml($testimonials->description) </p>
                                            <div class="de_testi_by"><span>{{ $testimonials->quote_by }}</span></div>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        {{-- <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Quality lawyer service</h3>
                                    <p>Their attention to detail and strategic approach were instrumental in achieving a
                                        favorable outcome. I am forever grateful for their hard work and commitment.</p>
                                    <div class="de_testi_by"><span>fff</span></div>
                                </blockquote>
                            </div>
                        </div> --}}
                        {{-- <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Top lawyer listed</h3>
                                    <p>They fought for my right to fair compensation and kept me informed throughout the
                                        process. Their expertise in personal injury law made a significant difference in
                                        my recovery.</p>
                                    <div class="de_testi_by"><span>Alex R., Personal Injury Client</span></div>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Great services</h3>
                                    <p>They provided clear guidance on complicated issues. Their practical advice and
                                        thorough understanding of business law have been invaluable to my company's
                                        success.</p>
                                    <div class="de_testi_by"><span>Samantha T., Business Law Client</span></div>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Highly recommend</h3>
                                    <p>The attorneys took the time to understand my concerns and crafted a comprehensive
                                        plan that gave me peace of mind. Their knowledge and professionalism were
                                        excellent.</p>
                                    <div class="de_testi_by"><span>Edward L., Estate Planning Client</span></div>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Excellent support</h3>
                                    <p> They handled the negotiations and litigation with skill and ensured my interests
                                        were protected. I was impressed with their responsiveness and dedication to my
                                        case.</p>
                                    <div class="de_testi_by"><span>Linda W., Real Estate Law Client</span></div>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Reliable lawyer</h3>
                                    <p>The attorneys were incredibly knowledgeable and provided practical solutions that
                                        resolved the conflict efficiently. Their expertise in employment law is
                                        unparalleled.</p>
                                    <div class="de_testi_by"><span>Michael B., Employment Law Client</span></div>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="de_testi opt-2 review">
                                <blockquote>
                                    <i class="fa fa-quote-left id-color"></i>
                                    <h3>Five-star services</h3>
                                    <p>Their thorough investigation and compelling defense in court resulted in a
                                        not-guilty verdict. I am eternally grateful for their expert legal representation.
                                    </p>
                                    <div class="de_testi_by"><span>David P., Criminal Defense Client</span></div>
                                </blockquote>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($Articles)
        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h2 class="wow fadeInUp">Latest News</h2>
                            <div class="small-border"></div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @foreach ($Articles as $article)
                        <div class="col-lg-4 col-md-6 mb30">
                            <a href="{{ route('frontend.articles.details', ['id' => $article->id]) }}">
                                <div class="bloglist item">
                                    <div class="post-content">
                                        <div class="date-box">
                                            <div class="m">{{ \Carbon\CarboN::parse($article->date)->format('d') }}
                                            </div>
                                            <div class="d">{{ \Carbon\Carbon::parse($article->date)->format('M') }}
                                            </div>
                                        </div>
                                        <div class="post-image">
                                            <img alt="{{ $article->title }}" src="{{ asset($article->image) }}">
                                        </div>
                                        <div class="post-text">
                                            <span class="p-tagline">{{ $article->LegalArea->lawCategory ? $article->LegalArea->lawCategory->name : 'Law Firm' }}</span>
                                            <h4>{{ $article->title }}<span></span></h4>
                                            <p>{!! \Illuminate\Support\Str::limit($article->description, 100) !!}</p>
                                            <span class="p-author">{{ $article->User ? $article->User->name : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach




                    {{-- <div class="col-lg-4 col-md-6 mb30">
                    <div class="bloglist item">
                        <div class="post-content">
                            <div class="date-box">
                                <div class="m">15</div>
                                <div class="d">NOV</div>
                            </div>
                            <div class="post-image">
                                <img alt="" src="images/news/2.jpg">
                            </div>
                            <div class="post-text">
                                <span class="p-tagline">Law Firm</span>
                                <h4><a href="news-single.html">Six firms that are setting the trend<span></span></a></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may
                                    consider handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <div class="bloglist item">
                        <div class="post-content">
                            <div class="date-box">
                                <div class="m">20</div>
                                <div class="d">NOV</div>
                            </div>
                            <div class="post-image">
                                <img alt="" src="images/news/3.jpg">
                            </div>
                            <div class="post-text">
                                <span class="p-tagline">Law Firm</span>
                                <h4><a href="news-single.html">When it comes to law firm mergers<span></span></a></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may
                                    consider handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </section>
    @endif

    <section class="pt40 pb40 bg-color text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 mb-sm-30 text-lg-start text-sm-center wow fadeInRight">
                    <h3 class="no-bottom">Contact Us Now! Get a Free Consultation for Your Case.</h3>
                </div>
                <div class="col-md-4 text-lg-end rtl-lg-start text-sm-center wow fadeInRight">
                    <a href="{{route('frontend.make_appointment')}}" class="btn-custom btn-black text-white light">Make Appointment</a>
                </div>
            </div>
        </div>
    </section>
@endsection
