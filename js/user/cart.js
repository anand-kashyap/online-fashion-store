$( function() {

	calcTotal();
	function calcTotal() {
		let subPricesArr = $('.sub-product-price').map(function(){
			return parseFloat($.trim($(this).text()));
		}).get();
		let prodprice = 0;
		for (const i of subPricesArr) {
			prodprice+=i;
		}
		$('#sub-total-price').html(prodprice.toFixed(2));
		prodprice+= 10;
		$('#total-price').html(prodprice.toFixed(2));
	}

	$('.calc').on('click', function(e) {
		let inputValEl = '';
		let inputVal = 0;
		if ($(this).text() == '-') { //on decrease
			inputValEl = $(this).parent().next(); //input el
			if ($(inputValEl).val() == 1) {
				return;
			}
			inputVal = parseInt($(inputValEl).val()) - 1;

		} else {
			inputValEl = $(this).parent().prev(); //input el
			
			inputVal = parseInt($(inputValEl).val()) + 1;
		}
		let td = $(inputValEl).parent().parent(); //td
		let priceEl = $(td).prev().text();
		let total = inputVal * priceEl;
		$(td).next().html(total.toFixed(2));
		calcTotal();
	});

	$('.delete-item').on('click', function () {
		let row = $(this).parent();
		let prodId = $(this).attr('id');
		$(row).remove();
		const pCount = $('.delete-item').length;
		localStorage.setItem('cartCount', pCount);
		document.location = 'cart.php?remove='+prodId;
	});

	
});
