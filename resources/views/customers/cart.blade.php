@extends('partials.header_cust')
@section('title', 'Keranjang')
@section('contentTitle', 'Keranjang')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

	<!--begin::Entry-->
		<div class="d-flex flex-column-fluid page" style="margin-top:160px;margin-bottom:96px">
			<!--begin::Container-->
			<div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Keranjang</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($cart as $item)
                                    <div class="d-flex align-items-center justify-content-between p-8">
                                        <div class="d-flex flex-column mr-2">
                                            <a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">{{ $item->voucher_catalog_title }}</a>
                                            <span class="text-muted">Berlaku sampai {{ formatDateTime($item->valid_end_date) }}</span>
                                            <div class="d-flex align-items-center mt-2">
                                                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">{{ formatRupiah($item->voucher_catalog_value_amount) }}</span>
                                                <span class="text-muted mr-1">for</span>
                                                <button class="btn btn-xs btn-light-success btn-icon mr-2 btn-minus" id="{{ $item->cart_id }}">
                                                    <i class="ki ki-minus icon-nm"></i>
                                                </button>

                                                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">
                                                    <input type="text" class="form-control form-sm current-qty" name="item-qty[]" id="qty_{{ $item->cart_id }}" prices="{{ (int)$item->voucher_catalog_value_amount }}" value="{{ $item->qty }}" readonly />
                                                </span>

                                                <button class="btn btn-xs btn-light-success btn-icon btn-plus" id="{{ $item->cart_id }}">
                                                    <i class="ki ki-plus icon-nm"></i>
                                                </button> 
                                                
                                                <div class=""> &nbsp|&nbsp </div>
                                                <button class="btn btn-xs btn-light-danger btn-icon btn-trash" id="{{ $item->cart_id }}">
                                                    <i class="flaticon2-trash icon-nm"></i> 
                                                </button>
                                            </div>
                                        </div>
                                        <a href="#" class="symbol symbol-70 flex-shrink-0">
                                            <img src="{{ env('PRZ_API_END').'/storage/voucher/original/'.$item->voucher_catalog_main_image_url }}" title="voucher image" alt="voucher image">
                                        </a>
                                    </div>
                                    <div class="separator separator-solid"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-custom">
                            <div class="card-header">
                               <h3 class="card-title">Ringkasan Voucher</h3>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td>Total Voucher</td>
                                            <td id="grand-qty"></td>
                                        </tr>
                                        <tr class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                                            <td>Total Harga</td>
                                            <td id="grand-amount"></td>
                                        </tr>
                                    </table>
                                    <div class="col-md-12">
                                        <h6 class="medium-padding">Redeem voucher / gift voucher prezent</h6>
                                        <div class="form-group">
                                            <div class="radio-list">
                                                <label class="radio">
                                                    <input type="radio" name="method" id="sms" value="sms">
                                                    <span></span>SMS
                                                </label>

                                                <label class="radio">
                                                    <input type="radio" name="method" id="email" value="email">
                                                    <span></span>E-MAIL
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="medium-padding d-none triggerInput" id="emailInput">
                                                <input name="email" class="form-control trigger" disabled required value="" placeholder="Enter email address"/>
                                            </div>					
                                            <div class="medium-padding d-none triggerInput" id="phoneInput">
                                                <input name="phone" type="number" class="form-control trigger" disabled value="" placeholder="Enter phone number"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 voucher-actions text-center medium-padding">
                                        <button type="submit" class="btn btn-success btn-lg btn-block btn-send">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<!--end::Container-->
		</div>
	<!--end::Entry-->
</div>
<!--end::Content-->				


@extends('partials.footer_cust')
@push('footer_scripts')
<script>
    $('doocument').ready(function(){
        $('[type="radio"]').change(function(){
            var state = $(this).val();
            $('.trigger').attr('disabled');
            $('.trigger').removeAttr('required');
            if(state == 'email') {
                $('.triggerInput').addClass('d-none');
                $('#emailInput').removeClass('d-none');
                $('#emailInput input').removeAttr('disabled');
            } else {
                $('.triggerInput').addClass('d-none');
                $('#phoneInput').removeClass('d-none');
                $('#phoneInput input').removeAttr('disabled');
            }
	});
        calculateGrandTotal();
    })
	$('.btn-trash').click(function(){
        let id = $(this).attr('id');
        Swal.fire({
            title: "Are you sure to delete?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "/customer/cart/delete/"+id,
                    method: 'GET',
                    success: function( data, status, xhr ) {
                        location.reload();
                    },
                    error: function( data ) {
                        toastr.error('Failed, try again later');
                    }
                });
            }
        });
    })
    
    $('.btn-plus').click(function(){
        let id = $(this).attr('id');
        let current = $('#qty_'+id).val();
        $('#qty_'+id).val( parseInt(current) + 1);
        calculateGrandTotal();
    })

    $('.btn-minus').click(function(){
        let id = $(this).attr('id');
        let current = $('#qty_'+id).val();
        if( parseInt(current) <= 1)
        {
            toastr.warning('Reach minimum quantity');
            return true;
        }
        $('#qty_'+id).val( parseInt(current) - 1);        
        calculateGrandTotal();
    })

    function calculateGrandTotal()
    {
        let inputQty = $('.current-qty');
        let inputPrice = $('.voucher-price-amount');

        let qty = 0;
        let price = 0;
        let subtotal = 0;
        let grandTotal = 0;
        let grandQty = 0;
        for(var i = 0; i < inputQty.length; i++){
            qty = parseInt($(inputQty[i]).val());
            price = parseFloat($(inputQty[i]).attr('prices'));
            subtotal = qty * price;
            
            grandQty = grandQty+qty;
            grandTotal = grandTotal+subtotal;
        }
        $('#grand-qty').html(grandQty+' Pcs');
        $('#grand-amount').html(formatter.format(grandTotal));

    }
    
    var formatter = new Intl.NumberFormat('id-ID', {
		style: 'currency',
		currency: 'IDR',
	});

    $('.btn-send').click(function(){
        let CURRENT_BALANCE = {{ $cust->campaign_recipient_current_balance }};
        
    })
</script>
@endpush