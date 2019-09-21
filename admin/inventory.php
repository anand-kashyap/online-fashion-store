<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Stock List -->
  <!-- ============================================================== -->
  <div class="row">
    <!-- column -->
    <div class="col-12">
      <div class="card">
        <div class="card-body mp-1">
          <div class="row">
            <div class="col-10">
              <h4 class="card-title mb-0">Available Stock of Products</h4>
            </div>
          </div>
        </div>
        <span class="border-bottom border-dark"></span>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="border-top-0">#ID</th>
                <th class="border-top-0">PRODUCT IMAGE</th>
                <th class="border-top-0">NAME</th>
                <th class="border-top-0">SIZE</th>
                <th class="border-top-0">QUANTITY</th>
                <th class="border-top-0">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stock = getStock();
              while ($row = fetchArray($stock)) {
                ?>
                <tr>
                  <td><h5><?php echo $row['id'] ?></h5></td>
                  <td class="w-25 id-link"><a href="product.php?id=<?php echo $row['product_id']?>"> <img src="../images/<?php echo $row['product_image'] ?>" alt="Image placeholder" class="w-50"></a></td>
                  <td class="id-link"><a href="product.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_title']; ?></a></td>
                  <td><?php 
                  $size = $row['product_size'];
                  echo getSize($size);
                  ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td>
                    <a href="inventory-edit.php?id=<?php echo $row['id'];?>" class="label label-success label-rounded">EDIT</a> 
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once './templates/footer.php'; ?>