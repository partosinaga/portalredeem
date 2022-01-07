
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

									<!--begin::Tab Navs(for desktop mode)-->
									<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
										<li class="nav-item">
											<a href="{{ route('customer.index') }}" class="nav-link py-4 px-6 active" role="tab">Select Voucher</a>
										</li>
									</ul>
									<!--begin::Tab Navs-->
								</div>
								<!--end::Left-->
								<!--begin::Topbar-->
								<div class="topbar bg-primary">
									<!--begin::Search-->
									<div class="dropdown">
										<!--begin::Toggle-->
										<div class="topbar-item">
											<div class="btn">
												<div class="btn font-weight-bolder btn-sm btn-light-success px-5">{{ formatRupiah($cust->campaign_recipient_current_balance) }}</div>
											</div>
										</div>
										<!--end::Toggle-->
									</div>
									<!--end::Search-->

									<!--begin::My Cart-->
									<div class="dropdown">
										<!--begin::Toggle-->
										<div class="topbar-item get-item-cart" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
											<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse">
												<span class="svg-icon svg-icon-xl">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
															<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
												<span class="pulse-ring"></span>
											</div>
										</div>
										<!--end::Toggle-->
										<!--begin::Dropdown-->
										<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-xl dropdown-menu-anim-up" style="">
											<form>
												<!--begin::Header-->
												<div class="d-flex align-items-center py-10 px-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg') }})">
													<span class="btn btn-md btn-icon bg-white-o-15 mr-4">
														<i class="flaticon2-shopping-cart-1 text-success"></i>
													</span>
													<h4 class="text-white m-0 flex-grow-1 mr-3">My Cart</h4>
												</div>
												<!--end::Header-->
												<!--begin::Scroll-->
												<div class="scroll scroll-push item-cart " data-scroll="true" data-height="250" data-mobile-height="200" style="height: 250px; overflow: hidden;">


												</div>
												<!--end::Scroll-->
												<!--begin::Summary-->
												<div class="p-8">
													<div class="text-right">
														<a href="{{ route('customer.cart', Session::get('customerId')) }}"><button type="button" class="btn btn-primary text-weight-bold">Buka Keranjang Belanja</button></a>
													</div>
												</div>
												<!--end::Summary-->
											</form>
										</div>
										<!--end::Dropdown-->
									</div>
									<!--end::My Cart-->


									<!--begin::User-->
									<div class="topbar-item">
										<div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
											<div class="d-flex flex-column text-right pr-sm-3">
												<span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">{{ $cust->campaign_recipient_name }}</span>
												<span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">{{ $cust->campaign_recipient_credential }}</span>
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