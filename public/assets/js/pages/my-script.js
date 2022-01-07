$('document').ready(function(){
    $('.get-item-cart').on('click', function(){
        let content = '';
        let image = '';
        $('.item-cart').html('');
        $.ajax({
            url: APP_URL+'/get-cart-item/'+CUSTOMER_ID,
            method: 'get',
            success:function(data)
            {
                $.each(data, function(key, value){
                    image = PRZ_API_END+"/storage/voucher/original/"+value.voucher_catalog_main_image_url;
                    content += '<div class="d-flex align-items-center justify-content-between p-8">'+
                                '<div class="d-flex flex-column mr-2">'+
                                    '<a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">'+value.voucher_catalog_title+'</a>'+
                                    '<span class="text-muted">Berlaku Sampai '+ convertDate(value.valid_end_date) +'</span>'+
                                    '<div class="d-flex align-items-center mt-2">'+
                                        '<span class="font-weight-bold mr-1 text-dark-75 font-size-lg">'+ value.qty +' Pcs</span>'+
                                    '</div>'+
                                '</div>'+
                                '<a href="#" class="symbol symbol-70 flex-shrink-0">'+
                                    '<img src="'+image+'" title="" alt="">'+
                                '</a>'+
                            '</div>'+
                            '<div class="separator separator-solid"></div>'
                })
                if(data == '')
                {
                    content += '<div class="d-flex align-items-center justify-content-between p-8">'+
                            '<div class="d-flex flex-column mr-2">'+
                                '<p href="#" class="font-weight-bold text-dark-75 font-size-lg">Empty!</p>'+
                                '<span class="text-muted">Your cart is empty, go pick a voucher</span>'+
                            '</div>'+
                        '</div>';
                }
                $('.item-cart').html(content);
            },
            error:function()
            {
                toastr.error('Failed to load Cart, try again later');
            }

        })
    })

    var formatter = new Intl.NumberFormat('id-ID', {
		style: 'currency',
		currency: 'IDR',
	});
	function convertDate(tgl) {
		var newdate = new Date(tgl);
		return newdate.toLocaleDateString("id-ID");
	}


})