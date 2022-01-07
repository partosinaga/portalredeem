@extends('layouts/main')
@section('title', 'Balance')
@section('contentTitle', 'Top Up Balance History')
@section('content')
@php
    $page = 'balance';
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
						<h3 class="card-label">Balance List</h3>
					</div>
					<div class="card-toolbar">
						@if (isAllowed($page, 'create'))
							<a href="{{ route('balance.topup') }}" class="btn btn-light-success font-weight-bold mr-2">Add New</a>
						@endif
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xl-12">
							<!--begin: Datatable-->
							<table class="table table-separate table-head-custom no-footer table-hover" id="balance">
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
										<th>Date</th>
										<th>Client</th>
										<th>Amount</th>
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

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deposit Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm">
					<thead>
						<tr>
							<td>Description</td>
							<td>Value</td>
						</tr>
					</thead>
					<tbody class="detail-content">
						<tr>
							<td>Payment Date</td>
							<td id="paydate"></td>
						</tr>
						<tr>
							<td>Document Number</td>
							<td id="docs"></td>
						</tr>
						<tr>
							<td>Receipt Number</td>
							<td id="receipts"></td>
						</tr>
						<tr>
							<td>Amount</td>
							<td id="amounts"></td>
						</tr>
						<tr>
							<td>Status</td>
							<td id="status"></td>
						</tr>
					</tbody>
				</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('footer_scripts')
<script>
    $(document).ready( function () {
		var table = $('#balance').DataTable({
            columnDefs: [
                { "orderable": false, "targets": 0 }
            ],
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: "{{ route('balance.datatable') }}",
            columns: [
                { data: 'action', name: 'action' },
                { data: 'deposit_payment_date', name: 'deposit_payment_date' },
                { data: 'client_title', name: 'client_title' },
                { data: 'deposit_amount', name: 'deposit_amount' },
                { data: 'deposit_status', name: 'deposit_status' },
            ],
            error : function (xhr, error, thrown) {
                alert( 'You are not logged in' );
            },
        });



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
				$.ajax({
					url: "{{ route('balance.detail') }}",
					method: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						id: checkedValue[0]
					},
					success:function(data){
						console.log(data);
						$('#paydate').html(convertDate(data.deposit_payment_date));
						$('#docs').html(data.deposit_document_number);
						$('#receipts').html(data.deposit_receipt_number);
						$('#amounts').html(formatter.format(data.deposit_amount));
						$('#status').html(data.deposit_status);

						$('#detailModal').modal('show');
					},
					error:function()
					{
						console.log('error');
					}
				})
			}else{
				toastr.error('Please check item to be shown');
			}

		});

		var formatter = new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR',
			});
		function convertDate(tgl) {
			var newdate = new Date(tgl);
			return newdate.toLocaleDateString("id-ID");
		}

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
				if(status.toLowerCase() == 'waiting verification'){
					window.location =  'balance/edit/'+checkedValue[0]+'';
				} else {
					toastr.error('Only waiting verification can be edited');
				}
			}else{
				toastr.error('Please check item to be edited');
			}
		})

		$('#delete-checked').click(function(){
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
				if(status.toLowerCase() == 'waiting verification' || status.toLowerCase() == 'rejected'){
					window.location =  'balance/delete/'+checkedValue[0]+'';
				} else {
					toastr.error('Cannot delete this data');
				}
			}else{
				toastr.error('Please check item to be edited');
			}
		})

		$('#approve-checked').click(function(){
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
				if(status.toLowerCase() == 'waiting verification'){
					window.location =  'balance/approve/'+checkedValue[0]+'';
				} else {
					toastr.error('Only waiting verification can be approved');
				}
			}else{
				toastr.error('Please check item to be edited');
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
				toastr.error( 'Only one item can be edited' );
			}else if(countChecked == 1){
				let status = $('#'+checkedValue[0]).attr('status');
				if(status.toLowerCase() == 'waiting verification'){
					window.location =  'balance/reject/'+checkedValue[0]+'';
				} else {
					toastr.error('Only waiting verification can be rejected');
				}
			}else{
				toastr.error('Please check item to be edited');
			}
		})


	});
</script>
@endpush;