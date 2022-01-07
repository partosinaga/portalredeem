
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
	<head><base href="../../../">
		<meta charset="utf-8" />
		<title>Login Page | Prezent</title>
		<meta name="description" content="Engage Customers, Build Advocacy - prezent will help your business engage customers by using electronic voucher technology. Generating word of mouth impact about your product or service and build advocacy effectively." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
					<!--begin::Aside Top-->
					<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
						<!--begin::Aside header-->
						<!--end::Aside header-->
						<!--begin::Aside title-->
						<h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">#BETTERVOUCHERSOLUTIONS</h3>
						<!--end::Aside title-->
					</div>
					<!--end::Aside Top-->
					<!--begin::Aside Bottom-->
					<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(assets/media/svg/illustrations/login-visual-1.svg)"></div>
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
					<!--begin::Content body-->
					<div class="d-flex flex-column-fluid flex-center">
						<!--begin::Signin-->
						<div class="login-form login-signin">
							<!--begin::Form-->
							{{-- <form class="form" novalidate="novalidate" method="POST" action="{{ route('login') }}">
								 @csrf
								<!--begin::Title-->
								<div class="pb-13 pt-lg-0 pt-5">
									<img class="img-fluid" src="/assets/media/logos/logo-600.png" alt="prezent logo"/><br/>
								</div>
								<!--begin::Title-->
								<!--begin::Form group-->
								<div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="text" name="email" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">
									<div class="d-flex justify-content-between mt-n5">
										<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
										<a href="{{ route('password.request') }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot" >Forgot Password ?</a>
									</div>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Action-->
								<div class="pb-lg-0 pb-5">
									<button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Login</button>
								</div>
								<!--end::Action-->
							</form> --}}
							<!--end::Form-->

							{{-- custom login --}}

							<form class="form" novalidate="novalidate" method="POST" id="kt_login_signin_form">
								<!--begin::Title-->
							   <div class="pb-13 pt-lg-0 pt-5">
								   <img class="img-fluid" src="/assets/media/logos/logo-600.png" alt="prezent logo"/><br/>
							   </div>
							   <!--begin::Title-->
							   <!--begin::Form group-->
							   <div class="form-group">
								   <label class="font-size-h6 font-weight-bolder text-dark">Credential</label>
								   <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="text" name="email" autocomplete="on" />
							   </div>
							   <!--end::Form group-->
							   <!--begin::Action-->
							   <div class="pb-lg-0 pb-5">
								   <button type="button" id="btn-login-check" class="btn btn-primary btn-login font-weight-bolder btn-block font-size-h6 px-8 py-4 my-3 mr-3">  Login</button>
							   </div>
							   <!--end::Action-->
							   <!--begin::Form group-->
							   <div class="form-group">
								   <div class="d-flex justify-content-between mt-n5">
									   <p class="text-primary font-size-h6 font-weight pt-5 text-dark"  > Don't have an account? <a href="https://prezent.id" target="_blank"> Contact us</a> to create one</p>
								   </div>
							   </div>
							   <!--end::Form group-->
								<div class="form-group d-flex flex-wrap justify-content-between align-items-center">
									<a href="javascript:;" class="text-dark-50 text-hover-primary my-3 mr-2" id="kt_login_forgot">Forgot Password ?</a>
								</div>
								@if ($message = Session::get('message'))
									<div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
										<div class="alert-text">{{ $message }}</div>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								@endif
								@if($errors->any())
									@foreach ($errors->all() as $error)

										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<div class="alert-text">{{ $error }}</div>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

									@endforeach
								@endif
						   </form>
 
							{{-- end of custom login --}}

						</div>
						<!--end::Signin-->
						<!--begin::Signup-->
						<div class="login-form login-signup">
							<!--begin::Form-->
							<form class="form" novalidate="novalidate" id="kt_login_signup_form">
								<!--begin::Title-->
								<div class="pb-13 pt-lg-0 pt-5">
									<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
									<p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
								</div>
								<!--end::Title-->
								<!--begin::Form group-->
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group">
									<label class="checkbox mb-0">
										<input type="checkbox" name="agree" />
										<span></span>
										<div class="ml-2">I Agree the
										<a href="#">terms and conditions</a>.</div>
									</label>
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
									<button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
									<button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
								</div>
								<!--end::Form group-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signup-->
						<!--begin::Forgot-->
						<div class="login-form login-forgot">
							<!--begin::Form-->
							<form class="form" id="kt_login_forgot_form" method="POST" action="{{ route('reset.password') }}">
								@csrf
								<!--begin::Title-->
								<div class="pb-13 pt-lg-0 pt-5">
									<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
									<p class="text-muted font-weight-bold font-size-h4">Enter your email to get new password</p>
								</div>
								<!--end::Title-->
								<!--begin::Form group-->
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" />
								</div>
								<!--end::Form group-->
								<!--begin::Form group-->
								<div class="form-group d-flex flex-wrap pb-lg-0">
									<button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
									<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
								</div>
								<!--end::Form group-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Forgot-->
					</div>
					<!--end::Content body-->
					<!--begin::Content footer-->
					<div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
						<div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
							<span class="mr-1">2021©</span>
							<a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Sprint Asia Technology</a>
						</div>
					</div>
					<!--end::Content footer-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->

		<!-- Modal password-->
		<div class="modal fade" id="modal-password" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					<div class="modal-body">
						<form class="form" novalidate="novalidate" method="POST" action="{{ route('login') }}">
							@csrf
						   <!--begin::Form group-->
						   <div class="form-group">
							   <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg d-none" type="text" name="email" autocomplete="off" />
						   </div>
						   <!--end::Form group-->
						   <!--begin::Form group-->
						   <div class="form-group">
							   <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password" name="password" autocomplete="off" placeholder="Input password" />
						   </div>
						   <!--end::Form group-->
						   <!--begin::Action-->
						   <div class="pb-lg-0 pb-5">
							   <button type="submit" class="btn btn-primary font-weight-bolder  btn-block font-size-h6 px-8 py-4 my-3 mr-3">Login</button>
						   </div>
						   <!--end::Action-->
					   	</form>
					</div>
				</div>
			</div>
		</div>
		<!--end modal password-->

		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->

		<!--begin::custom jd-->
		<script>
			// login
			$('#btn-login-check').click(function(){
				var input = $('input[name="email"]').val();
				if(input == '')
				{
					toastr.error('Please enter your credential');
					return true
				}
				$('.btn-login').addClass('spinner spinner-white spinner-right');
				$('.btn-login').attr('disabled', true);
				$.ajax({
					url: "{{ route('login.credential.check') }}",
					method: "post",
					data: {
						_token: "{{ csrf_token() }}",
						email: input
					},
					success:function(data){
						if (data.code == 100) {
							$('input[name="email"]').val(input);
							$('#modal-password').modal('show');
							$('.btn-login').removeClass('spinner spinner-white spinner-right');
							$('.btn-login').attr('disabled', false);
						}
						if (data.code == 200) {
							window.location.href = "{{ route('customer.index')}}";
						}
						if(data.code == 400)
						{
							$('.btn-login').removeClass('spinner spinner-white spinner-right');
							$('.btn-login').attr('disabled', false);
							toastr.error('Credential not found!');	
						}
					},
					error:function()
					{
						$('.btn-login').removeClass('spinner spinner-white spinner-right');
						$('.btn-login').attr('disabled', false);
						toastr.error('There is something wrong, try again later!');
					}
				})

			})
			// end login
		</script>
		<!--end::custom js-->
	</body>
	<!--end::Body-->
</html>