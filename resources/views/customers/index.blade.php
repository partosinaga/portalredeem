@extends('partials.header_cust')
@section('title', 'Campaign')
@section('contentTitle', 'All Campaign')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

	<!--begin::Entry-->
		<div class="d-flex flex-column-fluid page" style="margin-top:160px;margin-bottom:96px">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Dashboard-->
				<div class="card card-custom">
					<div class="card-header">
					   <h3 class="card-title">Filter</h3>
					</div>
					<!--begin::Form-->
					<form class="form">
						<div class="card-body row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="category">Category</label>
									<select class="form-control form-control-sm" id="category" name="category">
										<option selected value="">All</option>
										@foreach ($category as $item)
											<option value="{{ $item->category_prezent_id }}">{{ $item->category_title }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Tag</label>
									<input type="email" class="form-control form-control" name="tag"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Value</label>
									<input type="email" class="form-control form-control" name="value"/>
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label>&nbsp</label><br>
									<button type="button" class="btn btn-primary mr-2 text-right btn-filter">Filter</button>
								</div>
							</div>
						</div>
					</form>
					<!--end::Form-->
				 </div>
	
				<div class="row voucher-content">
				</div>
	
				<div class="row voucher-pages">
					<div class="col-md-4">
						<a id="voucher-prev" href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" ><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
					</div>
					<div class="col-md-4 text-center">
						<p id="current-page">Page:  </p>
					</div>
					<div class="col-md-4 text-right">
						<a id="voucher-next" href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1" ><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
					</div>
				</div>
				<!--end::Dashboard-->
			</div>
			<!--end::Container-->
		</div>
	<!--end::Entry-->
</div>
<!--end::Content-->				

</div>

@include('customers.tnc_modal');

@include('customers.balance_modal', [$balance = formatRupiah($cust->campaign_recipient_current_balance)]);



{{-- MODAL VOUCHER DETAIL  --}}
<div class="modal fade" id="voucherModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Voucher Detail</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <i aria-hidden="true" class="ki ki-close"></i>
             </button>
          </div>
          <div class="modal-body" id="voucherData">
            <ul class="nav nav-tabs nav-tabs-line" style="justify-content:space-between;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Voucher Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">T&C</a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                    <table class="table table-bordered">
                        <tbody>
                           <tr>
                              <td>Voucher Name:<br/><span id="vcname"></span></td>
                              <td>Voucher Redeemed:<br/><span id="vcredeemed"></span></td>
                           </tr>
                           <tr>
                              <td>Initial Stock:<br/><span id="vcinitialstock"></span></td>
                              <td>Remaining:<br/><span id="vcremaining"></span></td>
                           </tr>
                           <tr>
                              <td>Validity:<br/><span id="vcvalidity"></span></td>
                              <td>Unit Price Amount:<br/><span id="vcunitprice"></span></td>
                           </tr>
                           <tr>
                              <td><br/><span id=""></span></td>
                              <td>Value Point:<br/><span id="vcpoint"></span></td>
                           </tr>
                           <tr>
                              <td><br/><span id=""></span></td>
                              <td>
                                 Tags<br/>
                                 <div id="vctags"></div>
                              </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                    <table class="table table-bordered">
                        <tbody>
                           <tr>
                              <td>
                                 Information:<br/><br/>
                                 <p id="vcinformation"></p>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 Instruction:<br/><br/>
                                 <p id="vcinstruction"></p>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 Outlet Instruction:<br/><br/>
                                 <p id="vcoutletinstruction"></p>
                              </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                    <p id="vctnc"></p>
                </div>
            </div>

          </div>
          <div class="modal-footer">
			<a class="btn-buy" target="_blank">
				<button disabled id="sendBtn" class="btn btn-primary">Buy</button>
			</a>
             <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
       </div>
    </div>
</div>
{{-- END OF VOUCHER DETAIL --}}


@extends('partials.footer_cust')
@push('footer_scripts')
<script>
	$('document').ready(function(){
		getVoucher(page = 1);
		$('#category').select2();
		if (localStorage.getItem('isAgree') != 'yes') {
			$('#tnc-modal').modal({ keyboard: false });
		}
	})

	$('#agree-btn').click(function(){
		let isChecked = $('#agree').is(':checked');
		if(isChecked == true)
		{
			localStorage.setItem('isAgree', 'yes')
			$('#tnc-modal').modal('hide');
			$('#balance-modal').modal();
		} else {
			toastr.error('Please checked Privacy and Policy');
		}
	})

	function getVoucher(page){
		$.ajax({
			url: "{{ route('get.prezent.voucher') }}",
			method: 'POST',
			data: {
				"_token" : "{{ csrf_token() }}",
				"page": page
			},
			success: function( data, status, xhr ) {
				generatePaging(data.nav, page)
				generatePage(data);
			},
			error: function( data ) {
				toastr.error('Failed, try again later');
			}
		});
	}

	function generatePage(data)
	{
		var content = '';
		$('.voucher-content').html("");
		let voucher = data.vouchers;
		let image = '';
		let url = '';
		let id = '';
		let title  = '';
		let imageUrl = '';
		let amount = '';
		if (voucher.length <= 0) {
			content += '<div class="col-lg-12 text-center">'+
							'<h3 class="text-danger font-weight-bold font-size-h6 mt-2"> No Records found </h3>'+
						'</div>'
			$('.voucher-content').html(content);
			return true;
		}
		$.each( voucher, function( key, value ) {
			image = "{{ env('PRZ_API_END') }}"+"/storage/voucher/original/"+value.voucher_catalog_main_image_url;
			id = value.voucher_catalog_id,
			title = value.voucher_catalog_title,
			imageUrl = value.voucher_catalog_main_image_url,
			amount = value.voucher_catalog_value_amount
			content += '<div class="col-lg-3 ">'+
							'<div class="card card-custom voucher-card medium-margin voucher-wrapper">'+
								'<div class="voucher-image">'+
									'<img src="'+image+'" class="card-img-top card-image" alt="voucher image" >'+
									'<span class="voucher-detail" voucher-id="'+value.voucher_catalog_id+'" >View Detail</span>'+
								'</div>'+
								'<div class="card-body">'+
									'<div class="row">'+
										'<div class="col-lg-12 small-padding font-weight-bolder">'+
											'<a href="javascript:;" class="voucher-title text-blue" ids="'+id+'" titles="'+title+'" images="'+imageUrl+'" amounts="'+amount+'" onclick="addToCart(this)" > ' +value.voucher_catalog_title +' </a>'+
										'</div>'+
										'<div class="col-lg-12 small-padding text-center">'+
											'<span class="text-blue font-weight-bolder voucher-price"> '+ formatter.format(value.voucher_catalog_value_amount) +' </span>'+
										'</div>'+
									'</div>'+
									'<div class="row">'+
										'<div class="col-lg-4 text-center small-padding">'+
											'<span class="text-blue font-weight-bolder voucher-stock">'+ value.voucher_catalog_stock_level +'</span>'+
											'<br>Remaining'+
										'</div>'+
										'<div class="col-lg-4 text-center small-padding">'+
											'<span class="text-blue font-weight-bolder voucher-redeemed">'+ value.voucher_catalog_redeemed +'</span>'+
											'<br>Redeemed'+
										'</div>'+
										'<div class="col-lg-4 text-center small-padding">'+
											'<span class="text-blue font-weight-bolder voucher-tag">'+ value.voucher_catalog_tags +'</span>'+
											'<br>Tags'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>';
		});
		$('.voucher-content').html(content);
	}

	function generatePaging(nav, page)
	{
		let next = $('#voucher-next');
		let prev = $('#voucher-prev');
		let current = $('#current-page');


		next.removeAttr('url');
		prev.removeAttr('url');

		if (nav.next != "") {
			next.attr('url', nav.next);
		}
		if (nav.previous != "") {
			prev.attr('url', nav.previous);
		}
		current.html("Page: "+page+ " of "+nav.totalPage);
	}

	$('#voucher-next').click(function(){
		let pageTo = $(this).attr("url");
		if( typeof(pageTo) === "undefined")
		{
			toastr.warning('Nothing to show');
			return true;
		}
		getVoucher(pageTo);
		
	})

	$('#voucher-prev').click(function(){
		let pageTo = $(this).attr("url");
		if(typeof(pageTo) === "undefined")
		{
			toastr.warning('Nothing to show');
			return true;
		}
		getVoucher(pageTo);
	})

	$(document).on('click', '.voucher-detail', function(){
		let ids = $(this).attr('voucher-id');
		$.ajax({
			url: "{{ route('get.prezent.voucher.detail') }}",
			method: "get",
			data: {
				_token: "{{ csrf_token() }}",
				id: ids
			},
			success:function(data){
				$('#voucherModal').modal('show');
				$('#vcname').html(data.data.voucher_catalog_title);
				$('#vcinformation').html(data.data.voucher_catalog_information);
				$('#vcinstruction').html(data.data.voucher_catalog_instruction_customer);
				$('#vcioutletinstruction').html(data.data.voucher_catalog_information);
				$('#vctags').html(data.data.voucher_catalog_tags);
				$('#vcunitprice').html(formatter.format(data.data.voucher_catalog_unit_price_amount));
				$('#vcpoint').html(data.data.voucher_catalog_value_point);
				$('#vcremaining').html(data.data.voucher_catalog_stock_level);
				$('#vctnc').html(data.data.voucher_catalog_terms_and_condition);
				$('#vcvalidity').html(convertDate(data.data.voucher_catalog_valid_start_date) + " - " + convertDate(data.data.voucher_catalog_valid_end_date))
				$("#sendBtn").removeAttr('disabled');

				let url = "{{route('voucher.send')}}"+"?voucher_id="+data.data.voucher_catalog_id;
				$('.btn-buy').attr('href', url);
			},
			error:function()
			{
				toastr.error('Failed, try again later');
			}
		})
	});



	// filter
	$('.btn-filter').click(function(){
		var tag = $('input[name="tag"]').val();
		var vals = $('input[name="value"]').val();
		var cat = $('select[name="category"] option').filter(':selected').val();

		getFilteredVoucher(tag, vals, cat);
	})

	function getFilteredVoucher(tag, vals, cat)
	{
		$.ajax({
			url: "/prezent/voucher/filter",
			method: 'POST',
			data: {
				"_token" : "{{ csrf_token() }}",
				"tag": tag,
				"value": vals,
				"category": cat,
			},
			success: function( data, status, xhr ) {
				generatePaging(data.nav, page)
				generatePage(data);
			},
			error: function( data ) {
				toastr.error('Failed, try again later');
			}
		});
	}
	// end of filter

	var formatter = new Intl.NumberFormat('id-ID', {
		style: 'currency',
		currency: 'IDR',
	});
	function convertDate(tgl) {
		var newdate = new Date(tgl);
		return newdate.toLocaleDateString("id-ID");
	}

	function addToCart(datas)
	{
		let id = datas.getAttribute('ids');
		let title = datas.getAttribute('titles');
		let imageUrl = datas.getAttribute('images');
		let amount = datas.getAttribute('amounts');

		$.ajax({
			url: "{{ route('add.to.cart') }}",
			method: 'post',
			data: {
				"_token": "{{ csrf_token() }}",
				"id" : id,
				"title" : title,
				"imageUrl" : imageUrl,
				"amount" : amount
			},
			success:function(data)
			{
				Swal.fire("Berhasil", "Voucher ditambahkan ke Keranjang anda", "success");
			},
			error:function(){
				toastr.error('Failed add to cart, try again later');
			}
		})

	}
</script>
@endpush