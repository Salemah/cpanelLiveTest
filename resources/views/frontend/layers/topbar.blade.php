    <div id="topbar" class="text-white bg-color">
        <div class="container">
            <div class="topbar-left sm-hide">
                <span class="topbar-widget tb-social">
                    <a href="@if ($dashboard_settings) {{ $dashboard_settings->facebook }} @endif"><i class="fa fa-facebook"></i></a>
                    <a href="@if ($dashboard_settings) {{ $dashboard_settings->twitter }} @endif"><i class="fa fa-twitter"></i></a>
                    <a href="@if ($dashboard_settings) {{ $dashboard_settings->instagram }} @endif"><i class="fa fa-instagram"></i></a>
                </span>
            </div>
            {{-- <div class="topbar-right">
                <div class="topbar-right">
                    <span class="topbar-widget"><a href="#">Privacy policy</a></span>
                    <span class="topbar-widget"><a href="#">Request Quote</a></span>
                    <span class="topbar-widget"><a href="#">FAQ</a></span>
                </div>
            </div> --}}
            <div class="clearfix"></div>
        </div>
    </div>
