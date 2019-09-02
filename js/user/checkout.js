$( function() {

  $('#place-order').on('click', function () {
    let paymentMethod = $("input[name='payment-method']:checked").val();
    console.log(paymentMethod);
    const aProds = $('.addedProds');
    const pIds = [];
    for (let sProd of aProds) {
      sProd = sProd.value;
      pIds.push(sProd);
    }
    $.post('thankyou.php', {pIds}).done((data) => {
      console.log(data);
      if (paymentMethod === 'paypal') {
        let productNamesArr = $('.product-name').map(function(){
          return $.trim($(this).text());
        }).get();
        let productPricesArr = $('.sub-product-price').map(function(){
          return $.trim($(this).text());
        }).get();
        
        $('#paypal-submit').submit();
      } else {
        localStorage.clear();
        document.location='thankyou.php';
      }
    });
  });
});