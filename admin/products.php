<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
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
                          while ($row = fetchArray($prods)) {
                          ?>
                          <tr>
                            <td class="w-25"><img src="../images/<?php echo $row['product_image']?>" alt="Image placeholder" class="w-50"></td>
                            <td><?php echo $row['product_title']; ?></td>
                            <td><span class="font-medium">$<?php echo $row['product_price']; ?></span></td>
                            <td class="w-25"><?php echo $row['product_short_desc']; ?></td>
                            <td>
                              <a href="product.php?id=<?php echo $row['product_id'];?>" class="label label-success label-rounded">EDIT</a>
                              <button class="label label-danger label-rounded" data-toggle="modal" data-target="#deleteModal<?php echo $row['product_id']; ?>">DELETE</button> 
                            </td>
                          </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="deleteModal<?php echo $row['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $row['product_id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="deleteModalLabel<?php echo $row['product_id']; ?>">Delete Product - <strong><?php echo $row['product_title']; ?></strong> ?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this product ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="button" id="<?php echo $row['product_id']; ?>" class="btn btn-danger" class="deleteProd">Delete</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
  $( function() {
    $('.modal').on('click', 'button', function (e) {
      let prodId = $(this).attr('id');
      if (prodId) {
        document.location = 'product.php?delete=' + prodId;
      }
      return false;
    });
  });
</script>
<?php require_once './templates/footer.php'; ?>