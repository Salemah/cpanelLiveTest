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
                        <h1>FAQ</h1>
                        <p>Reputation. Respect. Result.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section id="section-features">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb30">
                    <div class="box-highlight">
                        <div class="heading text-center text-light">
                            <h3>{{ $firstCategory->name }}</h3>
                        </div>
                        <div class="content">
                            <div class="accordion">
                                <div class="accordion-section">
                                    @foreach ($firstCategory->faqs as $faq)
                                        <div class="accordion-section-title" data-tab="#accordion-{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </div>
                                        <div class="accordion-section-content" id="accordion-{{ $faq->id }}">
                                            <p>{!! $faq->answer !!}</p>
                                        </div>
                                    @endforeach

                                    {{-- <div class="accordion-section-title" data-tab="#accordion-2">
                                        What can a lawyer do for me?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-2">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-3">
                                        What is legal advice?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-3">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-4">
                                        How much will my lawyer cost?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-4">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-5">
                                        How do I find a lawyer?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-5">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-6">
                                        How do I choose which lawyer is right for me?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-6">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($remainingCategories as $categories)
                <div class="col-md-6 mb30">
                    <div class="box-highlight s2">
                        <div class="heading text-center text-light">
                            <h3>{{ $categories->name }}</h3>
                        </div>
                        <div class="content">
                            <div class="accordion">
                                <div class="accordion-section">
                                    @foreach ($categories->faqs as $faq)
                                        <div class="accordion-section-title" data-tab="#accordion-{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </div>
                                        <div class="accordion-section-content" id="accordion-{{ $faq->id }}">
                                            <p>{!! $faq->answer !!}</p>
                                        </div>
                                    @endforeach
                                    {{-- <div class="accordion-section-title" data-tab="#accordion-b-2">
                                        What can a lawyer do for me?
                                    </div> --}}
                                    {{-- <div class="accordion-section-content" id="accordion-b-2">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-b-3">
                                        What is legal advice?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b-3">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-b-4">
                                        How much will my lawyer cost?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b-4">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-b-5">
                                        How do I find a lawyer?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b-5">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div>
                                    <div class="accordion-section-title" data-tab="#accordion-b-6">
                                        How do I choose which lawyer is right for me?
                                    </div>
                                    <div class="accordion-section-content" id="accordion-b-6">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                                            excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                                            officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem
                                            rerum facilis est et expedita distinctio.</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
