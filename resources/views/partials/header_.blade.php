
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>eVoucher - Prezent |  @yield('title')</title>
		<meta name="description" content="Engage Customers, Build Advocacy - prezent will help your business engage customers by using electronic voucher technology. Generating word of mouth impact about your product or service and build advocacy effectively." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="Engage Customers, Build Advocacy - prezent will help your business engage customers by using electronic voucher technology. Generating word of mouth impact about your product or service and build advocacy effectively.">
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="https://prezent.id/assets/img/favicon.png" />


		
		<!--begin::conditional asset-->
		@if(isset($header))
			@foreach ($header as $row)
			<link href="{{ asset($row) }}" rel="stylesheet" type="text/css" />
			@endforeach
		@endif
		<!--end::conditional asset-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
			<!--begin::Logo-->
			<a href="index.html">
				<img alt="Logo" src="{{ asset('assets/media/logos/logo-letter-9.png') }}" class="max-h-30px" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header flex-column header-fixed">
						<!--begin::Top-->
						<div class="header-top">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Left-->
								<div class="d-none d-lg-flex align-items-center mr-3">
									<!--begin::Logo-->
									<a href="/" class="mr-20">
										<img alt="Logo" src="{{ asset('assets/media/logos/logo-letter-9.png') }}" class="max-h-35px" />
									</a>
									<!--end::Logo-->
									@php
										$routeName = Route::currentRouteName();
								   	@endphp
									<!--begin::Tab Navs(for desktop mode)-->
									<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
										@php
											$active = str_contains($routeName,'home') ? 'active' : '' ;   
										@endphp
										<li class="nav-item">
											<a href="{{ route('home') }}" class="nav-link py-4 px-6 {{ $active }}" role="tab">Home</a>
										</li>

										@if (isAllowed('campaign', 'view'))
											@php
												$active = str_contains($routeName,'campaign') ? 'active' : '' ;   
												@endphp
											<li class="nav-item mr-3">
												<a href="{{ route('campaign.index') }}" class="nav-link py-4 px-6 {{ $active }}" role="tab">Campaign</a>
											</li>
										@endif
										
										@if (isAllowed('reports', 'view'))
											@php
												$active = str_contains($routeName,'reports') ? 'active' : '' ;   
											@endphp
											<li class="nav-item mr-3">
												<a href="{{ route('reports.index') }}" class="nav-link py-4 px-6 {{ $active }}" role="tab">Reports</a>
											</li>
										@endif

										@if (isAllowed('clients', 'view'))
											@php
												$active = str_contains($routeName,'clients') ? 'active' : '' ;   
											@endphp
											<li class="nav-item mr-3">
												<a href="{{ route('clients.index') }}" class="nav-link py-4 px-6 {{ $active }}" role="tab">Clients</a>
											</li>
										@endif

										@if (isAllowed('user', 'view'))
											@php
												$active = str_contains($routeName,'users') ? 'active' : '' ;   
											@endphp
											<li class="nav-item mr-3">
												<a href="{{ route('users.index') }}" class="nav-link py-4 px-6 {{ $active }}" role="tab">User Management</a>
											</li>
										@endif

										@if (isAllowed('balance', 'view'))
											@php
												$active = str_contains($routeName,'balance') ? 'active' : '' ;   
											@endphp
											
											  <li class="nav-item mr-3">
												<a href="#" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_balance" role="tab">Balance</a>
											</li>
										@endif

									</ul>
									<!--begin::Tab Navs-->
								</div>
								<!--end::Left-->
								<!--begin::Topbar-->
								<div class="topbar bg-primary">
									<!--begin::Search-->
									<div class="dropdown">
										<!--begin::Toggle-->
										<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
											<div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
												<span class="svg-icon svg-icon-xl">
													<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
										</div>
										<!--end::Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
											<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
												<!--begin:Form-->
												<form method="get" class="quick-search-form">
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<span class="svg-icon svg-icon-lg">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
														</div>
														<input type="text" class="form-control" placeholder="Search..." />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
															</span>
														</div>
													</div>
												</form>
												<!--end::Form-->
												<!--begin::Scroll-->
												<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
												<!--end::Scroll-->
											</div>
										</div>
										<!--end::Dropdown-->
									</div>
									<!--end::Search-->


									<!--begin::Notifications-->
									<div class="dropdown">
										<!--begin::Toggle-->
										<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
											<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-white">
												<span class="svg-icon svg-icon-xl">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
															<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												<span class="pulse-ring"></span>
											</div>
										</div>
										<!--end::Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
											<form>
												<!--begin::Header-->
												<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">
													<!--begin::Title-->
													<h4 class="d-flex flex-center rounded-top">
														<span class="text-white">User Notifications</span>
														<span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>
													</h4>
													<!--end::Title-->
													<!--begin::Tabs-->
													<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
														<li class="nav-item">
															<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Alerts</a>
														</li>
													</ul>
													<!--end::Tabs-->
												</div>
												<!--end::Header-->
												<!--begin::Content-->
												<div class="tab-content">
													<!--begin::Tabpane-->
													<div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
														<!--begin::Scroll-->
														<div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
															<!--begin::Item-->
															<div class="d-flex align-items-center mb-6">
																<!--begin::Symbol-->
																<div class="symbol symbol-40 symbol-light-primary mr-5">
																	<span class="symbol-label">
																		<span class="svg-icon svg-icon-lg svg-icon-primary">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																					<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																	</span>
																</div>
																<!--end::Symbol-->
																<!--begin::Text-->
																<div class="d-flex flex-column font-weight-bold">
																	<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Cool App</a>
																	<span class="text-muted">Marketing campaign planning</span>
																</div>
																<!--end::Text-->
															</div>
															<!--end::Item-->
														</div>
														<!--end::Scroll-->
														<!--begin::Action-->
														<div class="d-flex flex-center pt-7">
															<a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>
														</div>
														<!--end::Action-->
													</div>
													<!--end::Tabpane-->
												</div>
												<!--end::Content-->
											</form>
										</div>
										<!--end::Dropdown-->
									</div>
									<!--end::Notifications-->


									<!--begin::User-->
									<div class="topbar-item">
										<div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
											<div class="d-flex flex-column text-right pr-sm-3">
												<span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">{{ Auth::user()->email }}</span>
												<span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">{{ Auth::user()->name }}</span>
											</div>
											<span class="symbol symbol-35">
												<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">S</span>
											</span>
										</div>
									</div>
									<!--end::User-->
								</div>
								<!--end::Topbar-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Top-->
						<!--begin::Bottom-->
						<div class="header-bottom">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Header Menu Wrapper-->
								<div class="header-navs header-navs-left" id="kt_header_navs">
									<!--begin::Tab Navs(for tablet and mobile modes)-->
									<ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">
										<!--begin::Item-->
										<li class="nav-item mr-2">
											<a href="#" class="nav-link btn btn-clean active" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">Home</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item mr-2">
											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Reports</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item mr-2">
											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Orders</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="nav-item mr-2">
											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Help Ceter</a>
										</li>
										<!--end::Item-->
									</ul>
									<!--begin::Tab Navs-->
									<!--begin::Tab Content-->
									<div class="tab-content">
										<!--begin::Tab Pane-->
										<div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">
											<!--begin::Menu-->
											<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
												<!--begin::Nav-->
												<ul class="menu-nav">
													<li class="menu-item menu-item-active" aria-haspopup="true">
														<a href="javascript:;" class="menu-link">
															<span class="menu-text">@yield('contentTitle')</span>
														</a>
													</li>
												</ul>
												<!--end::Nav-->
											</div>
											<!--end::Menu-->
										</div>

										<div class="tab-pane p-5 p-lg-0 justify-content-between" id="kt_header_balance">
											<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
												<!--begin::Nav-->
												<ul class="menu-nav">
													<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
														<a href="{{route('balance.index')}}" class="menu-link menu-toggle">
															<span class="menu-text">Topup Balance History</span>
															<span class="menu-desc"></span>
															<i class="menu-arrow"></i>
														</a>
													</li>
													<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
														<a href="{{route('balance.history')}}" class="menu-link menu-toggle">
															<span class="menu-text">Campaign History</span>
															<span class="menu-desc"></span>
															<i class="menu-arrow"></i>
														</a>
													</li>
												</ul>
												<!--end::Nav-->
											</div>
										</div>

									</div>
									<!--end::Tab Content-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Bottom-->
					</div>
					<!--end::Header-->

					@if (isset($breadcrumb))	
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
						<div class="container align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									@foreach ($breadcrumb as $key => $val)
										<li class="breadcrumb-item"><a href="{{ $val }}">{{ $key }}</a></li>
									@endforeach
								</ol>
							  </nav>
						</div>
					</div>
					<!--end::Subheader-->
					@endif
					