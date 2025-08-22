<section id="section-practice-areas">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2 class="wow fadeInUp">Practice Areas</h2>
                    <div class="small-border"></div>
                </div>
            </div>
            <div class="col-md-6 offset-md-3 text-center">
                <p class="wow fadeInUp">We're dedicated to offering comprehensive, expert legal services tailored to
                    meet your specific needs. Our team of seasoned attorneys brings decades of combined experience
                    across a wide array of practice areas.</p>
            </div>
            <div class="spacer-single"></div>
            @if ($firstCategory)
            <h6>{{$firstCategory->name}}</h6>
                @foreach ($firstCategory->LegalArea as $area)
                    <div class="col-md-4">
                        <ul class="ul-style-2 wow fadeInRight" data-wow-delay=".2s">
                            {{-- @foreach ($legalArea as $area) --}}
                                <li>{{ $area->name }}</li>
                            {{-- @endforeach --}}
                        </ul>
                    </div>

                @endforeach
                <hr style="width: 60%;margin:auto; " class="mb-3">
            @endif
            @if ($remainingCategories)

                @foreach ($remainingCategories as $legalAreas)
                 <h6>{{$legalAreas->name}}</h6>
                   @foreach ($legalAreas->LegalArea as $area)
                    <div class="col-md-4">
                        <ul class="ul-style-2 wow fadeInRight" data-wow-delay=".2s">
                            {{-- @foreach ($legalArea as $area) --}}
                                <li>{{ $area->name }}</li>
                            {{-- @endforeach --}}
                        </ul>
                    </div>

                @endforeach
                @endforeach
            @endif
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
