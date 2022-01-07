@extends('layouts/main')
@php
    $headerTitle = @$campaignId ? 'Edit Campaign': 'Create New Campaign';
@endphp
@section('title', 'Campaign')
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
                                    <div class="wizard-step">
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


                <div class="card card-custom">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Campaign Profile <br> <small class="text-muted">Set up your new campaign, all field must be filled out.</small></h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('campaign.index') }}" class="btn btn-light font-weight-bold mr-2">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <!--begin: Wizard Body-->
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12">
                                <!--begin: Wizard Form-->
                                @php
                                    $route = @$campaignId ? route('campaign.edit.store', $campaignId) : route('campaign.profile.store');
                                @endphp
                                <form class="form" id="kt_form" method="POST" action="{{ $route }}">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <div class="form-group">
                                            <label>Campaign Title</label>
                                            <input type="text" class="form-control" name="campaign_title" value="{{ @$campaign->campaign_title }}" />
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="exampleSelect1">Client</label>
                                                    <select class="form-control" id="client" name="client_id">
                                                        <option selected disabled>select</option>
                                                        @foreach ($client as $item)
                                                        @php
                                                            $selected = '';
                                                            if ($item->client_id == @$campaign->client_id)
                                                            {
                                                                $selected = 'selected';
                                                            }
                                                        @endphp
                                                            
                                                            <option value="{{ $item->client_id }}" {{ $selected }}>{{ $item->client_title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @php
                                            $startDate = @$campaign ? datetimePickerFormat(@$campaign->campaign_start_date)  : '';
                                            $endDate = @$campaign ? datetimePickerFormat(@$campaign->campaign_end_date) : '';   
                                            @endphp
                                            <div class="col-xl-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Validity Period</label>
                                                            <div class="input-group date" id="validity_start" data-target-input="nearest">
                                                                <input type="text" class="form-control datetimepicker-input" name="campaign_validity_start" data-target="#validity_start" value="{{ $startDate }}" />
                                                                <div class="input-group-append" data-target="#validity_start" data-toggle="datetimepicker">
                                                                    <span class="input-group-text">
                                                                        <i class="ki ki-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <div class="input-group date" id="validity_end" data-target-input="nearest">
                                                                <input type="text" class="form-control datetimepicker-input" name="campaign_validity_end" data-target="#validity_end" value="{{ $endDate  }}" />
                                                                <div class="input-group-append" data-target="#validity_end" data-toggle="datetimepicker">
                                                                    <span class="input-group-text">
                                                                        <i class="ki ki-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="form-group mb-1">
                                                    <label for="recipient-list">Recipient List <br>
                                                    <span class="text-muted">format: name#credential#balance. simply add another recipient in a new line</span></label>
                                                    <textarea class="form-control" name="recipient_list" id="recipient-list" rows="20" placeholder="john#08531230000#100000">{{ @$strRecipient }}</textarea>
                                                    <p class="upload-info"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label></label>
                                                    <div></div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="upload-file">
                                                        <label class="custom-file-label" for="upload-file">Upload CSV File</label>
                                                    </div>
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
        $('#validity_start').datetimepicker();
        $('#validity_end').datetimepicker();
        $('#client').select2();
    })

    $('#upload-file').change(function(){
        event.preventDefault();

        getFile(event,true);

    })
    function getFile(event,id=true) {
        const input = event.target
        if ('files' in input && input.files.length > 0) {
             placeFileContent(document.getElementById('recipient-list'),input.files[0])
        }
    }
    
    function placeFileContent(target, file) {
        readFileContent(file).then(content => {
            var myStr = content;
            var splited = myStr.split('\n');
            splited.shift();

            let contentLength = splited.length;
            if(contentLength > 200) {
                alert('Only 200 record are allowed');
                return;
            }

            var joinedArray = splited.join('\n');
            var changeDelimiter = joinedArray.replace(/;/g, '#').replace(/##/g, '');
            target.value = changeDelimiter
            $('.upload-info').html(contentLength-1 + ' detected');
        }).catch(error => console.log(error))
    }


    function readFileContent(file) {
        const reader = new FileReader()
        return new Promise((resolve, reject) => {
            reader.onload = event => resolve(event.target.result)
            reader.onerror = error => reject(error)
            reader.readAsText(file)
        })
    }

    
</script>
@endpush