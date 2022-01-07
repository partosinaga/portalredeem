@extends('layouts/main')
@section('title', 'Balance')
@section('contentTitle', 'Campaign Balance History')
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
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xl-12">
							<!--begin: Datatable-->
							<table class="table table-separate table-head-custom no-footer table-hover" id="campaign-balance-history">
								<thead>
									<tr>
										<th>Date</th>
										<th>Campaign Title</th>
										<th>Amount</th>
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
    $(document).ready( function () {
		var table = $('#campaign-balance-history').DataTable({
            columnDefs: [
                { "orderable": false, "targets": 0 }
            ],
            processing: true,
            serverSide: true,
            pageLength: 20,
            ajax: "{{ route('campaign.balance.history.datatable') }}",
            columns: [
                { data: 'created_at', name: 'created_at' },
                { data: 'campaign_title', name: 'campaign_title' },
                { data: 'amount', name: 'amount' },
            ],
            error : function (xhr, error, thrown) {
                alert( 'You are not logged in' );
            },
        });

	});
</script>
@endpush;