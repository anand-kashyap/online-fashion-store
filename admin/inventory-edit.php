<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
<?php 
$edit = false;
$pTitle = 'Edit';
if (isset($_POST['submit'])) {
  $qty = $_POST['qty'];
  updateStockById($qty);
  unset($_POST['submit']);
}
if (isset($_GET['id'])) {
  $row = getStockById($_GET['id']);
} else {
  redirect("inventory.php");
}
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title"><?php echo $pTitle; ?> Inventory</h4>
                <form class="form-horizontal m-t-30" id="needs-validation" novalidate action="" method="post">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" disabled class="form-control" value="<?php echo $row['product_title'];?>">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <img class="form-control w-25" src="../images/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_title'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Size</label>
                      <input type="text" disabled class="form-control" value="<?php echo $row['product_size'];?>">
                    </div>
                    <div class="form-group">
                        <label>Quantity (<span class="text-danger">*</span>)</label>
                        <input type="number" name="qty" placeholder="e.g. 45" class="form-control" value="<?php echo $row['quantity']; ?>">
                    </div>
                    <input id="save" type="submit" name="submit" class="btn btn-success" value="submit">
                    <a href="inventory.php" class="btn btn-danger">
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
<?php require_once './templates/footer.php'; ?>