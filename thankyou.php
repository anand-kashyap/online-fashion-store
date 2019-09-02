<?php 
    require_once 'includes/config.php'; 
    if (isset($_POST['pIds'])) {
      addOrder($_POST['pIds']);
      echo 'Order Placed';
      return;
    }
    if (isset($_SESSION['cart'])) {
      unset($_SESSION['cart']);
    }
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