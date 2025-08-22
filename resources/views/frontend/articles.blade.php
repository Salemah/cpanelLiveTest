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
    <section id="subheader" class="jarallax text-white">
        <img src="{{asset('images/background/subheader.jpg')}}" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>News</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <!-- section begin -->

    <section aria-label="section">
        <div class="container">
            <div class="row">

                @if ($Articles)
                    @forelse ($Articles as $article)
                        <div class="col-lg-4 col-md-6 mb30">
                            <a href="{{ route('frontend.articles.details',['id' => $article->id]) }}">
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

                    @empty
                    @endforelse

                    <div class="spacer-single"></div>
                    {{ $Articles->links('pagination::bootstrap-4') }}
                @endif

                {{-- <div class="col-lg-4 col-md-6 mb30">
                    <a href="{{route('frontend.articles.details')}}">
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
                                <h4>Six firms that are setting the trend<span></span></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may consider
                                    handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                     </a>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <a href="{{route('frontend.articles.details')}}">
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
                                <h4>When it comes to law firm mergers<span></span></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may consider
                                    handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                     </a>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <a href="{{route('frontend.articles.details')}}">
                    <div class="bloglist item">
                        <div class="post-content">
                            <div class="date-box">
                                <div class="m">25</div>
                                <div class="d">NOV</div>
                            </div>
                            <div class="post-image">
                                <img alt="" src="images/news/4.jpg">
                            </div>
                            <div class="post-text">
                                <span class="p-tagline">Law Firm</span>
                                <h4>How to Make the Most of Your CLE<span></span></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may consider
                                    handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                     </a>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <a href="{{route('frontend.articles.details')}}">
                    <div class="bloglist item">
                        <div class="post-content">
                            <div class="date-box">
                                <div class="m">28</div>
                                <div class="d">NOV</div>
                            </div>
                            <div class="post-image">
                                <img alt="" src="images/news/5.jpg">
                            </div>
                            <div class="post-text">
                                <span class="p-tagline">Law Firm</span>
                                <h4>The Ultimate Guide to Writing like a Lawyer<span></span></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may consider
                                    handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                     </a>
                </div>
                <div class="col-lg-4 col-md-6 mb30">
                    <a href="{{route('frontend.articles.details')}}">
                    <div class="bloglist item">
                        <div class="post-content">
                            <div class="date-box">
                                <div class="m">30</div>
                                <div class="d">NOV</div>
                            </div>
                            <div class="post-image">
                                <img alt="" src="images/news/6.jpg">
                            </div>
                            <div class="post-text">
                                <span class="p-tagline">Law Firm</span>
                                <h4>Should you Just Phone Your Opponent?<span></span></h4>
                                <p>When facing legal issues, whether personal or business-related, many people may consider
                                    handling the matter themselves to save money.</p>
                                <span class="p-author">Fynley Wilkinson</span>
                            </div>
                        </div>
                    </div>
                     </a>
                </div> --}}


                {{-- <ul class="pagination">
                    <li><a href="#">Prev</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">Next</a></li>
                </ul> --}}
            </div>
        </div>
    </section>
@endsection
