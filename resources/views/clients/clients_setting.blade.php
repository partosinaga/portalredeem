@extends('layouts/main')
@php
    $headerTitle = @$client ? 'Edit Client' : 'Create New Client';
@endphp
@section('title', 'Client')
@section('contentTitle', $headerTitle)
@section('content')

    <!--begin::Container-->
    <div class="container">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-12">

                <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
                    <div class="alert-text">
                        <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                            <!--begin: Wizard Nav-->
                            <div class="wizard-nav">
                                <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                                    <!--begin::Wizard Step 1 Nav-->
                                    <div class="wizard-step">
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                            <span>1.</span>Company Information</h3>
                                            <div class="wizard-bar"></div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 1 Nav-->
                                    <!--begin::Wizard Step 2 Nav-->
                                    <div class="wizard-step">
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                            <span>2.</span>Billing Information</h3>
                                            <div class="wizard-bar"></div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 2 Nav-->
                                    <!--begin::Wizard Step 3 Nav-->
                                    <div class="wizard-step"  data-wizard-state="current">
                                        <div class="wizard-label">
                                            <h3 class="wizard-title">
                                            <span>3.</span>Client Settings</h3>
                                            <div class="wizard-bar"></div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 23Nav-->
                                </div>
                            </div>
                            <!--end: Wizard Nav-->
                            
                        </div>
                    </div>
                </div>


                <div class="card card-custom">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Client Settings <br> <small class="text-muted">Control the setting for the brand new client, This will affect how they create campaign etc.</small></h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('clients.index') }}" class="btn btn-light font-weight-bold mr-2">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!--begin: Wizard Body-->
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12">
                                <!--begin: Wizard Form-->
                                @php
                                    $route = @$client ? route('clients.setting.update', $clientId) : route('clients.setting.store', $clientId);
                                @endphp
                                <form class="form" id="kt_form" method="POST" action="{{ $route }}">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                                        <div class="form-group">
                                            <label>Allow client to create campaign without balance?</label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" name="is_allow_postpaid" value="0" {{ @$client->client_allow_postpaid == '0' ? 'checked' : '' }} >
                                                    <span></span>No, they cannot
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="is_allow_postpaid" value="1" {{ @$client->client_allow_postpaid == '1' ? 'checked' : '' }} >
                                                    <span></span>Yes, they can
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Outstanding Limit</label>
                                            <input type="number" class="form-control" name="outstanding_limit" value="{{ @$client->client_outstanding_limit }}" />
                                        </div>

                                    </div>
                                    <!--end: Wizard Step 1-->

                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div>
                                            <button type="submit" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4">Save</button>
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                </form>
                                <!--end: Wizard Form-->
                            </div>
                        </div>
                        <!--end: Wizard Body-->
                    </div>
                </div>


            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->


@endsection
@push('footer_scripts')
<script>
    $(document).ready( function () {
        $('#province').select2();
        $('#city').select2();
        $('#area').select2();
    })
</script>
@endpush