<?php 
require_once 'includes/config.php'; 
include TEMPLATE_FRONT.DS.'header.php'; 

// pagination
$paginArr = paginatedResults('products', 1);
// sorting of products
$sortedProds = sortProds();
$orderBy = $sortedProds['orderBy']; $orderDir = $sortedProds['orderDir']; $sorted = $sortedProds['sorted'];
?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-9 order-2">
            
            <!-- Dropdowns in top-right -->
            <?php
            if (!isset($_GET['q'])) {
            ?>
            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
                <div class="d-flex">
                  <div class=" dropdown mr-1 ml-md-auto btn-group">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown"><?php echo $sorted;?></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                      <a class="dropdown-item" href="shop.php">Latest</a>
                      <a class="dropdown-item" href="?name=asc">Name, A to Z</a>
                      <a class="dropdown-item" href="?name=desc">Name, Z to A</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="?price=asc">Price, low to high</a>
                      <a class="dropdown-item" href="?price=desc">Price, high to low</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="row mb-5">
              <?php 
              if (isset($_GET['q'])) {
                searchProducts($_GET['q']);
              } else {
                getProducts(false, $orderBy, $orderDir, $paginArr['offset'], $paginArr['recordsPerPage']);  
              }
               ?>

            </div>
            <!-- pagination -->
            <?php
            if (!isset($_GET['q']) && $paginArr['totalPages'] > 1) {
            ?>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                    <?php 
                    if ($paginArr['pageNo'] > 1) { ?>
                      <li><a href="<?php echo "?".setPageNum(1);?>">&lt;&lt;</a>
                    <?php }?>
                    <?php
                    if ($paginArr['pageNo'] + 1 < $paginArr['totalPages']) {
                      $pCount = $paginArr['pageNo'] + 1;
                      $pStart = $paginArr['pageNo'] - 1;
                      if ($pStart < 1) {
                        $pStart = 1;
                      }
                      if ($pStart == 1) {
                        $pCount = $pStart+2 < $paginArr['totalPages'] ? $pStart+2 : $paginArr['totalPages'];
                      }
                    } else {
                      $pStart = $paginArr['pageNo'] - 1;
                      $pCount = $paginArr['totalPages'];
                    }
                    for ($i=$pStart; $i <= $pCount; $i++) { 
                      $pNum = $i ;
                      echo "<li";
                      if ($pNum == $paginArr['pageNo']) {
                        echo " class='active' ";
                      }
                      echo "><a href='?".setPageNum($pNum)."'>$pNum</a></li>";
                    }
                    ?>
                    <?php
                    if ($paginArr['pageNo'] < $paginArr['totalPages']) { ?>
                    <li><a href="<?php echo "?".setPageNum($paginArr['totalPages']);?>">&gt;&gt;</a>
                    <?php }?>
                  </ul>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <?php site_dyn_cats(); ?>
              </ul>
            </div>

            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
              </div>

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

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">
                <div class="row justify-content-center text-center mb-5">
                  <div class="col-md-7 site-section-heading pt-4">
                    <h2>Categories</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/women.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Women</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/children.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Children</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/men.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Men</h3>
                      </div>
                    </a>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include TEMPLATE_FRONT.DS.'footer.php'; ?>