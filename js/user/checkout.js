$( function() {

  $('#place-order').on('click', function () {
    let paymentMethod = $("input[name='payment-method']:checked").val();
    console.log(paymentMethod);
    if (paymentMethod === 'paypal') {
      let productNamesArr = $('.product-name').map(function(){
        return $.trim($(this).text());
      }).get();
      let productPricesArr = $('.sub-product-price').map(function(){
        return $.trim($(this).text());
      }).get();

      $('#paypal-submit').submit();
    }
    // window.location='thankyou.php';
  });
});