 <header class="transparent">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="de-flex sm-pt10">
                     <div class="de-flex-col">
                         <!-- logo begin -->
                         <div id="logo">
                             <a href="index.html">
                                 <img alt="" class="logo"
                                     src="@if ($dashboard_settings) {{ asset('/image/dashboard/' . $dashboard_settings->logo) }} @else  {{ asset('logo2.png') }} @endif" />
                                 <img alt="" class="logo-2"
                                     src="@if ($dashboard_settings) {{ asset('/image/dashboard/' . $dashboard_settings->logo) }} @else  {{ asset('logo2.png') }} @endif" />
                             </a>
                         </div>
                         <!-- logo close -->
                     </div>
                     <div class="de-flex-col header-col-mid">
                         <!-- mainmenu begin -->
                         <ul id="mainmenu">
                             <li><a href="{{ url('/') }}">Home</a></li>
                             <li><a href="about.html">About</a>
                                 <ul>
                                     <li><a href="{{ route('frontend.about.us') }}">About Us</a></li>
                                     <li><a href="{{ route('frontend.our.team') }}">The Team</a></li>
                                     <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>
                                 </ul>
                             </li>
                             <li><a href="{{ route('frontend.practice.area') }}">Practice Areas</a>
                                 @if ($LawCategorys)
                                     <ul>
                                         @foreach ($LawCategorys as $lawCategory)
                                             <li><a
                                                     href="{{ route('frontend.practice.area', ['id' => $lawCategory->id]) }}">{{ $lawCategory->name }}</a>
                                             </li>
                                         @endforeach
                                     </ul>
                                 @endif


                                 {{-- <li><a href="{{ route('frontend.our.team') }}">The Team</a></li>
                                     <li><a href="{{ route('frontend.faq') }}">FAQ</a></li> --}}

                             </li>
                             <li><a href="{{ route('frontend.articles') }}">Articles</a>

                             </li>
                             <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                             @if (Route::has('login'))


                                 @auth
                                     @hasanyrole('admin')
                                         <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                     @endhasanyrole
                                 @else
                                     <li><a href="{{ route('login') }}">Log In</a></li>
                                     @if (Route::has('register'))
                                         <li><a href="{{ route('register') }}">Register</a></li>
                                     @endif
                                 @endauth

                             @endif
                             {{-- <li><a href="#">Elements</a>
                                        <ul>
                                            <li><a href="accordion.html">Accordion</a></li>
                                            <li><a href="alerts.html">Alerts</a></li>
                                            <li><a href="counters.html">Counters</a></li>
                                            <li><a href="faq.html">FAQ</a></li>
                                            <li><a href="gallery.html">Gallery</a></li>
                                            <li><a href="icon-set-1.html">Icon Set 1</a></li>
                                            <li><a href="modal.html">Modal</a></li>
                                            <li><a href="progress-bar.html">Progress Bar</a></li>
                                            <li><a href="tabs.html">Tabs</a></li>
                                            <li><a href="testimonials.html">Testimonials</a></li>
                                        </ul>
                                    </li> --}}
                         </ul>
                         <!-- mainmenu close -->
                     </div>
                     <div class="de-flex-col">
                         <div class="h-phone md-hide"><span>Need&nbsp;Help?</span><i class="fa fa-phone"></i>
                             @if ($dashboard_settings)
                                 {{ $dashboard_settings->phone }}
                             @endif
                         </div>
                         <span id="menu-btn"></span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </header>
