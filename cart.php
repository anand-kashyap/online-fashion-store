<?php
require_once 'includes/config.php';
if (isset($_GET['addByajax'])) {
  echo addToCart(true);
  return;
}
include TEMPLATE_FRONT . DS . 'header.php';
addToCart();
removeFromCart();
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mb-5">
    <form class="col-md-12" method="post">
      <div class="site-blocks-table">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="product-thumbnail">Image</th>
              <th class="product-name">Product</th>
              <th class="product-price">Price</th>
              <th class="product-quantity">Quantity</th>
              <th class="product-total">Total</th>
              <th class="product-remove">Remove</th>
            </tr>
          </thead>
          <tbody>
          <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <?php
            if ($product = getCartProductsDetail()) {
              while ($row = fetch_array($product)) { ?>

                <tr>
                  <td class="product-thumbnail">
                    <img src="images/<?php echo $row['product_image']; ?>" alt="Image" class="img-fluid">
                  </td>
                  <td class="product-name">
                    <h2 class="h5 text-black"><?php echo $row['product_title']; ?></h2>
                  </td>
                  <td><?php echo $row['product_price']; ?></td>
                  <td>
                    <div class="input-group mb-3" style="max-width: 120px;">
                      <div class="input-group-prepend">
                        <button class="btn btn-outline-primary js-btn-minus calc" type="button">-</button>
                      </div>
                      <input type="text" disabled class="form-control text-center" min="1" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                      <div class="input-group-append">
                        <button class="btn btn-outline-primary js-btn-plus calc" type="button">+</button>
                      </div>
                    </div>

                  </td>
                  <td class="sub-product-price"><?php echo $row['product_price']; ?></td>
                  <td class="delete-item" id="<?php echo $row['product_id']; ?>"><button type="button" class="btn btn-primary btn-sm">X</button></td>
                </tr>
            <?php
              }
            } 
          } else { ?>
            <tr><td colspan="6">No product added to cart</td></tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </form>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="row mb-5">
        <div class="col-md-6">
          <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='shop.php'">Continue Shopping</button>
        </div>
      </div>
      <!-- <div class="row">
            <div class="col-md-12">
              <label class="text-black h4" for="coupon">Coupon</label>
              <p>Enter your coupon code if you have one.</p>
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
              <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary btn-sm">Apply Coupon</button>
            </div>
          </div> -->
    </div>
    <div class="col-md-6 pl-5">
      <div class="row justify-content-end">
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-12 text-right border-bottom mb-5">
              <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <span class="text-black">Subtotal</span>
            </div>
            <div class="col-md-6 text-right">
              <strong class="text-black" id="sub-total-price">$0</strong>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6">
              <span class="text-black">Total</span>
            </div>
            <div class="col-md-6 text-right">
              <strong class="text-black">$<span id="total-price">0</span></strong>
            </div>
          </div>

          <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./js/user/cart.js"></script>
<?php
include TEMPLATE_FRONT . DS . 'footer.php'; ?>