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
$paginArr = paginatedResults('products', 10, 'product_category_id');

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

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                <label for="s_sm" class="d-flex">
                  <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (2,319)</span>
                </label>
                <label for="s_md" class="d-flex">
                  <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (1,282)</span>
                </label>
                <label for="s_lg" class="d-flex">
                  <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (1,392)</span>
                </label>
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red (2,429)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Green (2,298)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue (1,075)</span>
                </a>
                <a href="#" class="d-flex color-item align-items-center" >
                  <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Purple (1,075)</span>
                </a>
              </div>

            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include TEMPLATE_FRONT.DS.'footer.php'; ?>