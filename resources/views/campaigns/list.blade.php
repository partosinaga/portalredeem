@extends('layouts/main')
@section('title', 'Campaign')
@section('contentTitle', 'All Campaign')
@section('content')
@php
    $page = 'campaign';
@endphp
    <!--begin::Container-->
    <div class="container">
        @if ($message = Session::get('message'))
            <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
                <div class="alert-text">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Campaign List</h3>
                        </div>
                        <div class="card-toolbar">
                            @if (isAllowed($page, 'create'))
                                <a href="{{ route('campaign.create') }}" class="btn btn-light-success font-weight-bold mr-2">Add New</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom no-footer" id="campaign">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ki ki-bold-more-ver"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-sm" style="">
                                                        <a class="dropdown-item" href="#" id="detail-checked">Detail</a>
                                                        @if (isAllowed($page, 'update'))
                                                            <a class="dropdown-item" href="#" id="edit-checked">Edit</a>
                                                        @endif

                                                        @if (isAllowed($page, 'delete'))
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" id="delete-checked">Delete</a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif

                                                        @if (isAllowed($page, 'approve'))
                                                            <a class="dropdown-item" href="#" id="approve-checked">Approve</a>
                                                        @endif

                                                        @if (isAllowed($page, 'reject'))
                                                            <a class="dropdown-item" href="#" id="reject-checked">Reject</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>
                                            <th>Campaign Title</th>
                                            <th>Client</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Status</th>
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

    {{-- reject modal --}}
    <div class="modal fade" id="modal-reject" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject Reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" novalidate="novalidate" method="POST" action="{{ route('campaign.reject') }}">
                        @csrf
                      
                       <!--begin::Form group-->
                       <div class="form-group">
                           <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg d-none" type="text" name="campaign_id" id="campaign-id" autocomplete="off" />
                       </div>
                       <div class="form-group">
                            <textarea class="form-control" name="reject_reason" rows="4" placeholder="plese define rejection reason for this campaign"></textarea>                       
                        </div>
                       <!--end::Form group-->
                       <!--begin::Action-->
                       <div class="pb-lg-0 pb-5">
                           <button type="submit" class="btn btn-primary font-weight-bolder  btn-block font-size-h6 px-8 py-4 my-3 mr-3">Reject</button>
                       </div>
                       <!--end::Action-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_scripts')
<script>
    $(document).ready(function(){
        var table = $('#campaign').DataTable({
            columnDefs: [
                { "orderable": false, "targets": 0 }
            ],
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: "{{ route('campaign.datatable') }}",
            columns: [
                { data: 'action', name: 'action' },
                { data: 'campaign_title', name: 'campaign_title' },
                { data: 'client_title', name: 'client_title' },
                { data: 'period_start', name: 'period_start' },
                { data: 'period_end', name: 'period_end' },
                { data: 'campaign_status', name: 'campaign_status' },
            ],
            error : function (xhr, error, thrown) {
                alert( 'You are not logged in' );
            },
        });



        $("#delete-checked").click(function(e) {
            let checkedValue = [];
            let checked = $('input:checked').val();
            $('input:checked').each(function(){
                checkedValue.push($(this).val());
            })
            let countChecked = checkedValue.length;
            if(countChecked <= 0) {
                toastr.error('Please check item to be deleted');
                return;
            }
            let status = $('#'+checkedValue[0]).attr('status');
            if(status.toLowerCase() == 'draft'){
                Swal.fire({
                    title: "Are you sure to delete?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {

                        $.ajax({
                            url: "/campaign/delete/"+checkedValue[0],
                            method: 'GET',
                            success: function( data, status, xhr ) {
                                table.ajax.reload();
                                toastr.success('Success delete this data');
                            },
                            error: function( data ) {
                                toastr.error('Failed, try again later');
                            }
                        });

                    }
                });

            }else{
                toastr.error('Only DRAFT campaign can be deleted');
            }

            
        });

        $("#approve-checked").click(function(e) {
            let checkedValue = [];
            let checked = $('input:checked').val();
            $('input:checked').each(function(){
                checkedValue.push($(this).val());
            })
            let countChecked = checkedValue.length;
            if(countChecked <= 0) {
                toastr.error('Please check item to be approved');
                return;
            }
            let status = $('#'+checkedValue[0]).attr('status');
            if(status.toLowerCase() == 'waiting verification'){
                Swal.fire({
                    title: "Are you sure to approve?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, approve it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/campaign/approve/"+checkedValue[0],
                            method: 'GET',
                            success: function( data, status, xhr ) {
                                table.ajax.reload();
                                toastr.success('Success approve this campaign');
                            },
                            error: function( data ) {
                                toastr.error('Failed, try again later');
                            }
                        });

                    }
                });

            }else{
                toastr.error('Only WAITING VERIFICATION campaign can be approved');
            }
        });

    })

    $('#edit-checked').click(function(){
        let checkedValue = [];
        let checked = $('input:checked').val();
       
        $('input:checked').each(function(){
            checkedValue.push($(this).val());
        })
        let countChecked = checkedValue.length;
        if(countChecked > 1) {
            toastr.error( 'Only one item can be edited' );
        }else if(countChecked == 1){
            let status = $('#'+checkedValue[0]).attr('status');
            if(status.toLowerCase() == 'draft'){
                window.location =  'campaign/edit/'+checkedValue[0]+'';
            } else {
                toastr.error('Only draft campaign can be edited');
            }
        }else{
            toastr.error('Please check item to be edited');
        }
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
            window.location =  'campaign/detail/'+checkedValue[0]+'';
        }else{
            toastr.error('Please check item to be shown');
        }
    })

   $('#reject-checked').click(function(){
        let checkedValue = [];
        let checked = $('input:checked').val();
       
        $('input:checked').each(function(){
            checkedValue.push($(this).val());
        })
        let countChecked = checkedValue.length;
        if(countChecked > 1) {
            toastr.error( 'Only one item can be reject' );
        }else if(countChecked == 1){
            let status = $('#'+checkedValue[0]).attr('status');
            if(status.toLowerCase() == 'waiting verification'){
                // window.location =  'campaign/reject/'+checkedValue[0]+'';
                $('#campaign-id').val(checkedValue[0]);
                $('#modal-reject').modal('show');
            } else {
                toastr.error('Only WAITING VERIFICATION campaign can be rejected');
            }
        }else{
            toastr.error('Please check item to be reject');
        }
   })
    

        
</script>
@endpush