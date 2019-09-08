$( function() {

  $('#place-order').on('click', function () {
    let paymentMethod = $("input[name='payment-method']:checked").val();
    console.log(paymentMethod);
    const aProds = $('.addedProds');
    const pIds = [];
    for (let i = 0; i < aProds.length; i++) {
        const el = {};
        el.id = aProds[i].value;
        el.qty = $('.addedProdsQty')[i].value;
        el.size = $('.addedProdsSize')[i].value;
        pIds.push(el);
    }
    $.post('thankyou.php', {pIds, paymentMethod}).done((data) => {
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