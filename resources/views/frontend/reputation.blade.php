   <section id="section-highlight" class="relative text-light" data-bgcolor="#002552">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <span class="p-title wow fadeInUp">Welcome</span><br>
                            <h2 class="wow fadeInUp">
                                 @if ($Reputations)
                             {{ $Reputations[0]->title }}
                         @endif
                            </h2>
                            <div class="small-border sm-left"></div>
                        </div>
                        <div class="col-md-8">
                            <p class="wow fadeInRight"> @if ($Reputations)
                             {!! $Reputations[0]->description !!}
                         @endif
                            </p>
                        </div>
                    </div>
                    <div class="spacer-double"></div>
                </div>
            </section>
             <section class="no-top relative z1000">
                <div class="container">
                    <div class="row mt-100">
                          @if ($Reputations)
                 @foreach ($Reputations as $Reputation)
                     <div class="col-md-4 mb-sm-30 wow fadeInRight" data-wow-delay=".6s">
                            <div class="mask">
                                <div class="cover">
                                    <div class="c-inner">
                                        <h3><i class="{{$Reputation->icon}}"></i><span>{{$Reputation->name}}</span></h3>
                                       <p>@sanitizeHtml($Reputation->law_details)</p>
                                        <div class="spacer20"></div>
                                        <a href="#" class="btn-custom capsule">Read more</a>
                                    </div>
                                </div>
                                <img src="{{asset($Reputation->image)}}" alt="{{asset($Reputation->name)}}" class="img-responsive" />
                            </div>
                        </div>
                 @endforeach

             @endif

                        {{-- <div class="col-md-4 mb-sm-30 wow fadeInRight" data-wow-delay=".4s">
                            <div class="mask">
                                <div class="cover">
                                    <div class="c-inner">
                                        <h3><i class="icofont-home"></i><span>Family Law</span></h3>
                                        <p>Explore innovative strategies, expert guidance, and tailored solutions to propel your success forward. </p>
                                        <div class="spacer20"></div>
                                        <a href="#" class="btn-custom capsule">Read more</a>
                                    </div>
                                </div>
                                <img src="images/services/2.jpg" alt="" class="img-responsive" />
                            </div>
                        </div>
                        <div class="col-md-4 mb-sm-30 wow fadeInRight" data-wow-delay=".6s">
                            <div class="mask">
                                <div class="cover">
                                    <div class="c-inner">
                                        <h3><i class="icofont-law-order"></i><span>Criminal Law</span></h3>
                                        <p>Explore innovative strategies, expert guidance, and tailored solutions to propel your success forward. </p>
                                        <div class="spacer20"></div>
                                        <a href="#" class="btn-custom capsule">Read more</a>
                                    </div>
                                </div>
                                <img src="images/services/3.jpg" alt="" class="img-responsive" />
                            </div>
                        </div> --}}
                    </div>
                </div>
            </section>
