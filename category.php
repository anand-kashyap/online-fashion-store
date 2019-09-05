<?php 
require_once 'includes/config.php'; 
include TEMPLATE_FRONT.DS.'header.php';

$where = '';
$priceLower = 0; $priceUpper = 300;
if (isset($_POST['priceFilter'])) {
  $range = preg_replace('/\$/', '', $_POST['priceRange']); 
  $range = explode(' - ', $range);
  $priceLower = $range[0];
  $priceUpper = $range[1];
  $where = " AND product_price >= $priceLower AND product_price <= $priceUpper";
}

// pagination
$paginArr = paginatedResults('products', 9, 'product_category_id');

// sorting of products
$sortedProds = sortProds();
$orderBy = $sortedProds['orderBy']; $orderDir = $sortedProds['orderDir']; $sorted = $sortedProds['sorted'];
$cPage = 'category.php?id='.$_GET['id'];
?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Category</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <?php
            require_once TEMPLATE_FRONT.DS.'sort_dropdown.php'; 
            ?>
            <div class="row mb-5">
              <?php 
              getProductsInCat($orderBy, $orderDir, $paginArr['offset'], $paginArr['recordsPerPage'], $where); ?>
            </div>
            <!-- pagination -->
            <?php require_once TEMPLATE_FRONT.DS.'product_pagination.php'; ?>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">

            <div class="border p-4 rounded mb-4">
            <?php require_once TEMPLATE_FRONT.DS.'price_filter.php'?>

            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include TEMPLATE_FRONT.DS.'footer.php'; ?>