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
                            <h3 class="card-label">Campaign List</h3>
                        </div>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom no-footer" id="report">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ki ki-bold-more-ver"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-sm" style="">
                                                        <a class="dropdown-item" href="#" id="detail-checked">Detail</a>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>Campaign Title</th>
                                            <th>Client</th>
                                            <th>Generated Voucher</th>
                                            <th>Redeemed</th>
                                            <th>Start</th>
                                            <th>End</th>
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
        var table = $('#report').DataTable({
            columnDefs: [
                { "orderable": false, "targets": 0 }
            ],
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: "{{ route('reports.datatable') }}",
            columns: [
                { data: 'action', name: 'action' },
                { data: 'campaign_title', name: 'campaign_title' },
                { data: 'client_title', name: 'client_title' },
                { data: 'generated', name: 'generated', className: "text-right"},
                { data: 'redeemed', name: 'redeemed', className: "text-right" },
                { data: 'period_start', name: 'period_start' },
                { data: 'period_end', name: 'period_end' },
            ],
            error : function (xhr, error, thrown) {
                alert( 'You are not logged in' );
            },
        });
    })


    $('#detail-checked').click(function(){
        let checkedValue = [];
        let checked = $('input:checked').val();
        $('input:checked').each(function(){
            checkedValue.push($(this).val());
        })
        let countChecked = checkedValue.length;

        if(countChecked > 1) {
            toastr.error( 'Only one item can be shown' );
        }else if(countChecked == 1){
            window.location =  'reports/detail/'+checkedValue[0]+'';
        }else{
            toastr.error('Please check item to be shown');
        }
    })

   
    

        
</script>
@endpush