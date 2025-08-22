 <section data-bgcolor="#111111" class="no-top no-bottom text-light">
     <div class="position-lg-absolute w-100">
         <div class="container">
             <div class="row g-0 align-items-center">
                 <div class="col-lg-5 offset-lg-7 ">
                     <div class="spacer-double"></div>
                     <div class="spacer-double"></div>
                     <div class="spacer-double"></div>
                     <span class="p-title wow fadeInUp" data-wow-delay=".4s">
                         @if ($banners)
                             {{ $banners[0]->sub_title }}
                         @endif
                     </span><br>
                     <h1 class="wow fadeInUp" data-wow-delay=".6s">
                         @if ($banners)
                             {{ $banners[0]->title }}
                         @endif
                     </h1>
                     <div class="row">
                         <div class="col-lg-10">
                             <p class="lead wow fadeInUp" data-wow-delay=".8s">
                                 @if ($banners)
                                     {!! $banners[0]->description !!}
                                 @endif
                             </p>
                             <div class="spacer-20"></div>
                             <a class="btn-custom wow fadeInUp" data-wow-delay="1s" href="{{ route('frontend.contact') }}">Contact Us</a>
                         </div>
                     </div>
                     <div class="spacer-double"></div>
                     <div class="spacer-double"></div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="owl-single-fade-auto owl-carousel owl-theme">
             @if ($banners)
                 @foreach ($banners as $banner)
                     <div class="de-img-cap">
                         <i class="{{ $banner->icon }}"></i>
                         <h3>{{ $banner->name }}</h3>
                         <div class="d-overlay"></div>
                         <img src="{{ asset($banner->image) }}" class="img-fullwidth" alt="">
                     </div>
                 @endforeach

             @endif

             {{-- <div class="de-img-cap">
                 <i class="id-color icofont-medical-sign-alt"></i>
                 <h3>Medical &amp; Healthcare</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/2.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-mining"></i>
                 <h3>Mining</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/3.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-law-order"></i>
                 <h3>Civil &amp; Criminal</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/4.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-group-students"></i>
                 <h3>Family &amp; Marriage</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/5.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-money"></i>
                 <h3>Corporate &amp; Investment</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/6.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-building"></i>
                 <h3>Property</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/7.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-bank"></i>
                 <h3>Banking &amp; Insurance</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/8.jpg" class="img-fullwidth" alt="">
             </div>
             <div class="de-img-cap">
                 <i class="id-color icofont-light-bulb"></i>
                 <h3>Intellectual Property</h3>
                 <div class="d-overlay"></div>
                 <img src="images/practice-areas/9.jpg" class="img-fullwidth" alt="">
             </div> --}}
         </div>
     </div>
 </section>
