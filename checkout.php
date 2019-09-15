<?php
require_once 'includes/config.php';
include TEMPLATE_FRONT . DS . 'header.php';
if ($product = getCartProductsDetail()) {
  // print_r($product); die;
  ?>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.php">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <?php if (!isLoggedIn()) { ?>
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="login.php">Click here</a> to login
            </div>
          </div>
        </div>
      <?php } 
      $user = getUserDetails();
      ?>
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Billing Details</h2>
          <div class="p-3 p-lg-5 border">
            <div class="form-group">
                <label for="c_name" class="text-black">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="<?php echo $user['name'];?>" id="c_name" name="name">
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_companyname" class="text-black">Company Name </label>
                <input type="text" class="form-control" id="c_companyname" value="<?php echo $user['company'];?>" name="company">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="<?php echo $user['address'];?>" id="c_address" name="c_address" placeholder="Street address">
              </div>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" placeholder="Landmark, if any (optional)">
            </div>

            <div class="form-group">
              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
              <select id="c_country" class="form-control">
                <option selected disabled>Select a country</option>
                <?php $cArr = ['India', 'Bangladesh', 'USA', 'Afghanistan', 'Ghana', 'Albania', 'Bahrain', 'Colombia' ]; 
                foreach ($cArr as $country) {
                    $op = "<option"; 
                    if (strtolower($country) == $user['country']) {
                        $op .= " selected";
                    }
                    $op .= ">$country</option>";
                    echo $op;
                }
                ?>
              </select>
            </div>

            <div class="form-group row mb-5">
              <div class="col-md-6">
                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $user['email'];?>" class="form-control" id="c_email_address" name="c_email_address">
              </div>
              <div class="col-md-6">
                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $user['phone'];?>" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
              </div>
            </div>

            <div class="form-group">
              <label for="c_ship_different_address" class="text-black" data-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" value="1" id="c_ship_different_address"> Ship To A Different Address?</label>
              <div class="collapse" id="ship_different_address">
                <div class="py-2">

                  <div class="form-group">
                    <label for="c_diff_country" class="text-black">Country <span class="text-danger">*</span></label>
                    <select id="c_diff_country" class="form-control">
                      <option value="1">Select a country</option>
                      <option value="2">bangladesh</option>
                      <option value="3">Algeria</option>
                      <option value="4">Afghanistan</option>
                      <option value="5">Ghana</option>
                      <option value="6">Albania</option>
                      <option value="7">Bahrain</option>
                      <option value="8">Colombia</option>
                      <option value="9">Dominican Republic</option>
                    </select>
                  </div>


                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="c_diff_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_fname" name="c_diff_fname">
                    </div>
                    <div class="col-md-6">
                      <label for="c_diff_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_lname" name="c_diff_lname">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="c_diff_companyname" class="text-black">Company Name </label>
                      <input type="text" class="form-control" id="c_diff_companyname" name="c_diff_companyname">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="c_diff_address" class="text-black">Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_address" name="c_diff_address" placeholder="Street address">
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="c_diff_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_state_country" name="c_diff_state_country">
                    </div>
                    <div class="col-md-6">
                      <label for="c_diff_postal_zip" class="text-black">Postal / Zip code<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_postal_zip" name="c_diff_postal_zip">
                    </div>
                  </div>

                  <div class="form-group row mb-5">
                    <div class="col-md-6">
                      <label for="c_diff_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_email_address" name="c_diff_email_address">
                    </div>
                    <div class="col-md-6">
                      <label for="c_diff_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="c_diff_phone" name="c_diff_phone" placeholder="Phone Number">
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="form-group">
              <label for="c_order_notes" class="text-black">Order Notes</label>
              <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
            </div>

          </div>
        </div>
        <div class="col-md-6">

          <!-- <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                <div class="p-3 p-lg-5 border">
                  
                  <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                    </div>
                  </div>

                </div>
              </div>
            </div> -->

          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-5">
                  <thead>
                    <th>Product</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    <?php foreach ($product as $row) {
                      ?>
                      <input type="hidden" class="addedProds" value='<?php echo $row['product_id']?>'>
                      <input type="hidden" class="addedProdsQty" value='<?php echo $row['qty']?>'>
                      <input type="hidden" class="addedProdsSize" value='<?php echo $row['size']?>'>
                      <tr>
                        <td><span class="product-name"><?php echo $row['product_title']; echo "({$row['size']})"; ?></span><strong class="mx-2">x</strong> <?php echo $row['qty']; ?></td>
                        <td>$<span class="sub-product-price"><?php echo $row['qty'] * $row['product_price']; ?></span></td>
                      </tr>
                    <?php } ?>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                      <td class="text-black">$<span id="sub-total-price">0<span></td>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Delivery Charges</strong></td>
                      <td class="text-black">$<span id="sub-total-price">10.00<span></td>
                    </tr>
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                      <td class="text-black font-weight-bold"><strong>$<span id="total-price">0</span></strong></td>
                    </tr>
                  </tbody>
                </table>

                <div class="border p-3 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment-method" id="direct-bank" value="direct bank transfer" checked>
                    <label class="h6 form-check-label" for="direct-bank">
                      Direct Bank Transfer
                    </label>
                  </div>
                </div>

                <div class="border p-3 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment-method" id="cash-on-delivery" value="cash on delivery">
                    <label class="h6 form-check-label" for="cash-on-delivery">
                      Cash On Delivery
                    </label>
                  </div>
                </div>

                <div class="border p-3 mb-5">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment-method" id="paypal" value="paypal">
                    <label class="h6 form-check-label" for="paypal">
                      Paypal
                    </label>
                  </div>
                  <form id="paypal-submit" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type='hidden' name='business' value='anandkashyap60-facilitator@gmail.com'>
                    <input type='hidden' name='currency_code' value='USD'>
                    <input type="hidden" name="upload" value="1">
                    <?php $product2 = getCartProductsDetail();
                      foreach ($product2 as $row2) { ?>
                      <input type='hidden' name='item_name_<?php echo $row2['product_id']; ?>' value='<?php echo $row2['product_title'] ?>'>
                      <input type='hidden' name='item_number_<?php echo $row2['product_id'] ?>' value='<?php echo $row2['product_id'] ?>'>
                      <input type='hidden' name='amount_<?php echo $row2['product_id'] ?>' value='<?php echo $row2['product_price'] ?>'>
                    <?php } ?>
                    <input type='hidden' name='cancel_return' value='<?php echo DOMAIN_URL?>/cart.php'>
                    <input type='hidden' name='return' value='<?php echo DOMAIN_URL?>/thankyou.php'>
                    <input type="hidden" name="cmd" value="_cart">
                  </form>
                </div>

                <div class="form-group">
                  <button class="btn btn-primary btn-lg py-3 btn-block" id="place-order">Place Order</button>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>
  <script src='js/user/cart.js'></script>
  <script src='js/user/checkout.js'></script>
<?php
} else {
  redirect('/');
}
include TEMPLATE_FRONT . DS . 'footer.php'; ?>