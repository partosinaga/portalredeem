@extends('partials.header_cust')

<div class="container-sm">
	<div class="row">
		
		<div class="card" style="width:512px;margin:120px auto;padding-top:64px;padding-bottom:64px;">
			<form action="{{route('voucher.send.process')}}" method="post">
				@csrf
				<div class="col-md-12">
					<h1>Gift/Send Voucher</h1>
				</div>
				<div class="col-md-12 voucher-img">
					<img class="img-thumbnail" src="https://prezent-redeem.sprintasia.net:8443/assets/images/dummy-voucher.png" alt="Voucher Image"/>
					<h4 class="medium-padding">Voucher Ini Berlaku Sampai</h4>
				</div>
				<div class="col-md-12 voucher-send-opt medium-padding">
					<h6 class="medium-padding">Anda dapat Redeem voucher / gift voucher prezent</h6>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="method" id="sms" value="sms">
					  <label class="form-check-label" for="exampleRadios1">
						SMS
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="method" id="sms" value="email">
					  <label class="form-check-label" for="exampleRadios1">
						EMAIL
					  </label>
					</div>
					<div class="medium-padding d-none triggerInput" id="emailInput">
						<input name="email" class="form-control trigger" disabled required value="" placeholder="enter email address"/>
					</div>					
					<div class="medium-padding d-none triggerInput" id="phoneInput">
						<input name="phone" class="form-control trigger" disabled value="" placeholder="enter phone number"/>
					</div>
				</div>
				<div class="col-md-12 voucher-actions text-center medium-padding">
					<button type="submit" class="btn btn-success btn-lg">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>

@extends('partials.footer_cust')
@push('footer_scripts')
<script>
$(document).ready(function(){
	$('[type="radio"]').change(function(){
		var state = $(this).val();
		console.log(state);
		$('.trigger').attr('disabled');
		$('.trigger').removeAttr('required');
		if(state == 'email') {
			$('.triggerInput').addClass('d-none');
			$('#emailInput').removeClass('d-none');
			$('#emailInput input').removeAttr('disabled');
		}
		else {
			$('.triggerInput').addClass('d-none');
			$('#phoneInput').removeClass('d-none');
			$('#phoneInput input').removeAttr('disabled');
		}
	});
});
</script>
@endpush
