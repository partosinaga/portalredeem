
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
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title>eVoucher | Prezent - Send Voucher</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="{{ asset('assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
				<div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-color: #E0EAF3;">
					<div class="login-form text-center p-7 position-relative overflow-hidden card" >
						<!--begin::Login Header-->
                        <div class="mb-20">
                            <h2>Gift or Send Voucher</h2>
                        </div>
						<div class="d-flex flex-center mb-15">
							<div>
								<img src="{{ env('PRZ_API_END')."/storage/voucher/original/".$voucher['voucher_catalog_main_image_url'] }}" class="max-h-300px" alt="voucher image" />
                            </div>
						</div>
                        <div class="mb-20">
                            <div class="text-primary">Voucher ini berlaku sampai: 30 Juni 2021</div>
                        </div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin">
                            <div>
                                <h5>Voucher akan di kirim melalui:</h5>
                            </div>
							<form class="form" action="{{route('voucher.send.process')}}" method="post" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="radio-list">
                                        <label class="radio">
                                            <input type="radio" name="method" id="sms" value="sms">
                                            <span></span>SMS
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="radio-list">
                                        <label class="radio">
                                            <input type="radio" name="method" id="email" value="email">
                                            <span></span>Email
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="medium-padding d-none triggerInput" id="emailInput">
                                        <input type="email" name="email" class="form-control form-control-solid form-control-lg trigger" disabled required value="" placeholder="Alamat e-mail"/>
                                    </div>	
                                </div>

                                <div class="form-group">
                                    <div class="medium-padding d-none triggerInput" id="phoneInput">
                                        <input type="number" name="phone" class="form-control form-control-solid form-control-lg trigger" disabled value="" placeholder="Nomor Handphone"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('customer.index') }}"><button type="button" class="btn btn-danger btn-sm btn-block">Cancel</button></a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">Send</button>
                                    </div>
                                </div>
							</form>

						</div>
						<!--end::Login Sign in form-->
					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script>
		<!--end::Page Scripts-->
        <script>
            $(document).ready(function(){
                $('[type="radio"]').change(function(){
                    var state = $(this).val();
                    $('.trigger').attr('disabled');
                    $('.trigger').removeAttr('required');
                    if(state == 'email') {
                        $('.triggerInput').addClass('d-none');
                        $('#emailInput').removeClass('d-none');
                        $('#emailInput input').removeAttr('disabled');
                    }
                    else {
                        $('.triggerInput').addClass('d-none');
                        $('#phoneInput').removeClass('d-none');
                        $('#phoneInput input').removeAttr('disabled');
                    }
                });
            });
        </script>

        
	</body>
	<!--end::Body-->
</html>