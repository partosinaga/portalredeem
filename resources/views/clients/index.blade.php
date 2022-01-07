@extends('layouts/main')
@section('title', 'Client')
@section('contentTitle', 'Client')
@section('content')
@php
    $page = 'clients';
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
                            <h3 class="card-label">Client Management</h3>
                        </div>
                        <div class="card-toolbar">
                            @if (isAllowed($page, 'create'))
                                <a href="{{ route('clients.create') }}" class="btn btn-light-success font-weight-bold mr-2">Add New</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom no-footer table-hover" id="client">
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
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>
                                            <th>Company Name</th>
                                            <th>PIC</th>
                                            <th>Phone Number</th>
                                            <th>Industry</th>
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
        var table = $('#client').DataTable({
            columnDefs: [
                { "orderable": false, "targets": 0 }
            ],
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: "{{ route('client.datatable') }}",
            columns: [
                { data: 'action', name: 'action' },
                { data: 'client_title', name: 'client_title' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'industry_title', name: 'industry_title' }
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
                Swal.fire({
                    title: "Are you sure to delete?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/clients/delete/"+checkedValue[0],
                            method: 'GET',
                            success: function( data, status, xhr ) {
                                table.ajax.reload();
                                console.log(data);
                                console.log(status);
                                if(data == 400)
                                {
                                    toastr.warning('Failed, There is existing campaign with this client');
                                }else{
                                    toastr.success('Success delete this data');
                                }
                            },
                            error: function( data ) {
                                toastr.error('Failed, try again later');
                            }
                        });
                    }
                });

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
            window.location =  'clients/edit/'+checkedValue[0]+'';
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
            window.location =  'clients/detail/'+checkedValue[0]+'';
        }else{
            toastr.error('Please check item to be shown');
        }
    })


        
</script>
@endpush