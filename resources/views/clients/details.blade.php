@extends('layouts/main')
@section('title', 'Clients')
@section('contentTitle', 'Client Details')
@section('content')

    <!--begin::Container-->
    <div class="container">
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-7">
                
                <div class="card card-custom card-stretch">
                    <div class="card-body p-15 pb-20">
                        <div class="row mb-17">
                            <div class="col-xxl-5 mb-11 mb-xxl-0">
                                <!--begin::Image-->
                                <div class="card card-custom card-stretch">
                                    <div class="card-body p-0 rounded px-10 py-15 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('assets/images/clients/'.$client->client_image_logo) }}" class="mw-100 w-100px" style="transform: scale(1.6);">
                                    </div>
                                </div>
                                <!--end::Image-->
                            </div>
                            <div class="col-xxl-7 pl-xxl-11">
                                <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">{{ $client->client_title }}</h2>
                                <div class="font-size-h2 mb-7 text-dark-50">{{ $client->client_legal_title }}</div>
                                <div class="line-height-xl">{{ $client->province .' - '. $client->city .' - '.  $client->area }}</div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <!--begin::Info-->
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Tax Number (NPWP)</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_tax_no }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">User in Charge</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->email }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Industry</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">NF3535345</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Employee Size</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_employee_size }} Employee </span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>

                        <div class="row mb-6">
                            <!--begin::Info-->
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Billing Address 1</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_billing_address_line_1 }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Billing Address 2</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_billing_address_line_2 }}</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>

                        <div class="row mb-6">
                            <!--begin::Info-->
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Bank Account</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_bank_title }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Account Name</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_bank_account_name}}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Account Number</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_bank_account_number }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Branch</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_bank_branch }}</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-5">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Configuration</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('clients.index') }}" class="btn btn-light font-weight-bold mr-2">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-6">
                            <!--begin::Info-->
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Allow Create Campaign Without Balance</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_allow_postpaid == "1" ? "Yes, they can" : "No, they can't" }}</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="mb-8 d-flex flex-column">
                                    <span class="text-dark font-weight-bold mb-4">Balance Outstanding Limit</span>
                                    <span class="text-muted font-weight-bolder font-size-lg">{{ $client->client_outstanding_limit }}</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                      <small> Created at: {{ formatDateTime($client->created_at) .', by: '.$client->created_by }} </small>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->


@endsection