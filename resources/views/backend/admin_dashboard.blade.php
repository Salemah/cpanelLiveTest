@extends('backend.layouts.backendapp')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </button>
        </div>
    @endif
    <div class="row g-6">
        <!-- Website Analytics -->
        <div class="col-lg-6">
            <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                id="swiper-with-pagination-cards">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Today Appointment</h5>
                                <small>Total 28.5% Conversion Rate</small>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Traffic</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">28%</p>
                                                    <p class="mb-0">Sessions</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.2k</p>
                                                    <p class="mb-0">Leads</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul class="list-unstyled mb-0">
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">3.1k</p>
                                                    <p class="mb-0">Page Views</p>
                                                </li>
                                                <li class="d-flex align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12%</p>
                                                    <p class="mb-0">Conversions</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                    <img src="../../assets/img/illustrations/card-website-analytics-1.png"
                                        alt="Website Analytics" height="150" class="card-website-analytics-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Up Coming Appointment</h5>
                                <small>Total 28.5% Conversion Rate</small>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                <h6 class="text-white mt-0 mt-md-3 mb-4">Spending</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">12h</p>
                                                <p class="mb-0">Spend</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">127</p>
                                                <p class="mb-0">Order</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">18</p>
                                                <p class="mb-0">Order Size</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">2.3k</p>
                                                <p class="mb-0">Items</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                <img src="../../assets/img/illustrations/card-website-analytics-2.png"
                                    alt="Website Analytics" height="150" class="card-website-analytics-img">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide bg-danger">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Cancel Appointment</h5>
                                <small>Total 28.5% Conversion Rate</small>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                <h6 class="text-white mt-0 mt-md-3 mb-4">Revenue Sources</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">268</p>
                                                <p class="mb-0">Direct</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">62</p>
                                                <p class="mb-0">Referral</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">890</p>
                                                <p class="mb-0">Organic</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.2k</p>
                                                <p class="mb-0">Campaign</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                <img src="../../assets/img/illustrations/card-website-analytics-3.png"
                                    alt="Website Analytics" height="150" class="card-website-analytics-img">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-white mb-0">Total Appointment</h5>
                                <small>Total 28.5% Conversion Rate</small>
                            </div>
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                <h6 class="text-white mt-0 mt-md-3 mb-4">Revenue Sources</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">268</p>
                                                <p class="mb-0">Direct</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">62</p>
                                                <p class="mb-0">Referral</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-flex mb-4 align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">890</p>
                                                <p class="mb-0">Organic</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium me-2 website-analytics-text-bg">1.2k</p>
                                                <p class="mb-0">Campaign</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                <img src="../../assets/img/illustrations/card-website-analytics-3.png"
                                    alt="Website Analytics" height="150" class="card-website-analytics-img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="container-fluid px-0">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Website Analytics -->

        <!-- Average Daily Sales -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5 class="mb-3 card-title">Average Daily Appointment Amount</h5>
                    <p class="mb-0 text-body">Total Sales This Month</p>
                    <h4 class="mb-0">$28,450</h4>
                </div>
                <div class="card-body px-0">
                    <div id="averageDailySales"></div>
                </div>
            </div>
        </div>
        <!--/ Average Daily Sales -->

        <!-- Sales Overview -->
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 text-body">Sales Overview</p>
                        <p class="card-text fw-medium text-success">+18.2%</p>
                    </div>
                    <h4 class="card-title mb-1">$42.5k</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <span class="badge bg-label-info p-1 rounded"><i
                                        class="ti ti-shopping-cart ti-sm"></i></span>
                                <p class="mb-0">Order</p>
                            </div>
                            <h5 class="mb-0 pt-1">62.2%</h5>
                            <small class="text-muted">6,440</small>
                        </div>
                        <div class="col-4">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0">Visits</p>
                                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-sm"></i></span>
                            </div>
                            <h5 class="mb-0 pt-1">25.5%</h5>
                            <small class="text-muted">12,749</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-6">
                        <div class="progress w-100" style="height: 10px;">
                            <div class="progress-bar bg-info" style="width: 70%" role="progressbar" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Sales Overview -->
        <div class="col-xl-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-7">
                        <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0">Congratulations {{ Auth::User()->name }}! 🎉</h5>
                            <p class="mb-2">Best seller of the month</p>
                            <h4 class="text-primary mb-1">48.9k <i class="fa-solid fa-bangladeshi-taka-sign"></i></h4>
                            <a href="javascript:;" class="btn btn-primary">View Sales</a>
                        </div>
                    </div>
                    <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../../assets/img/illustrations/card-advance-sale.png" height="140"
                                alt="view sales">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Statistics -->
        <div class="col-xl-8 col-md-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Statistics</h5>
                    <small class="text-muted">Updated 1 month ago</small>
                </div>
                <div class="card-body d-flex align-items-end">
                    <div class="w-100">
                        <div class="row gy-3">
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-primary me-4 p-2"><i
                                            class="ti ti-chart-pie-2 ti-lg"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">230k</h5>
                                        <small>Sales</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-info me-4 p-2"><i class="ti ti-users ti-lg"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">8.549k</h5>
                                        <small>Customers</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-danger me-4 p-2"><i
                                            class="ti ti-shopping-cart ti-lg"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">1.423k</h5>
                                        <small>Products</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded bg-label-success me-4 p-2"><i
                                            class="ti ti-currency-dollar ti-lg"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">$9745</h5>
                                        <small>Revenue</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics -->
        <!-- Earning Reports -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Earning Reports</h5>
                        <p class="card-subtitle">Weekly Earnings Overview</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="earningReportsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center g-md-8">
                        <div class="col-12 col-md-5 d-flex flex-column">
                            <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
                                <h2 class="mb-0">$468</h2>
                                <div class="badge rounded bg-label-success">+4.2%</div>
                            </div>
                            <small class="text-body">You informed of this week compared to last week</small>
                        </div>
                        <div class="col-12 col-md-7 ps-xl-8">
                            <div id="weeklyEarningReports"></div>
                        </div>
                    </div>
                    <div class="border rounded p-5 mt-5">
                        <div class="row gap-4 gap-sm-0">
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-primary p-1"><i
                                            class="ti ti-currency-dollar ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0 fw-normal">Earnings</h6>
                                </div>
                                <h4 class="my-2">$545.69</h4>
                                <div class="progress w-75" style="height:4px">
                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0 fw-normal">Profit</h6>
                                </div>
                                <h4 class="my-2">$256.34</h4>
                                <div class="progress w-75" style="height:4px">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="badge rounded bg-label-danger p-1"><i
                                            class="ti ti-brand-paypal ti-sm"></i>
                                    </div>
                                    <h6 class="mb-0 fw-normal">Expense</h6>
                                </div>
                                <h4 class="my-2">$74.19</h4>
                                <div class="progress w-75" style="height:4px">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 65%"
                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Earning Reports -->

        <!-- Support Tracker -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Support Tracker</h5>
                        <p class="card-subtitle">Last 7 Days</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="supportTrackerMenu" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                        <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                            <h2 class="mb-0">164</h2>
                            <p class="mb-0">Total Tickets</p>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-primary p-1_5"><i class="ti ti-ticket ti-md"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">New Tickets</h6>
                                    <small class="text-muted">142</small>
                                </div>
                            </li>
                            <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                <div class="badge rounded bg-label-info p-1_5"><i class="ti ti-circle-check ti-md"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Open Tickets</h6>
                                    <small class="text-muted">28</small>
                                </div>
                            </li>
                            <li class="d-flex gap-4 align-items-center pb-1">
                                <div class="badge rounded bg-label-warning p-1_5"><i class="ti ti-clock ti-md"></i></div>
                                <div>
                                    <h6 class="mb-0 text-nowrap">Response Time</h6>
                                    <small class="text-muted">1 Day</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                        <div id="supportTracker"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Support Tracker -->

        <!-- Sales By Country -->
        <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Sales by Countries</h5>
                        <p class="card-subtitle">Monthly Sales Overview</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="salesByCountry" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountry">
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex align-items-center mb-4">
                            <div class="avatar flex-shrink-0 me-4">
                                <i class="fis fi fi-us rounded-circle fs-2"></i>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">$8,567k</h6>

                                    </div>
                                    <small class="text-body">United states</small>
                                </div>
                                <div class="user-progress">
                                    <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                        <i class='ti ti-chevron-up'></i>
                                        25.8%
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <div class="avatar flex-shrink-0 me-4">
                                <i class="fis fi fi-br rounded-circle fs-2"></i>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">$2,415k</h6>
                                    </div>
                                    <small class="text-body">Brazil</small>
                                </div>
                                <div class="user-progress">
                                    <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                        <i class='ti ti-chevron-down'></i>
                                        6.2%
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <div class="avatar flex-shrink-0 me-4">
                                <i class="fis fi fi-in rounded-circle fs-2"></i>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">$865k</h6>
                                    </div>
                                    <small class="text-body">India</small>
                                </div>
                                <div class="user-progress">
                                    <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                        <i class='ti ti-chevron-up'></i>
                                        12.4%
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <div class="avatar flex-shrink-0 me-4">
                                <i class="fis fi fi-au rounded-circle fs-2"></i>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">$745k</h6>
                                    </div>
                                    <small class="text-body">Australia</small>
                                </div>
                                <div class="user-progress">
                                    <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                                        <i class='ti ti-chevron-down'></i>
                                        11.9%
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <div class="avatar flex-shrink-0 me-4">
                                <i class="fis fi fi-fr rounded-circle fs-2"></i>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">$45</h6>
                                    </div>
                                    <small class="text-body">France</small>
                                </div>
                                <div class="user-progress">
                                    <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                        <i class='ti ti-chevron-up'></i>
                                        16.2%
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-4">
                                <i class="fis fi fi-cn rounded-circle fs-2"></i>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">$12k</h6>
                                    </div>
                                    <small class="text-body">China</small>
                                </div>
                                <div class="user-progress">
                                    <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                                        <i class='ti ti-chevron-up'></i>
                                        14.8%
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Sales By Country -->

        <!-- Total Earning -->
        <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 card-title">Total Earning</h5>
                        <div class="dropdown">
                            <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                                type="button" id="totalEarning" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti ti-dots-vertical ti-md text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarning">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <h2 class="mb-0 me-2">87%</h2>
                        <i class="ti ti-chevron-up text-success me-1"></i>
                        <h6 class="text-success mb-0">25.8%</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div id="totalEarningChart"></div>
                    <div class="d-flex align-items-start my-4">
                        <div class="badge rounded bg-label-primary p-2 me-4 rounded"><i
                                class="ti ti-brand-paypal ti-md"></i></div>
                        <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                            <div class="me-2">
                                <h6 class="mb-0">Total Revenue</h6>
                                <small class="text-body">Client Payment</small>
                            </div>
                            <h6 class="mb-0 text-success">+$126</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="badge rounded bg-label-secondary p-2 me-4 rounded"><i
                                class="ti ti-currency-dollar ti-md"></i></div>
                        <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                            <div class="me-2">
                                <h6 class="mb-0">Total Sales</h6>
                                <small class="text-body">Refund</small>
                            </div>
                            <h6 class="mb-0 text-success">+$98</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Earning -->

        <!-- Monthly Campaign State -->
        <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Monthly Campaign State</h5>
                        <p class="card-subtitle">8.52k Social Visiters</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="MonthlyCampaign" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="mb-6 d-flex justify-content-between align-items-center">
                            <div class="badge bg-label-success rounded p-1_5"><i class="ti ti-mail ti-md"></i></div>
                            <div class="d-flex justify-content-between w-100 flex-wrap">
                                <h6 class="mb-0 ms-4">Emails</h6>
                                <div class="d-flex">
                                    <p class="mb-0">12,346</p>
                                    <p class="ms-4 text-success mb-0">0.3%</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6 d-flex justify-content-between align-items-center">
                            <div class="badge bg-label-info rounded p-1_5"><i class="ti ti-link ti-md"></i></div>
                            <div class="d-flex justify-content-between w-100 flex-wrap">
                                <h6 class="mb-0 ms-4">Opened</h6>
                                <div class="d-flex">
                                    <p class="mb-0">8,734</p>
                                    <p class="ms-4 text-success mb-0">2.1%</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6 d-flex justify-content-between align-items-center">
                            <div class="badge bg-label-warning rounded p-1_5"><i class="ti ti-mouse ti-md"></i></div>
                            <div class="d-flex justify-content-between w-100 flex-wrap">
                                <h6 class="mb-0 ms-4">Clicked</h6>
                                <div class="d-flex">
                                    <p class="mb-0">967</p>
                                    <p class="ms-4 text-danger mb-0">1.4%</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6 d-flex justify-content-between align-items-center">
                            <div class="badge bg-label-primary rounded p-1_5"><i class="ti ti-users ti-md"></i></div>
                            <div class="d-flex justify-content-between w-100 flex-wrap">
                                <h6 class="mb-0 ms-4">Subscribe</h6>
                                <div class="d-flex">
                                    <p class="mb-0">345</p>
                                    <p class="ms-4 text-success mb-0">8.5%</p>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6 d-flex justify-content-between align-items-center">
                            <div class="badge bg-label-secondary rounded p-1_5"><i class="ti ti-alert-triangle ti-md"></i>
                            </div>
                            <div class="d-flex justify-content-between w-100 flex-wrap">
                                <h6 class="mb-0 ms-4">Complaints</h6>
                                <div class="d-flex">
                                    <p class="mb-0">10</p>
                                    <p class="ms-4 text-danger mb-0">1.5%</p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <div class="badge bg-label-danger rounded p-1_5"><i class="ti ti-ban ti-md"></i></div>
                            <div class="d-flex justify-content-between w-100 flex-wrap">
                                <h6 class="mb-0 ms-4">Unsubscribe</h6>
                                <div class="d-flex">
                                    <p class="mb-0">86</p>
                                    <p class="ms-4 text-success mb-0">0.8%</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Monthly Campaign State -->

        <!-- Source Visit -->
        <div class="col-xxl-4 col-xl-6 col-lg-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">Source Visits</h5>
                        <p class="card-subtitle">38.4k Visitors</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                            id="sourceVisits" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sourceVisits">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-6">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i
                                        class="ti ti-shadow ti-md"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Direct Source</h6>
                                        <small class="text-body">Direct link click</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">1.2k</p>
                                        <div class="ms-4 badge bg-label-success">+4.2%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i
                                        class="ti ti-globe ti-md"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Social Network</h6>
                                        <small class="text-body">Social Channels</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">31.5k</p>
                                        <div class="ms-4 badge bg-label-success">+8.2%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i
                                        class="ti ti-mail ti-md"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Email Newsletter</h6>
                                        <small class="text-body">Mail Campaigns</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">893</p>
                                        <div class="ms-4 badge bg-label-success">+2.4%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i
                                        class="ti ti-external-link ti-md"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Referrals</h6>
                                        <small class="text-body">Impact Radius Visits</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">342</p>
                                        <div class="ms-4 badge bg-label-danger">-0.4%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-6">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i
                                        class="ti ti-ad ti-md"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">ADVT</h6>
                                        <small class="text-body">Google ADVT</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">2.15k</p>
                                        <div class="ms-4 badge bg-label-success">+9.1%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-secondary text-body p-2 me-4 rounded"><i
                                        class="ti ti-star ti-md"></i></div>
                                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Other</h6>
                                        <small class="text-body">Many Sources</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">12.5k</p>
                                        <div class="ms-4 badge bg-label-success">+6.2%</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Source Visit -->

        <!-- Projects table -->
        <div class="col-xxl-8">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-projects table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Project</th>
                                <th>Leader</th>
                                <th>Team</th>
                                <th class="w-px-200">Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--/ Projects table -->
    </div>

    <!-- Appointment Modal -->

    <form id="appointmentStatusForm" method="POST" action="{{ route('admin.dashboard.update.status') }}"
        onsubmit="return confirm('Are you sure you want to update the booking status?')">

        @csrf
        <input type="hidden" name="appointment_id" id="modalAppointmentId">

        <!-- Modal -->
        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Appointment Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Client:</strong> <span id="modalAppointmentName">N/A</span></p>
                        <p><strong>Service:</strong> <span id="modalService">N/A</span></p>
                        <p><strong>Email:</strong> <span id="modalEmail">N/A</span></p>
                        <p><strong>Phone:</strong> <span id="modalPhone">N/A</span></p>
                        <p><strong>Staff:</strong> <span id="modalStaff">N/A</span></p>
                        <p><strong>Date & Time:</strong> <span id="modalStartTime">N/A</span></p>
                        {{-- <p><strong>End:</strong> <span id="modalEndTime">N/A</span></p> --}}
                        <p><strong>Amount:</strong> <span id="modalAmount">N/A</span></p>
                        <p><strong>Notes:</strong> <span id="modalNotes">N/A</span></p>
                        <p><strong>Current Status:</strong> <span id="modalStatusBadge">N/A</span></p>

                        <div class="form-group">
                            <label><strong>Change Status:</strong></label>
                            <select name="status" class="form-control" id="modalStatusSelect">
                                <option value="Pending payment">Pending payment</option>
                                <option value="Processing">Processing</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Completed">Completed</option>
                                <option value="On Hold">On Hold</option>
                                <option value="No Show">No Show</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Update Status</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" />
    <style>
        #calendar {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .fc-toolbar h2 {
            font-size: 1.2em;
        }

        /* DAILY VIEW OPTIMIZATIONS */
        .fc-agendaDay-view .fc-time-grid-container {
            height: auto !important;
        }

        .fc-agendaDay-view .fc-event {
            margin: 1px 2px;
            border-radius: 3px;
        }

        .fc-agendaDay-view .fc-event.short-event {
            height: 30px;
            font-size: 0.85em;
            padding: 2px;
        }

        .fc-agendaDay-view .fc-event .fc-content {
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fc-agendaDay-view .fc-time {
            width: 50px !important;
        }

        .fc-agendaDay-view .fc-time-grid {
            min-height: 600px !important;
        }

        .fc-agendaDay-view .fc-event.fc-short-event {
            height: 35px;
            font-size: 0.85em;
        }

        .fc-agendaDay-view .fc-time {
            width: 70px !important;
            padding: 0 10px;
        }

        .fc-agendaDay-view .fc-axis {
            width: 70px !important;
        }

        .fc-agendaDay-view .fc-content-skeleton {
            padding-bottom: 5px;
        }

        .fc-agendaDay-view .fc-slats tr {
            height: 40px;
        }

        .fc-event {
            opacity: 0.9;
            transition: opacity 0.2s;
        }

        .fc-event:hover {
            opacity: 1;
            z-index: 1000 !important;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>


    <script>
        $(document).ready(function() {
            // Initialize toasts first
            // $('.toast').toast({
            //     delay: 5000
            // });

            // Initialize calendar
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaDay'
                },
                defaultView: 'month',
                editable: false,
                slotDuration: '00:30:00',
                minTime: '06:00:00',
                maxTime: '22:00:00',
                events: @json($appointments ?? []),
                eventRender: function(event, element) {
                    element.tooltip({
                        title: event.description || 'No description',
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                eventClick: function(calEvent, jsEvent, view) {
                    // Populate modal with event data
                    $('#modalAppointmentId').val(calEvent.id);
                    $('#modalAppointmentName').text(calEvent.name || calEvent.title.split(' - ')[0] ||
                        'N/A');
                    $('#modalService').text(calEvent.service_title || calEvent.title.split(' - ')[1] ||
                        'N/A');
                    $('#modalEmail').text(calEvent.email || 'N/A');
                    $('#modalPhone').text(calEvent.phone || 'N/A');
                    $('#modalStaff').text(calEvent.staff || 'N/A');
                    $('#modalAmount').text(calEvent.amount || 'N/A');
                    $('#modalNotes').text(calEvent.description || calEvent.notes || 'N/A');
                    $('#modalStartTime').text(moment(calEvent.start).format('MMMM D, YYYY h:mm A'));
                    $('#modalEndTime').text(calEvent.end ? moment(calEvent.end).format(
                        'MMMM D, YYYY h:mm A') : 'N/A');

                    // Get the status from the calendar event
                    var status = calEvent.status || 'Pending payment';
                    $('#modalStatusSelect').val(status);

                    // Set status badge
                    var statusColors = {
                        'Pending payment': '#f39c12',
                        'Processing': '#3498db',
                        'Confirmed': '#2ecc71',
                        'Cancelled': '#ff0000',
                        'Completed': '#008000',
                        'On Hold': '#95a5a6',
                        'No Show': '#e67e22',
                    };

                    var badgeColor = statusColors[status] || '#7f8c8d';
                    $('#modalStatusBadge').html(
                        `<span class="badge px-2 py-1" style="background-color: ${badgeColor}; color: white;">${status}</span>`
                    );

                    $('#appointmentModal').modal('show');
                }
            });

            // Single form submission handler



        });
    </script>

    <script>
        $(document).ready(function() {
            $(".alert").delay(2000).slideUp(300);
        });
    </script>
@endsection
