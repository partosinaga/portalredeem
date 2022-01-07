@extends('layouts/main')
@section('title', 'Campaign')
@section('contentTitle', 'Create New Campaign')
@section('content')

    <!--begin::Container-->
    <div class="container">
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
                                    <span>1.</span>Campaign Profile</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 1 Nav-->
                            <!--begin::Wizard Step 2 Nav-->
                            <div class="wizard-step">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                    <span>2.</span>Voucher Message</h3>
                                    <div class="wizard-bar"></div>
                                </div>
                            </div>
                            <!--end::Wizard Step 2 Nav-->
                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step" data-wizard-state="current">
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                    <span>3.</span>Checkout</h3>
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

        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background:#034f9b;">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <!--begin::Logo-->
                            <a href="#" class="mb-5">
                                <img src="{{ asset('assets/images/clients/'.$client->client_image_logo) }}" alt="client_logo" width="90px" />
                            </a>
                            <!--end::Logo-->
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <h2 class="text-white font-weight-boldest mb-10">{{ $campaign->campaign_title }}</h2>
                                <span class="text-white d-flex flex-column align-items-md-end opacity-70">
                                    <span>{{ $client->client_legal_title }} - {{ $client->client_title }}</span>
                                    <span>Created by: {{ $campaign->created_by }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100 opacity-20"></div>
                        <div class="d-flex justify-content-between text-white pt-6">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolde mb-2r">VALIDITY PERIOD</span>
                                <span class="opacity-70">{{ formatDateTime($campaign->campaign_start_date) . ' - '. formatDateTime($campaign->campaign_end_date) }}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">TOTAL RECIPIENT</span>
                                <span class="opacity-70">{{ count($recipient) }} Persons</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">VOUCHER MESSAGE</span>
                                <span class="opacity-70">Message Title: {{ $campaign->campaign_message_title }}</span>
                                <span class="opacity-70">Message: {{ $campaign->campaign_message }}</span>
                                <span><p class="text-white py-2 px-4" style="background: {{ $campaign->campaign_bg_color }}">Background Color: {{ $campaign->campaign_bg_color }}</p></span>
                                <span><p class="text-dark py-2 px-4"  style="background: {{ $campaign->campaign_font_color }}">Font Color: {{ $campaign->campaign_font_color }}</p></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">#</th>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Name</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Credential</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                        $totalAmount = 0;
                                    @endphp
                                    @foreach ($recipient as $row)    
                                    @php
                                        $totalAmount += $row->campaign_recipient_balance; 
                                    @endphp
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $row->campaign_recipient_name }}</td>
                                            <td class="text-right">{{ $row->campaign_recipient_credential }}</td>
                                            <td class="text-danger text-right">{{ formatRupiah($row->campaign_recipient_balance) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg" style="float: right">
                            <div class="d-flex flex-column text-md-right">
                                <span class="font-size-lg font-weight-bolder mb-1">TOTAL AMOUNT</span>
                                <span class="font-size-h2 font-weight-boldest text-danger mb-1">{{ formatRupiah($totalAmount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('campaign.index') }}"><button type="button" class="btn btn-light-primary font-weight-bold">Save & Close</button></a>
                            <a href="{{ route('campaign.checkout.store', $campaign->campaign_id) }}"><button type="button" class="btn btn-success font-weight-bold">Submit</button></a>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>

    </div>
    <!--end::Container-->


@endsection