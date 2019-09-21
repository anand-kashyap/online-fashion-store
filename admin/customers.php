<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Customers List -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body mp-1">
                      <div class="row">
                        <div class="col-10">
                          <h4 class="card-title mb-0">Customers</h4>
                        </div>
                      </div>
                    </div>
                    <span class="border-bottom border-dark"></span>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="border-top-0">#ID</th>
                            <th class="border-top-0">NAME</th>
                            <th class="border-top-0">EMAIL</th>
                            <th class="border-top-0">PHONE</th>
                            <th class="border-top-0">COUNTRY</th>
                            <th class="border-top-0">ACTIONS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $custs = getCustomers();
                          while ($row = fetchArray($custs)) {
                          ?>
                          <tr>
                            <td><span class="font-medium"><?php echo $row['user_id']?></span></td>
                            <td><span class="font-medium"><?php echo $row['name']?></span></td>
                            <td class="w-25"><?php echo $row['email']; ?></td>
                            <td><span class="font-medium"><?php echo $row['phone']; ?></span></td>
                            <td><?php echo strtoupper($row['country']); ?></td>
                            <td>
                              <a href="customer.php?id=<?php echo $row['user_id'];?>" class="label label-success label-rounded">EDIT</a>
                              <button class="label label-danger label-rounded" data-toggle="modal" data-target="#deleteModal<?php echo $row['user_id']; ?>">DELETE</button> 
                            </td>
                          </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="deleteModal<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $row['user_id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="deleteModalLabel<?php echo $row['user_id']; ?>">Delete Customer - <strong><?php echo $row['name']; ?></strong> ?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this customer ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="button" id="<?php echo $row['user_id']; ?>" class="btn btn-danger" class="deleteProd">Delete</button>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<script>
  $( function() {
    $('.modal').on('click', 'button', function (e) {
      let custId = $(this).attr('id');
      if (custId) {
        document.location = 'customer.php?delete=' + custId;
      }
      return false;
    });
  });
</script>
<?php require_once './templates/footer.php'; ?>