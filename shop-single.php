<?php 
require_once 'includes/config.php'; 
include TEMPLATE_FRONT.DS.'header.php'; 
?>
<?php 
if (!isset($_GET['id'])) {
  redirect('shop.php');
}
$row = getProductById($_GET['id']);
        
 ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $row['product_title'] ?></strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="images/<?php echo $row['product_image'] ?>" alt="<?php echo $row['product_title'] ?>" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $row['product_title'] ?></h2>
            <p><?php echo $row['product_description'] ?></p>
            <p><strong class="text-primary h4">$<?php echo $row['product_price'] ?></strong></p>
            <div class="mb-1 d-flex">
              <?php 
              $sizes = getProdSizesById($row['product_id']);
              while ($size = fetch_array($sizes)) {
                if ($size['quantity'] < 1) {
                  continue;
                }
                echo "<label for='option-{$size['product_size']}' class='d-flex mr-3 mb-3'>
                <span class='d-inline-block mr-2' style='top:-2px; position: relative;'><input type='radio' id='option-{$size['product_size']}' value='{$size['product_size']}' name='size'></span> <span class='d-inline-block text-black'>".getSize($size['product_size'])."</span>
              </label>";
              }
              ?>
            </div>
            <p id="cartMessage"></p>
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" id="qty" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div>
            <input id="productId" type="hidden" value="<?php echo $row['product_id'] ?>">
            <p>
              <button id="addProduct" class="buy-now btn btn-sm btn-primary">Add To Cart</button>
            </p>

          </div>
        </div>
      </div>
    </div>

    <!-- SLIDER HERE -->
    <div class="site-section block-3 site-blocks-2 bg-light">
      <?php 
        include TEMPLATE_FRONT.DS.'slider.php'; 
      ?>
    </div>

    <?php include TEMPLATE_FRONT.DS.'footer.php'; ?>