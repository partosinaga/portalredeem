@include('partials/header_')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            
            @yield('content')
            
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@include('partials/footer_')
@stack('footer_scripts')