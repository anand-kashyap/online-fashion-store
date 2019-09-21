<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
    
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Categories List -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body mp-1">
                      <div class="row">
                        <div class="col-10">
                          <h4 class="card-title mb-0">Available Categories</h4>
                        </div>
                        <div class="col-2">
                          <a class="btn btn-success" href="category.php">Create new</a>
                        </div>
                      </div>
                    </div>
                    <span class="border-bottom border-dark"></span>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="border-top-0">ID</th>
                            <th class="border-top-0">NAME</th>
                            <th class="border-top-0">ACTIONS</th>
                            <th class="border-top-0">More</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $cats = getCategories(true);
                          while ($row = fetchArray($cats)) {
                          ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['label']; ?></td>
                            <td>
                              <a href="category.php?id=<?php echo $row['id'];?>" class="label label-success label-rounded">EDIT</a>
                              <button class="label label-danger label-rounded" data-toggle="modal" data-target="#deleteModal<?php echo $row['id']; ?>">DELETE</button> 
                            </td>
                            <td>
                              <button class="btn btn-link collapsed sub-cat" type="button" data-toggle="collapse" data-target="#collapse<?php echo $row['id'];?>" aria-expanded="false" aria-controls="collapse<?php echo $row['id'];?>">
                                Sub-Categories
                              </button>
                            </td>
                          </tr>
                          <td id="collapse<?php echo $row['id'];?>" class="collapse" colspan="4">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life
                          </td>
                          <!-- Modal -->
                          <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $row['d']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="deleteModalLabel<?php echo $row['d']; ?>">Delete Category - <strong><?php echo $row['label']; ?></strong> ?</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to delete this category ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="button" id="<?php echo $row['id']; ?>" class="btn btn-danger" class="deleteProd">Delete</button>
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
    $('.sub-cat').on('click', function () {
      let open = $(this).hasClass('collapsed');
      if (open) {
        const subEl = $(this).attr('aria-controls');
        const subId = subEl.split('collapse')[1];
        $.post(
          "category.php",
          { subId }, function(data, status){
          if (status === 'success') {
            if (data !== '') {
              $('#'+subEl).html(data);
            }
          } else {
            console.log('error');
          }
        });
      }
    });

    $('.modal').on('click', 'button', function (e) {
      let catId = $(this).attr('id');
      if (catId) {
        document.location = 'category.php?delete=' + catId;
      }
      return false;
    });
  });
</script>
<?php require_once './templates/footer.php'; ?>