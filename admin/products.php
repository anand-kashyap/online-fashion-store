<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
<?php //require_once './templates/breadcrumb.php'; ?>

    
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Products List -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body mp-1">
                      <div class="row">
                        <div class="col-10">
                          <h4 class="card-title mb-0">Available Products</h4>
                        </div>
                        <div class="col-2">
                          <a class="btn btn-success" href="product.php">Create new</a>
                        </div>
                      </div>
                    </div>
                    <span class="border-bottom border-dark"></span>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="border-top-0">IMAGE</th>
                            <th class="border-top-0">NAME</th>
                            <th class="border-top-0">PRICE</th>
                            <th class="border-top-0">DESCRIPTION</th>
                            <th class="border-top-0">ACTIONS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $prods = getProducts(true);
                          while ($row = fetch_array($prods)) {
                          ?>
                          <tr class="">
                            <td class="w-25"><img src="../images/<?php echo $row['product_image']?>" alt="Image placeholder" class="w-50"></td>
                            <td class=""><?php echo $row['product_title']; ?></td>
                            <td class=""><span class="font-medium">$<?php echo $row['product_price']; ?></span></td>
                            <td class="w-25"><?php echo $row['product_short_desc']; ?></td>
                            <td class=""><a href="product.php?id=<?php echo $row['product_id'];?>" class="label label-success label-rounded">EDIT</a><button class="label label-danger label-rounded">DELETE</button> </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<?php require_once './templates/footer.php'; ?>