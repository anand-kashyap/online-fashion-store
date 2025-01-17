<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>

<?php
$edit = false;
$pTitle = 'Add';
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $isFeatured = $_POST['is_featured'];
    $shortDesc = $_POST['shortdesc'];
    $desc = $_POST['desc'];
    $cat = $_POST['category'];
    $fname = $_POST['oldPImage'];
    if (isset($_FILES['pImage']) && $_FILES['pImage']['size'] < 1000000) {
        $fileUp = move_uploaded_file($_FILES['pImage']['tmp_name'], '../images/' . basename($_FILES["pImage"]["name"]));
        if ($fileUp) {
            $fname = basename($_FILES["pImage"]["name"]);
        }
    }
    if (isset($_GET['id'])) {
        updateProduct($title, $price, $shortDesc, $desc, $cat, $fname, $isFeatured);
    } else {
        $pId = addProduct($title, $price, $shortDesc, $desc, $cat, $fname, $isFeatured);
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
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title"><?php echo $pTitle; ?> Product</h4>
                <form class="form-horizontal m-t-30" id="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name (<span class="text-danger">*</span>)</label>
                        <input type="text" placeholder="e.g. Product Foo" name="title" class="form-control" value="<?php echo $edit ? $row['product_title'] : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label>Price ($) (<span class="text-danger">*</span>)</label>
                        <input type="number" name="price" placeholder="e.g. 13.50" class="form-control" value="<?php echo $edit ? $row['product_price'] : 0; ?>">
                    </div>
                    <div class="form-group">
                        <label>Featured Product</label>
                        <select name="is_featured" class="form-control is-featured">
                            <option <?php echo $edit && $row['is_featured'] == 0 ? 'selected' : ''; ?> value="0">No</option>
                            <option <?php echo $edit && $row['is_featured'] == 1 ? 'selected' : ''; ?> value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Short Description(<span class="text-danger">*</span>)</label>
                        <textarea name="shortdesc" class="form-control" rows="5"><?php echo $edit ? $row['product_short_desc'] : ""; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" class="form-control" rows="5"><?php echo $edit ? $row['product_description'] : ""; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="pImage">
                        <input type="hidden" name="oldPImage" value="<?php echo $row['product_image']; ?>">
                        <?php if ($edit) { ?>
                        <img class="form-control w-25" src="../images/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_title'] ?>">
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Category (<span class="text-danger">*</span>)</label>
                        <select name="category" class="form-control">
                            <?php
                            while ($cat = fetchArray($cats)) {
                                $sel = $edit && $cat['id'] == $row['product_category_id'] ? "selected" : "";
                                echo "<option $sel value='" . $cat['id'] . "'>" . $cat['label'] . "</option>";
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
</div>
<script src="dist/js/jquery.validate.min.js"></script>
<script src="dist/js/product.js"></script>
<?php require_once './templates/footer.php'; ?>