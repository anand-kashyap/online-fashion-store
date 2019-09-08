<?php 
    require_once 'includes/config.php'; 
    if (isset($_POST['pIds'])) {
      $pMethod = $_POST['paymentMethod'];
      addOrder($_POST['pIds'], $pMethod);
      echo 'Order Placed';
      return;
    }
    if (isset($_SESSION['cart'])) {
      unset($_SESSION['cart']);
    }
    /* $pIds = query("SELECT product_id from products");
    while($pid = fetch_array($pIds)['product_id']) {
      $res = query("INSERT INTO inventory (product_id, product_size, quantity) VALUES ($pid, 'sm', 100), ($pid, 'md', 100), ($pid, 'lg', 100), ($pid, 'xl', 100) ");

    } */

    include TEMPLATE_FRONT.DS.'header.php'; ?>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p class="lead mb-5">You order was successfuly completed.</p>
            <p><a href="shop.php" class="btn btn-sm btn-primary">Back to shop</a></p>
          </div>
        </div>
      </div>
    </div>

   <?php include TEMPLATE_FRONT.DS.'footer.php'; ?>