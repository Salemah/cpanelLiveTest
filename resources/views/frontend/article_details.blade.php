@extends('frontend.layers.master')

@section('top_bar')
    @include('frontend.layers.topbar')
@endsection
@section('header')
    @include('frontend.layers.transparent_header')
@endsection
@section('content')
    <section id="subheader" class="jarallax text-white">
        <img src="{{ asset('images/background/subheader.jpg') }}" class="jarallax-img" alt="">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Blog Single</h1>
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
                <div class="col-md-8">

                    <div class="blog-read">
                        <img alt="" src="{{ asset($article->image) }}" class="img-fullwidth">
                        <div class="post-text">
                            <p>{!! $article->description !!}</p>
                            <blockquote>{{ $article->quote }}</blockquote>
                            <p>{!! $article->second_description !!}</p>
                            {{-- <p>Explore innovative strategies, expert guidance, and tailored solutions to propel your success
                                forward. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id
                                est laborum.</p>
                            <p>Explore innovative strategies, expert guidance, and tailored solutions to propel your success
                                forward. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id
                                est laborum.</p> --}}
                                <div class="d-flex flex-row mb-3">
                            <span class="post-date">{{ \Carbon\Carbon::parse($article->date)->format('M d,Y') }}</span>
                            {{-- <span class="post-comment">1</span> --}}
                            {{-- <span class="post-like">181</span> --}}

                                <div class="like-box">

<i id="like-{{ $article->id }}" data-post-id="{{ $article->id }}"
                                        class="like fa-thumbs-up @if (auth()->user()){{ auth()->user()->hasLiked($article->id) ? 'fa-solid' : 'fa-regular' }} @else fa-regular   @endif"></i>


                                    <span class="like-count">{{ $article->likes->count() }}</span>
                                    {{-- <i id="like-{{ $article->id }}" data-post-id="{{ $article->id }}"
                                        class="dislike fa-thumbs-down {{ auth()->user()->hasDisliked($article->id) ? 'fa-solid' : 'fa-regular' }}"></i>
                                    <span class="dislike-count">{{ $article->dislikes->count() }}</span> --}}
                                </div>
                                </div>


                        </div>
                    </div>
                    <div class="spacer-single"></div>
                    {{-- <div id="blog-comment">
                        <h4>Comments (5)</h4>
                        <div class="spacer-half"></div>
                        <ol>
                            <li>
                                <div class="avatar">
                                    <img src="images/misc/avatar.png" alt="" />
                                </div>
                                <div class="comment-info">
                                    <span class="c_name">John Smith</span>
                                    <span class="c_date id-color">15 January 2020</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                    accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                    veritatis et quasi architecto beatae vitae dicta sunt explicabo.</div>
                                <ol>
                                    <li>
                                        <div class="avatar">
                                            <img src="images/misc/avatar.png" alt="" />
                                        </div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">15 January 2020</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                                            inventore veritatis et quasi architecto beatae vitae dicta sunt
                                            explicabo.</div>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <div class="avatar">
                                    <img src="images/misc/avatar.png" alt="" />
                                </div>
                                <div class="comment-info">
                                    <span class="c_name">John Smith</span>
                                    <span class="c_date id-color">15 January 2020</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                    accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                    veritatis et quasi architecto beatae vitae dicta sunt explicabo.</div>
                                <ol>
                                    <li>
                                        <div class="avatar">
                                            <img src="images/misc/avatar.png" alt="" />
                                        </div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">15 January 2020</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                                            inventore veritatis et quasi architecto beatae vitae dicta sunt
                                            explicabo.</div>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <div class="avatar">
                                    <img src="images/misc/avatar.png" alt="" />
                                </div>
                                <div class="comment-info">
                                    <span class="c_name">John Smith</span>
                                    <span class="c_date id-color">15 January 2020</span>
                                    <span class="c_reply"><a href="#">Reply</a></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                    accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                    veritatis et quasi architecto beatae vitae dicta sunt explicabo.</div>
                            </li>
                        </ol>
                        <div class="spacer-single"></div>
                        <div id="comment-form-wrapper">
                            <h4>Leave a Comment</h4>
                            <div class="comment_form_holder">
                                <form id="contact_form" name="form1" class="form-default" method="post" action="#">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control" />
                                    <label>Email <span class="req">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control" />
                                    <div id="error_email" class="error">Please check your email</div>
                                    <label>Message <span class="req">*</span></label>
                                    <textarea cols="10" rows="10" name="message" id="message" class="form-control"></textarea>
                                    <div id="error_message" class="error">Please check your message</div>
                                    <div id="mail_success" class="success">Thank you. Your message has been sent.</div>
                                    <div id="mail_failed" class="error">Error, email not sent</div>
                                    <p id="btnsubmit">
                                        <input type="submit" id="send" value="Send" class="btn btn-custom" />
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div id="sidebar" class="col-md-4">
                    @if ($articles)
                        <div class="widget widget-post">
                            <h4>Recent Article</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach ($articles as $article)
                                    <li><span
                                            class="date">{{ \Carbon\Carbon::parse($article->date)->format('d M') }}</span><a
                                            href="{{ route('frontend.articles.details', ['id' => $article->id]) }}">{{ $article->title }}</a>
                                    </li>
                                    {{-- <li><span class="date">22 Jun</span><a href="#">Six firms that are setting the
                                    trend</a></li>
                            <li><span class="date">20 Jun</span><a href="#">When it comes to law firm mergers</a>
                            </li>
                            <li><span class="date">12 Jun</span><a href="#">How to Make the Most of Your CLE</a>
                            </li> --}}
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($article->about_us)
                        <div class="widget widget-text">
                            <h4>About Us</h4>
                            <div class="small-border"></div>
                            <p>{!! $article->about_us !!}</p>
                        </div>
                    @endif
                    @if ($tags)
                        <div class="widget widget_tags">
                            <h4>Tag</h4>
                            <div class="small-border"></div>
                            <ul>
                                @if ($tags)
                                    @foreach ($tags as $tag)
                                        <li><a
                                                href="{{ route('frontend.articles.by_tag', ['id' => $tag->id]) }}">{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                @endif

                                {{-- <li><a href="#link">Application</a></li>
                            <li><a href="#link">Design</a></li>
                            <li><a href="#link">Entertainment</a></li>
                            <li><a href="#link">Internet</a></li>
                            <li><a href="#link">Marketing</a></li>
                            <li><a href="#link">Multipurpose</a></li>
                            <li><a href="#link">Music</a></li>
                            <li><a href="#link">Print</a></li>
                            <li><a href="#link">Programming</a></li>
                            <li><a href="#link">Responsive</a></li>
                            <li><a href="#link">Website</a></li> --}}
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" referrerpolicy="no-referrer"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.like-box i').click(function() {

                var id = $(this).attr('data-post-id');
                var boxObj = $(this).parent('div');
                var c = $(this).parent('div').find('span').text();
                var like = $(this).hasClass('like') ? 1 : 0;

                $.ajax({
                    type: 'POST',
                    url: "{{ route('posts.ajax.like.dislike') }}",
                    data: {
                        id: id,
                        like: like
                    },
                    success: function(data) {

                        if (data.success.hasLiked == true) {

                            if ($(boxObj).find(".dislike").hasClass("fa-solid")) {
                                var dislikes = $(boxObj).find(".dislike-count").text();
                                $(boxObj).find(".dislike-count").text(parseInt(dislikes) - 1);
                            }

                            $(boxObj).find(".like").removeClass("fa-regular");
                            $(boxObj).find(".like").addClass("fa-solid");

                            $(boxObj).find(".dislike").removeClass("fa-solid");
                            $(boxObj).find(".dislike").addClass("fa-regular");

                            var likes = $(boxObj).find(".like-count").text();
                            $(boxObj).find(".like-count").text(parseInt(likes) + 1);

                        } else if (data.success.hasDisliked == true) {

                            if ($(boxObj).find(".like").hasClass("fa-solid")) {
                                var likes = $(boxObj).find(".like-count").text();
                                $(boxObj).find(".like-count").text(parseInt(likes) - 1);
                            }

                            $(boxObj).find(".like").removeClass("fa-solid");
                            $(boxObj).find(".like").addClass("fa-regular");

                            $(boxObj).find(".dislike").removeClass("fa-regular");
                            $(boxObj).find(".dislike").addClass("fa-solid");

                            var dislike = $(boxObj).find(".dislike-count").text();
                            $(boxObj).find(".dislike-count").text(parseInt(dislike) + 1);
                        } else {
                            if ($(boxObj).find(".dislike").hasClass("fa-solid")) {
                                var dislikes = $(boxObj).find(".dislike-count").text();
                                $(boxObj).find(".dislike-count").text(parseInt(dislikes) - 1);
                            }

                            if ($(boxObj).find(".like").hasClass("fa-solid")) {
                                var likes = $(boxObj).find(".like-count").text();
                                $(boxObj).find(".like-count").text(parseInt(likes) - 1);
                            }

                            $(boxObj).find(".like").removeClass("fa-solid");
                            $(boxObj).find(".like").addClass("fa-regular");

                            $(boxObj).find(".dislike").removeClass("fa-solid");
                            $(boxObj).find(".dislike").addClass("fa-regular");

                        }
                    }
                });

            });

        });
    </script>
@endsection
