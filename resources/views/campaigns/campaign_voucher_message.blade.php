@extends('layouts/main')
@php
    $headerTitle = @$campaign ? 'Edit Campaign': 'Create New Campaign';
@endphp
@section('title', 'Campaign')
@section('contentTitle',  $headerTitle)
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
                                            <span>1.</span>Campaign Profile</h3>
                                            <div class="wizard-bar"></div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 1 Nav-->
                                    <!--begin::Wizard Step 2 Nav-->
                                    <div class="wizard-step" data-wizard-state="current">
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

                <div class="row">
                    <div class="col-xl-7">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap py-3">
                                <div class="card-title">
                                    <h3 class="card-label">Voucher Message <br> <small class="text-muted">Create your voucher message, this message will be shown yo the recipients.</small></h3>
                                </div>
                                <div class="card-toolbar">
                                    <a href="{{ route('campaign.index') }}" class="btn btn-light font-weight-bold mr-2">Cancel</a>
                                </div>
                            </div>
                            @php
                                $route = @$campaign ? route('campaign.edit.message.voucher.store', $campaignId) : route('campaign.message.voucher.store', $campaignId) ;
                            @endphp
                            <div class="card-body p-0">
                                <!--begin: Wizard Body-->
                                <div class="justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                                    <!--begin: Wizard Form-->
                                    <form class="form" id="kt_form" method="POST" action="{{ $route }}">
                                        @csrf
                                        <!--begin: Wizard Step 1-->
                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                            <div class="form-group">
                                                <label>Message Title</label>
                                                <input type="text" class="form-control campaign-title" name="message_title" value="{{ @$campaign->campaign_message_title }}" />
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleTextarea">Message</label>
                                                <textarea class="form-control campaign-message" name="message"  id="exampleTextarea" rows="3">{{ @$campaign->campaign_message }}</textarea>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Background Color</label>
                                                        <input class="form-control" name="bg_color"  type="color" value="{{ @$campaign ? $campaign->campaign_bg_color : '#034f9b' }}" id="bg-color">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Font Color</label>
                                                        <input class="form-control" name="font_color"  type="color" value="{{ @$campaign ? $campaign->campaign_font_color : '#ffffff' }}" id="font-color">
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
                                <!--end: Wizard Body-->
                                
                            </div>
                        </div>
                    </div>

                    {{-- voucher display --}}
                    <div class="col-xl-5">
                        <div class="card card-custom" id="card-bg-color" style="background: {{ @$campaign ? $campaign->campaign_bg_color : '#034f9b' }} " >
                            <div class="card-header flex-wrap py-3">
                                <div class="text-white">
                                    <h3 class="message-font text-campaign-title" style="color: {{ @$campaign ? $campaign->campaign_font_color : '#ffffff' }}" >Message Title </h3>
                                    <p class="message-font text-campaign-message" style="color: {{ @$campaign ? $campaign->campaign_font_color : '#ffffff' }}">Message</p>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <div class="card" style="margin-left: 30px; margin-right:30px">
                                    <div class="card-header  flex-wrap py-3">
                                       
                                        <div class="">
                                            <h5>Pulsa Telkomsel Rp. 50.000</h5>
                                            <p>Sprint Asia Technology</p>
                                        </div>
                                        
                                    </div>
                                    <div class="card-body text-center" style="padding:0 !important;">
                                        <img style="max-width: 100%; height:auto;" src="https://prezent.id/storage/voucher/original/kybm1wdq0y9v0ukdow0b.png" alt="">
                                     </div>
                                    <div class="card-footer">

                                            <ul class="nav nav-tabs nav-tabs-line" style="justify-content:space-between;">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Informasi</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Ketentuan</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Penukaran</a>
                                                </li>
                                         
                                            </ul>
                                            <div class="tab-content mt-5" id="myTabContent">
                                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">Tab content 1</div>
                                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">Tab content 2</div>
                                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                                    <div class="text-center">

                                                        <img src="http://www.unitag.io/qreator/generate?crs=e2ZRfLkGhCcNX0uPU0VF3l2iWCU5iBS65XqQ37eAYrFw1DqSur4MlY3KDO2BDD2mBo8u49VJSRUN61r7kZGYhdTmk%252F7zrZPNv%252BvdL8%252F3FZQIsRoRa29g6JCo%252BMr1U9KIrE%252Bnsuv3ZYI6Py3tmkIQ8%252BEeCrwb5jj4Irri3GordWt5Lnn5RdF7YPFjY1wajrVuR%252B%252FP9hE8xiNWLqCVKbr%252Bl4lUhL%252FV8dHyx4iB3lMvJA6b%252BR9YbGA4eBLyE4ApKFZytg2Kx6IpTsPPqimIJ3mZFOwRtlBVPh3fqjEmcG687Iw0%252F5378PNxX6sImd7pE23A5T1UiqdyW3LF34GmKxyp1g%253D%253D&amp;crd=mXKe51B3LcpJnGj6pepi6V3RM8sS1f7iyDZdZEpcqQ3B93K71VLjQVUBTpD9A4ML7KVXVgDdRMTiVz24fi6wYw%253D%253D" alt="QR Code">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                
                            </div>
                        </div>
                    </div>
                    {{-- end of voucher display --}}
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


        $('#bg-color').change(function(){
            let thisVal = $(this).val();
            $('#card-bg-color').css({'background' : thisVal});
        });

        $('#font-color').change(function(){
            let thisVal = $(this).val();
            $('.message-font').css({'color' : thisVal});
        });

        $('.campaign-title').keyup(function(){
            let thisVal = $(this).val();
            $('.text-campaign-title').text(thisVal);
        });

        $('.campaign-message').keyup(function(){
            let thisVal = $(this).val();
            console.log(thisVal);
            $('.text-campaign-message').text(thisVal);
        })

    })
</script>
@endpush