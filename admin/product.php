<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>

<?php 
    $edit = false;
    $pTitle = 'Add';
if (isset($_POST['submit'])) {
    // redirect('product.php?id='.$_POST['pId']); die();
    $title = $_POST['title'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $shortDesc = $_POST['shortdesc'];
    $desc = $_POST['desc'];
    $cat = $_POST['category'];
    $fname = $_POST['oldPImage'];
    if (isset($_FILES['pImage']) && $_FILES['pImage']['size'] < 1000000) {
        $fileUp = move_uploaded_file($_FILES['pImage']['tmp_name'], '../images/'.basename($_FILES["pImage"]["name"]));
        if ($fileUp) {
            $fname = basename($_FILES["pImage"]["name"]);
        }
    }
    if (isset($_GET['id'])) {
        updateProduct($title, $price, $qty, $shortDesc, $desc, $cat, $fname);
    } else {
        $prod = addProduct($title, $price, $qty, $shortDesc, $desc, $cat, $fname);
        global $connection;
        $pId = mysqli_insert_id($connection);
        redirect("product.php?id=$pId");
    } 
    unset($_POST['submit']);
}
if (isset($_GET['id'])) {
    $edit = true;
    $pTitle = 'Edit';
    $row = getProductById($_GET['id']);
}
if (isset($_GET['delete'])) {
    $dId = $_GET['delete'];
    if (is_numeric($dId)) {
     deleteProductById($dId);
    }
    redirect('products.php');
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
                <h4 class="card-title"><?php echo $pTitle; ?> Product</h4>
                <form class="form-horizontal m-t-30" id="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" placeholder="e.g. Product Foo" name="title" class="form-control" value="<?php echo $edit ? $row['product_title'] : "" ;?>">
                    </div>
                    <div class="form-group">
                        <label>Price ($)</label>
                        <input type="number" name="price" placeholder="e.g. 13.50" class="form-control" value="<?php echo $edit ? $row['product_price'] : 0 ;?>">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="qty" placeholder="e.g. 45" class="form-control" value="<?php echo $edit ? $row['product_quantity'] : 0 ;?>">
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="shortdesc" class="form-control" rows="5"><?php echo $edit ? $row['product_short_desc'] : "" ;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" class="form-control" rows="5"><?php echo $edit ? $row['product_description'] : "" ;?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="pImage">
                        <input type="hidden" name="oldPImage" value="<?php echo $row['product_image']; ?>">
                        <?php if ($edit) {?>
                            <img class="form-control w-25" src="../images/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_title']?>">
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <?php 
                            while ($cat = fetch_array($cats)) {
                                $sel = $edit && $cat['id'] == $row['product_category_id'] ? "selected" : "" ;
                                echo "<option $sel value='".$cat['id']."'>".$cat['label']."</option>";
                            }
                            ?></select>
                    </div>
                    <input id="save" type="submit" name="submit" class="btn btn-success" value="submit">
                    <a href="products.php" class="btn btn-danger">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<script src="dist/js/jquery.validate.min.js"></script>
<script src="dist/js/product.js"></script>
<?php require_once './templates/footer.php'; ?>