@extends('backend.layouts.app')

@section('title')
    Dashboard
@endsection

@section('styles')
    @parent

    @stack('styles')
@endsection

@section('content')
	<div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="widget-stat card bg-primary">
                        <div class="card-body  p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Total Users</p>
                                    <h4 class="text-white">
                                        <?php
                                            if ($totalUserCount < 1000) {
                                                // Anything less than a thousand
                                                $totalUser = $totalUserCount;
                                            }else if($totalUserCount < 1000000){
                                                // Anything less than a million
                                                $totalUser = $totalUserCount / 1000 . ' K';
                                            } else if ($totalUserCount < 1000000000) {
                                                // Anything less than a billion
                                                $totalUser = $totalUserCount / 1000000 . ' M';
                                            } else {
                                                // At least a billion
                                                $totalUser = $totalUserCount / 1000000000 . ' B';
                                            }
                                        ?>
                                        {{$totalUser}}
                                    </h4>
                                    
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="widget-stat card bg-danger">
                        <div class="card-body  p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Banned Users</p>
                                    <h4 class="text-white">
                                        <?php
                                            if ($totalBannedUserCount < 1000) {
                                                // Anything less than a thousand
                                                $totalBannedUser = $totalBannedUserCount;
                                            }else if($totalBannedUserCount < 1000000){
                                                // Anything less than a million
                                                $totalBannedUser = $totalBannedUserCount / 1000 . ' K';
                                            } else if ($totalBannedUserCount < 1000000000) {
                                                // Anything less than a billion
                                                $totalBannedUser = $totalBannedUserCount / 1000000 . ' M';
                                            } else {
                                                // At least a billion
                                                $totalBannedUser = $totalBannedUserCount / 1000000000 . ' B';
                                            }
                                        ?>
                                        {{$totalBannedUser}}
                                    </h4>
                                    
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="widget-stat card bg-success">
                        <div class="card-body  p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Active Users</p>
                                    <h4 class="text-white">
                                        <?php
                                            if ($totalActiveUserCount < 1000) {
                                                // Anything less than a thousand
                                                $totalActiveUser = $totalActiveUserCount;
                                            }else if($totalActiveUserCount < 1000000){
                                                // Anything less than a million
                                                $totalActiveUser = $totalActiveUserCount / 1000 . ' K';
                                            } else if ($totalActiveUserCount < 1000000000) {
                                                // Anything less than a billion
                                                $totalActiveUser = $totalActiveUserCount / 1000000 . ' M';
                                            } else {
                                                // At least a billion
                                                $totalActiveUser = $totalActiveUserCount / 1000000000 . ' B';
                                            }
                                        ?>
                                        {{$totalActiveUser}}
                                    </h4>
                                    
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="widget-stat card bg-secondary">
                        <div class="card-body  p-4">
                            <div class="media">
                                <span class="me-3">
                                    <i class="fas fa-users"></i>
                                </span>
                                <div class="media-body text-white">
                                    <p class="mb-1">Inactive Users</p>
                                    <h4 class="text-white">
                                        <?php
                                            if ($totalInactiveUserCount < 1000) {
                                                // Anything less than a thousand
                                                $totalInactiveUser = $totalInactiveUserCount;
                                            }else if($totalInactiveUserCount < 1000000){
                                                // Anything less than a million
                                                $totalInactiveUser = $totalInactiveUserCount / 1000 . ' K';
                                            } else if ($totalInactiveUserCount < 1000000000) {
                                                // Anything less than a billion
                                                $totalInactiveUser = $totalInactiveUserCount / 1000000 . ' M';
                                            } else {
                                                // At least a billion
                                                $totalInactiveUser = $totalInactiveUserCount / 1000000000 . ' B';
                                            }
                                        ?>
                                        {{$totalInactiveUser}}
                                    </h4>
                                    
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <!-- <div class="widget-stat card" style="height: unset">
                        <div class="card-body p-3 pt-2 pb-2">
                            <div class="media ai-icon">
                                <div class="media-body">
                                    <p class="text-muted fs-6 mb-2">Tenants</p>
                                    <h2 class="text-primary fs-1 mb-0">{{ 0 }}</h2>
                                </div>
                                <span class="text-success">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-header d-block d-sm-flex border-0">
                            <div>
                                <h4 class="fs-20 text-black">Market Overview</h4>
                                <p class="mb-0 fs-12">Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                            <div class="card-action card-tabs mt-3 mt-sm-0">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Week" role="tab">
                                            Week	
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Month" role="tab">
                                            Month
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Year" role="tab">
                                            Year
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body pb-0 pt-sm-3 pt-0 tab-content">
                            <div class="tab-pane fade active show" id="Month">
                                <div class="row">
                                    <div class="d-flex col-6 align-items-center">
                                        <div class="fs-18 font-w600 me-3">
                                            <span class="text-success pe-3">BUY</span>
                                            <span class="text-black pe-3">$5,673</span>
                                        </div>
                                        <div class="fs-18 font-w600 ms-auto">
                                            <span class="text-danger pe-3">SELL</span>
                                            <span class="text-black pe-3">$5,982</span>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="javascript:void(0);" class="btn btn-primary light btn-rounded"><i class="las la-download scale5 me-2"></i>Get Report</a>
                                    </div>
                                </div>
                                <div id="chartBarRunning" class="bar-chart"></div>
                            </div>
                            <div class="tab-pane fade" id="Week">
                                <div class="row">
                                    <div class="d-flex col-6 align-items-center">
                                        <div class="fs-18 font-w600 me-3">
                                            <span class="text-success pe-3">BUY</span>
                                            <span class="text-black pe-3">$3,472</span>
                                        </div>
                                        <div class="fs-18 font-w600 ms-auto">
                                            <span class="text-danger pe-3">SELL</span>
                                            <span class="text-black pe-3">$6,542</span>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="javascript:void(0);" class="btn btn-primary light btn-rounded"><i class="las la-download scale5 me-2"></i>Get Report</a>
                                    </div>
                                </div>
                                <div id="chartBarRunning2" class="bar-chart"></div>
                            </div>
                            <div class="tab-pane fade" id="Year">
                                <div class="row">
                                    <div class="d-flex col-6 align-items-center">
                                        <div class="fs-18 font-w600 me-3">
                                            <span class="text-success pe-3">BUY</span>
                                            <span class="text-black pe-3">$1,343</span>
                                        </div>
                                        <div class="fs-18 font-w600 ms-auto">
                                            <span class="text-danger pe-3">SELL</span>
                                            <span class="text-black pe-3">$3,482</span>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="javascript:void(0);" class="btn btn-primary light btn-rounded"><i class="las la-download scale5 me-2"></i>Get Report</a>
                                    </div>
                                </div>
                                <div id="chartBarRunning3" class="bar-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-12">
                    <div class="card">
                        <div class="card-header d-sm-flex d-block pb-0 border-0">
                            <div>
                                <h4 class="fs-20 text-black">Crypto Statistics</h4>
                                <p class="mb-0 fs-12">Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                            <div class="d-flex mt-sm-0 mt-3">
                                <div class="form-check form-switch text-end me-4 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customSwitch11">
                                    <label class="form-check-label fs-14 text-black pe-2" for="customSwitch11">Date</label>
                                </div>
                                <div class="form-check form-switch text-end me-4 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customSwitch12">
                                    <label class="form-check-label fs-14 text-black pe-2" for="customSwitch12">Value</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex flex-wrap crypto">
                                <div class="form-check custom-checkbox me-5 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customCheck9">
                                    <label class="form-check-label" for="customCheck9">
                                        <span class="d-block text-black font-w500">Bitcoin</span>
                                        <span class="fs-12">BTC</span>
                                    </label>
                                </div>
                                <div class="form-check custom-checkbox me-5 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customCheck91">
                                    <label class="form-check-label" for="customCheck91">
                                        <span class="d-block text-black font-w500">Ripple</span>
                                        <span class="fs-12">XRP</span>
                                    </label>
                                </div>
                                <div class="form-check custom-checkbox me-5 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customCheck92">
                                    <label class="form-check-label" for="customCheck92">
                                        <span class="d-block text-black font-w500">Ethereum</span>
                                        <span class="fs-12">ETH</span>
                                    </label>
                                </div>
                                <div class="form-check custom-checkbox me-5 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customCheck93">
                                    <label class="form-check-label" for="customCheck93">
                                        <span class="d-block text-black font-w500">Zcash</span>
                                        <span class="fs-12">ZEC</span>
                                    </label>
                                </div>
                                <div class="form-check custom-checkbox me-4 mb-2">
                                    <input type="checkbox" class="form-check-input" id="customCheck94">
                                    <label class="form-check-label" for="customCheck94">
                                        <span class="d-block text-black font-w500">LiteCoin</span>
                                        <span class="fs-12">LTC</span>
                                    </label>
                                </div>
                            </div>
                            <div id="lineChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-sm-flex d-block pb-0 border-0">
                                    <div>
                                        <h4 class="fs-20 text-black">Quick Transfer</h4>
                                        <p class="mb-0 fs-12">Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                    <select class="form-control custom-image-select-1 image-select mt-3 mt-sm-0">
                                        <option data-thumbnail="{{url('backend/images/svg/eth.svg')}}">23,511 ETH</option>
                                        <option data-thumbnail="{{url('backend/images/svg/lit3.svg')}}">345,455 ETH</option>
                                        <option data-thumbnail="{{url('backend/images/svg/btc.svg')}}">789,123 ETH</option>
                                    </select>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex mb-3 justify-content-between align-items-center">
                                        <h4 class="text-black fs-20 mb-0">Recent Contacts</h4>
                                        <a href="javascript:void(0);" class="btn-link">View more</a>
                                    </div>
                                    <div class="testimonial-one px-4 owl-right-nav owl-carousel owl-loaded owl-drag">
                                        <div class="items">
                                            <div class="text-center">
                                                <img class="mb-3 rounded" src="{{url('backend/images/contacts/1.jpg')}}" alt="">
                                                <h5 class="text-black mb-0">Samuel</h5>
                                                <span class="fs-12">@sam224</span>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="text-center">
                                                <img class="mb-3 rounded" src="{{url('backend/images/contacts/2.jpg')}}" alt="">
                                                <h5 class="text-black mb-0">Cindy</h5>
                                                <span class="fs-12">@cindyss</span>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="text-center">
                                                <img class="mb-3 rounded" src="{{url('backend/images/contacts/3.jpg')}}" alt="">
                                                <h5 class="text-black mb-0">David</h5>
                                                <span class="fs-12">@davidxc</span>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="text-center">
                                                <img class="mb-3 rounded" src="{{url('backend/images/contacts/4.jpg')}}" alt="">
                                                <h5 class="text-black mb-0">Martha</h5>
                                                <span class="fs-12">@marthaa</span>
                                            </div>
                                        </div>
                                        <div class="items">
                                            <div class="text-center">
                                                <img class="mb-3 rounded" src="{{url('backend/images/contacts/5.jpg')}}" alt="">
                                                <h5 class="text-black mb-0">Olivia</h5>
                                                <span class="fs-12">@oliv62</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amount-bx">
                                        <label>Amount ETH</label>
                                        <input type="number" class="form-control" placeholder="8,621.22">
                                    </div>
                                    <a href="javascript:(0);" class="btn btn-primary d-block btn-lg text-uppercase">Send Money</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <h4 class="mb-0 text-black fs-20">Sell Order</h4>
                                    <div class="dropdown ms-auto">
                                        <div class="btn-link" data-bs-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <select class="form-control custom-image-select-2 image-select mt-3 mt-sm-0">
                                        <option data-thumbnail="{{url('backend/images/svg/coin.svg')}}">Dash Coin</option>
                                        <option data-thumbnail="{{url('backend/images/svg/btc.svg')}}">Ripple</option>
                                        <option data-thumbnail="{{url('backend/images/svg/eth.svg')}}">Ethereum</option>
                                        <option data-thumbnail="{{url('backend/images/svg/btc.svg')}}">Bitcoin</option>
                                    </select>
                                    <div class="table-responsive">
                                        <table class="table text-center bg-info-hover tr-rounded">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Price</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left">82.3</td>
                                                    <td>0.15</td>
                                                    <td class="text-end">$134,12</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">83.9</td>
                                                    <td>0.18</td>
                                                    <td class="text-end">$237,31</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">84.2</td>
                                                    <td>0.25</td>
                                                    <td class="text-end">$252,58</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">86.2</td>
                                                    <td>0.35</td>
                                                    <td class="text-end">$126,26</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">91.6</td>
                                                    <td>0.75</td>
                                                    <td class="text-end">$46,92</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">92.6</td>
                                                    <td>0.21</td>
                                                    <td class="text-end">$123,27</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">93.9</td>
                                                    <td>0.55</td>
                                                    <td class="text-end">$212,56</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">94.2</td>
                                                    <td>0.18</td>
                                                    <td class="text-end">$129,26</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer border-0 pt-0 text-center">
                                    <a href="coin-details.html" class="btn-link">Show more <i class="fa fa-caret-right ms-2 scale-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <h4 class="mb-0 text-black fs-20">Buy Order</h4>
                                    <div class="dropdown ms-auto">
                                        <div class="btn-link" data-bs-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <select class="form-control custom-image-select-2 image-select mt-3 mt-sm-0">
                                        <option data-thumbnail="{{url('backend/images/svg/btc.svg')}}">Bitcoin</option>
                                        <option data-thumbnail="{{url('backend/images/svg/lit3.svg')}}">Litecoin</option>
                                        <option data-thumbnail="{{url('backend/images/svg/btc.svg')}}">Ripple</option>
                                        <option data-thumbnail="{{url('backend/images/svg/eth.svg')}}">Ethereum</option>
                                    </select>
                                    <div class="table-responsive">
                                        <table class="table text-center bg-warning-hover tr-rounded">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Price</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left">82.3</td>
                                                    <td>0.15</td>
                                                    <td class="text-end">$134,12</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">83.9</td>
                                                    <td>0.18</td>
                                                    <td class="text-end">$237,31</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">84.2</td>
                                                    <td>0.25</td>
                                                    <td class="text-end">$252,58</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">86.2</td>
                                                    <td>0.35</td>
                                                    <td class="text-end">$126,26</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">91.6</td>
                                                    <td>0.75</td>
                                                    <td class="text-end">$46,92</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">92.6</td>
                                                    <td>0.21</td>
                                                    <td class="text-end">$123,27</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">93.9</td>
                                                    <td>0.55</td>
                                                    <td class="text-end">$212,56</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">94.2</td>
                                                    <td>0.18</td>
                                                    <td class="text-end">$129,26</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer border-0 pt-0 text-center">
                                    <a href="coin-details.html" class="btn-link">Show more <i class="fa fa-caret-right ms-2 scale-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script src="{{url('backend/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	
	<!-- Chart piety plugin files -->
    <script src="{{url('backend/vendor/peity/jquery.peity.min.js')}}"></script>
	
	<!-- Apex Chart -->
	<script src="{{url('backend/vendor/apexchart/apexchart.js')}}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{url('backend/js/dashboard/dashboard-1.js')}}"></script>
    <script src="{{url('backend/vendor/owl-carousel/owl.carousel.js')}}"></script>
	<script>
		function carouselReview(){
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:20,
				nav:false,
				rtl:true,
				dots: false,
				navText: ['', ''],
				responsive:{
					0:{
						items:3
					},
					1:{
						items:4
					},
					2:{
						items:5
					},	
					3:{
						items:5
					},			
					
					4:{
						items:7
					},
					5:{
						items:5
					}
				}
			})
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});			
	</script>
    @stack('scripts')
@endsection
