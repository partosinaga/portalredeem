@extends('layouts/main')
@section('title', 'Campaign Report')
@section('contentTitle', 'Campaign Report')
@section('content')
    <!--begin::Container-->
    <div class="container">

        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Campaign Report</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('campaign.create') }}" class="btn btn-light-success font-weight-bold mr-2">Export</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Voucher Title</label>
                                            <select class="form-control" id="select-voucher" name="voucher_title">
                                                <option selected disabled>select</option>
                                                <option value="ALL">ALL</option>
                                                @foreach ($voucher as $item)
                                                    <option value="{{ $item->campaign_voucher_id }}"> {{ $item->voucher_catalog_title }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Voucher Status</label>
                                            <select class="form-control" id="select-voucher-status" name="voucher_status">
                                                <option selected disabled>select</option>
                                                <option value="ALL">ALL</option>
                                                <option value="ACTIVE">ACTIVE</option>
                                                <option value="REDEEMED">REDEEMED</option>
                                                <option value="EXPIRED">EXPIRED</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom no-footer table-hover" id="report-details">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Credential</th>
                                            <th>Voucher Title</th>
                                            <th>Price</th>
                                            <th>Distribution</th>
                                            <th>Distribution Status</th>
                                            <th>Voucher Recipient</th>
                                            <th>Status</th>
                                            <th>Outlet</th>
                                            <th>Redeem Time</th>
                                            <th>Generted Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        
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
    $(document).ready(function(){
        $('#select-voucher').select2();
        $('#select-voucher-status').select2();

        var table = $('#report-details').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: {
                url: "{{ route('reports.detail.datatable', $campaignId) }}",
                data: function(d)
                {
                    d.voucherStatus = $('select[name=voucher_status]').val();
                    d.voucher = $('select[name=voucher_title]').val();
                }
            },
            columns: [
                { data: 'campaign_recipient_name', name: 'campaign_recipient_name' },
                { data: 'campaign_recipient_credential', name: 'campaign_recipient_credential' },
                { data: 'voucher_title', name: 'voucher_title'},
                { data: 'voucher_price', name: 'voucher_price', className: "text-right" },
                { data: 'distribution_by', name: 'distribution_by' },
                { data: 'distribution_status', name: 'distribution_status' },
                { data: 'distribution_to', name: 'distribution_to' },
                { data: 'voucher_status', name: 'voucher_status' },
                { data: 'outlet_title', name: 'outlet_title' },
                { data: 'redeem_date', name: 'redeem_date ' },
                { data: 'generated_date', name: 'generated_date ' },
            ],
            error : function (xhr, error, thrown) {
                alert( 'You are not logged in' );
            },
        });

        $("select[name='voucher_status']").on( 'change', function (e) {
            table.draw();
            e.preventDefault();
        });

        $("select[name='voucher_title']").on( 'change', function (e) {
            table.draw();
            e.preventDefault();
        });


    })

</script>
@endpush