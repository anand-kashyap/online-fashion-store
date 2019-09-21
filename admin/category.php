<?
if (isset($_POST['subId'])) {
  require_once '../includes/config.php';
  $category = catsForNav();
  if (count($category['categories']) === 0) {
    echo '';
    return;
  }
  echo dynMenuAdmin($category, $_POST['subId']); return;
}
?>
<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
<?php 
$edit = false;
$pTitle = 'Add';
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $parentCat = $_POST['parent_category'];
  if (isset($_GET['id'])) {
      updateCat($title, $parentCat);
  } else {
      $prod = addCat($title, $parentCat);
      global $connection;
      $pId = mysqli_insert_id($connection);
      redirect("category.php?id=$pId");
  } 
  unset($_POST['submit']);
}
if (isset($_GET['delete'])) {
    $dId = $_GET['delete'];
    if (is_numeric($dId)) {
      deleteCatById($dId);
    }
    redirect('categories.php');
}
if (isset($_GET['id'])) {
  $edit = true;
  $pTitle = 'Edit';
  $row = getCatById($_GET['id']);
}
$cats = getCategories();
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title"><?php echo $pTitle; ?> Category</h4>
                <form class="form-horizontal m-t-30" id="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" placeholder="e.g. Foo" name="title" class="form-control" value="<?php echo $edit ? $row['label'] : "" ;?>">
                    </div>
                    <div class="form-group">
                      <label>Parent Category</label>
                      <select name="parent_category" class="form-control">
                        <option value="0">Root Category</option>
                        <?php 
                        while ($cat = fetchArray($cats)) {
                          if ($cat['id'] == $row['id']) {
                            continue;
                          }
                          $sel = $edit && $cat['id'] == $row['parent_id'] ? "selected" : "" ;
                          echo "<option $sel value='".$cat['id']."'>".$cat['label']."</option>";
                        }
                        ?></select>
                    </div>
                    <input id="save" type="submit" name="submit" class="btn btn-success" value="submit">
                    <a href="categories.php" class="btn btn-danger">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<script src="dist/js/jquery.validate.min.js"></script>
<script src="dist/js/cat.js"></script>
<?php require_once './templates/footer.php'; ?>