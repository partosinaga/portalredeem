@extends('layouts/main')
@php
    $npwp = '';
    $headerTitle = @$client ? 'Edit Client' : 'Create New Client';
    $npwp = explode('-', @$client->client_tax_no);
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
                                    <div class="wizard-step" data-wizard-state="current">
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
                            <h3 class="card-label">Billing Information <br> <small class="text-muted">Set up new client, all field must be filled out.</small></h3>
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
                                    $route = @$client ? route('clients.billing.update', $clientId) : route('clients.billing.store', $clientId);
                                @endphp
                                <form class="form" id="kt_form" method="POST" action="{{ $route }}">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                                        <div class="form-group">
                                            <label>Tax Registration Number (NPWP)</label>
                                            <div class="row">
                                                <div class="col xl 3">
                                                    <input type="number" class="form-control" name="npwp[]" value="{{ @$npwp[0] }}" />
                                                </div>
                                                <div class="col xl 2">
                                                    <input type="number" class="form-control" name="npwp[]" value="{{ @$npwp[1] }}" />
                                                </div>
                                                <div class="col xl 2">
                                                    <input type="number" class="form-control" name="npwp[]" value="{{ @$npwp[2] }}" />
                                                </div>
                                                <div class="col xl 1">
                                                    <input type="number" class="form-control" name="npwp[]" value="{{ @$npwp[3] }}" />
                                                </div>
                                                <div class="col xl 2">
                                                    <input type="number" class="form-control" name="npwp[]" value="{{ @$npwp[4] }}" />
                                                </div>
                                                <div class="col xl 2">
                                                    <input type="number" class="form-control" name="npwp[]" value="{{ @$npwp[5] }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Billing Address 1</label>
                                            <input type="text" class="form-control" name="address_1" value="{{ @$client->client_billing_address_line_1 }}" />
                                        </div>

                                        <div class="form-group">
                                            <label>Billing Address 2</label>
                                            <input type="text" class="form-control" name="address_2" value="{{ @$client->client_billing_address_line_2 }}"/>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="exampleSelect1">Province</label>
                                                    <select class="form-control" id="province" name="province">
                                                        <option selected disabled>select</option>
                                                        @foreach ($province as $item)
                                                            @php
                                                                $selected = '';
                                                                if($item->region_id == @$client->client_province)
                                                                {
                                                                    $selected = 'selected';
                                                                }
                                                            @endphp
                                                            <option value="{{ $item->region_id }}" {{ $selected }}>{{ $item->region_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="exampleSelect1">City</label>
                                                    <select class="form-control" id="city" name="city">
                                                        <option selected disabled>select</option>
                                                        @foreach ($region as $item)
                                                                @php
                                                                $selected = '';
                                                                if($item->region_id == @$client->client_city)
                                                                {
                                                                    $selected = 'selected';
                                                                }
                                                            @endphp
                                                            <option value="{{ $item->region_id }}" {{ $selected }}>{{ $item->region_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="exampleSelect1">Area</label>
                                                    <select class="form-control" id="area" name="area">
                                                        <option selected disabled>select</option>
                                                        @foreach ($region as $item)
                                                            @php
                                                                $selected = '';
                                                                if($item->region_id == @$client->client_area)
                                                                {
                                                                    $selected = 'selected';
                                                                }
                                                            @endphp
                                                            <option value="{{ $item->region_id }}" {{ $selected }}>{{ $item->region_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Zip Code</label>
                                                    <input type="number" class="form-control" name="zip_code" value="{{ @$client->client_postal_code }}" />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" value="{{ @$client->client_bank_title }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input type="text" class="form-control" name="branch" value="{{ @$client->client_bank_branch }}" />
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                    <input type="number" class="form-control" name="account_number" value="{{ @$client->client_bank_account_number }}" />
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label>Account Name</label>
                                                    <input type="text" class="form-control" name="account_name" value="{{ @$client->client_bank_account_name }}" />
                                                </div>
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
        $('#province').select2();
        $('#city').select2();
        $('#area').select2();
    })

    $('#province').change(function(){
        let id = $('#province').val();
        $.ajax({
            url: "{{ route('get.city') }}",
            data: {
                _token: "{{ csrf_token() }}",
                parentId: id
            },
            method: "POST",
            success:function(data)
            {
                $('#city').find('option').remove();
                $.each(data, function(key, value){
                    $('#city').append('<option value="'+value.region_id+'">'+value.region_title+'</option>');
                })
            },
            error:function()
            {
                toastr.error('Failed to get city list, try again later');
            }
        })
    })

    $('#city').change(function(){
        let id = $('#city').val();
        $.ajax({
            url: "{{ route('get.area') }}",
            data: {
                _token: "{{ csrf_token() }}",
                parentId: id
            },
            method: "POST",
            success:function(data)
            {
                $('#area').find('option').remove();
                $.each(data, function(key, value){
                    $('#area').append('<option value="'+value.region_id+'">'+value.region_title+'</option>');
                })
            },
            error:function()
            {
                toastr.error('Failed to get city list, try again later');
            }
        })
    })
</script>
@endpush