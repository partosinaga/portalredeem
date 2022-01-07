@extends('layouts/main')
@section('title', 'Campaign')
@section('contentTitle', 'Detail Campaign')
@section('content')

    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background:#034f9b;">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <!--begin::Logo-->
                            <a href="#" class="mb-5">
                                <img src="{{ asset('assets/images/clients/'.$campaign->client_image_logo) }}" alt="client_logo" width="90px" />
                            </a>
                            <!--end::Logo-->
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <h2 class="text-white font-weight-boldest mb-10">{{ $campaign->campaign_title }}</h2>
                                <span class="text-white d-flex flex-column align-items-md-end opacity-70">
                                    <span>{{ $campaign->client_title }}</span>
                                    <span>{{ $campaign->client_legal_title}}</span>
                                    <span class="label label-square  label-inline mr-2">{{ $campaign->campaign_status }}</span>
                                    @if ($reason != '')
                                        <p>{{ @$reason->campaign_reject_reason .' - '. formatDateTime(@$reason->created_at)}}</p>
                                    @endif
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
                                <span class="opacity-70">{{ $recipientTotal }} Persons</span>
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
                        <table class="table table-separate table-head-custom no-footer" id="campaign-recipient">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Credential</th>
                                    <th>Starting Reward</th>
                                    <th>Remaining Reward</th>
                                    <th>Actual Usage Reward</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end: Invoice body-->
                <!-- end: Invoice-->
            </div>
        </div>

    </div>
    <!--end::Container-->


@endsection
@push('footer_scripts')
<script>
    $(document).ready(function(){

        $('#campaign-recipient').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: {
                url: "{{ route('campaign.recipient.datatable') }}",
                data: function(d){
                    d.campaignId = {{ $campaign->campaign_id }}
                }
            },
            columns: [
                { data: 'campaign_recipient_name', name: 'campaign_recipient_name' },
                { data: 'campaign_recipient_credential', name: 'campaign_recipient_credential' },
                { data: 'starting_reward', name: 'starting_reward' },
                { data: 'remaining_reward', name: 'remaining_reward' },
                { data: 'actual_usage', name: 'actual_usage' },
            ],
            error : function (xhr, error, thrown) {
                alert( 'You are not logged in' );
            },
        });

    })
</script>
@endpush