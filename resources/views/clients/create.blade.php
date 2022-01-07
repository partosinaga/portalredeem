@extends('layouts/main')
@php
    $headerTitle = @$clientId ? 'Edit Client' : 'Create New Client';
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
                                    <div class="wizard-step" data-wizard-state="current">
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
                                    <div class="wizard-step">
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
                            <h3 class="card-label">Company Information <br> <small class="text-muted">Set up new client, all field must be filled out.</small></h3>
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
                                    $route = @$client ? route('clients.info.update', $clientId) : route('clients.info.store');
                                @endphp
                                <form class="form" id="kt_form" method="POST" action="{{ $route }}" enctype="multipart/form-data">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" name="company_name" value="{{ @$client->client_title }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Company Legal Name</label>
                                            <input type="text" class="form-control" name="company_legal_name" value="{{ @$client->client_legal_title }}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleSelect1">User In Charge</label>
                                            <select class="form-control" id="user_pic" name="user_pic">
                                                <option selected disabled>select</option>
                                                @foreach ($user as $item)
                                                @php
                                                    $selected = '';
                                                    if($item->id == @$client->client_user_in_charge)
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                @endphp
                                                    <option value="{{ $item->id }}" {{ $selected }} >{{ $item->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="exampleSelect1">Industry</label>
                                                    <select class="form-control" id="industry" name="industry">
                                                        <option selected disabled>select</option>
                                                        @foreach ($industry as $item)
                                                        @php
                                                            $selected = '';
                                                            if($item->industry_id == @$client->client_industry)
                                                            {
                                                                $selected = 'selected';
                                                            }
                                                        @endphp
                                                            <option value="{{ $item->industry_id }}" {{ $selected }} >{{ $item->industry_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Company Size</label>
                                                    <div class="radio-inline">
                                                        <label class="radio">
                                                            <input type="radio" name="company_size" value="<10" {{ @$client->client_employee_size == '<10' ? 'checked' : '' }}>
                                                            <span></span>< 10 Employee
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="company_size" value="11-50" {{ @$client->client_employee_size == '11-50' ? 'checked' : '' }}>
                                                            <span></span>11 - 50 Employee
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="company_size" value="51-100" {{ @$client->client_employee_size == '51-100' ? 'checked' : '' }}>
                                                            <span></span>51 - 100 Employee
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="company_size" value=">100" {{ @$client->client_employee_size == '>100' ? 'checked' : '' }}>
                                                            <span></span>> 100 Employee
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $logo = @$client->client_image_logo ? asset("assets/images/clients/$client->client_image_logo") : asset('assets/media/logos/logo-letter-9.png')
                                        @endphp

                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Company Logo</label>
                                            <div class="col-lg-12">
                                                <div class="image-input image-input-outline" id="company_logo">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $logo }})"></div>
                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Logo">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="company_logo" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="company_logo_remove" />
                                                    </label>
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Logo">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg. (min 50 x 50 px)</span>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <!--end: Wizard Step 1-->

                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div>
                                            <button type="submit" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4">Next</button>
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
        $('#user_pic').select2();
        $('#industry').select2();
        new KTImageInput('company_logo');
    })
</script>
@endpush