@extends('partials.header')

<div class="content d-flex flex-column flex-column-fluid" id="voucherLst">
		
		<!-- begin::filtering -->
		<div class="d-flex flex-column-fluid " id="voucherFilter">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<label></label>
						<select class="">
						
						</select>
					</div>
					<div class="col-lg-4">
						
					</div>
					<div class="col-lg-4">
						
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- end::filtering -->
		
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid page" style="margin-top:160px;margin-bottom:96px">
			<!--begin::Container-->
			<div class="container">
				<!--begin::Dashboard-->
					<!--begin::Row-->
					<div class="row">
						@foreach($vouchers as $v)
						<div class="col-lg-3">
							<!--begin::Card-->
							<div class="card card-custom card-stretch">
								<div class="card-header">
									<img src="/assets/media/misc/voucher-dummy.png" class="img-fluid" alt=""/>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12 text-center">
											Voucher Name
										</div>
										<div class="col-lg-6">
											Voucher Price
										</div>
										
										<div class="col-lg-6">
											Voucher Expired
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-4 text-center">
											XXX<br/>
											Remaining
										</div>
										<div class="col-lg-4 text-center">
											XXX<br/>
											Redeemed
										</div>
										
										<div class="col-lg-4 text-center">
											X<br/>
											Tags
										</div>
									</div>
								</div>
							</div>
							<!--end::Card-->
						</div>
						@endforeach
					</div>
					<!--end::Row-->
					<!--end::Dashboard-->
				</div>
				<!--end::Container-->
		</div>
	<!--end::Entry-->
</div>
<!--end::Content-->				

</div>

@extends('partials.footer')