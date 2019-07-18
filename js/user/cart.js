$( function() {
	console.log("working");
	$('.calc').on('click', function() {
		console.log('total');
		if ($(this).text() == '-') { //on decrease
		let inputValEl = $(this).parent().next(); //input el
		let inputVal = $(inputValEl).val() - 1;
		let td = $(inputVal).parent().parent(); //td
		let priceEl = $(td).prev().text();
		let total = inputVal * priceEl;
		let totalEl = $(td).next().html(total);
		console.log(total);

		} else {

		}
	});
});
