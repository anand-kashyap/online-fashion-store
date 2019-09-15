<?php
require_once 'includes/config.php';
if (!isLoggedIn()) {
  setMessage('You need to login first');
  redirect('login.php');
}
include TEMPLATE_FRONT . DS . 'header.php';
?>

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">My Orders</strong></div>
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
              <th class="order-id">Order ID</th>
              <th class="product-thumbnail">Product Image</th>
              <th class="product-name">Product Name</th>
              <th class="product-price">Amount</th>
              <th class="product-quantity">Quantity</th>
              <th class="order-date">Order Date</th>
              <th class="payment-type">Payment</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($orders = getMyOrders()) {
              while ($row = fetchArray($orders)) { ?>
                <tr>
                <td class="order-id">
                    <h2 class="h5 text-black"><?php echo $row['order_id']; ?></h2>
                  </td>
                  <td class="product-thumbnail">
                    <img src="images/<?php echo $row['product_image']; ?>" alt="Image" class="img-fluid">
                  </td>
                  <td class="product-name">
                    <h3 class="h6 text-black"><?php echo $row['product_title']; ?></h3>
                  </td>
                  <td><?php echo $row['product_price'] * $row['quantity']; ?></td>
                  <td>
                  <?php echo $row['quantity']; ?>
                  </td>
                  <td><?php echo date_format(date_create($row['order_date']), 'l, d F, Y');?></td>
                  <td><?php echo ucwords($row['payment_method']);?></td>
                </tr>
            <?php
              }
            } ?>
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
    </div>
  </div>
</div>
<?php
include TEMPLATE_FRONT . DS . 'footer.php'; ?>