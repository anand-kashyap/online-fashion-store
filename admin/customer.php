<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>

<?php
$edit = false;
$pTitle = 'Add';
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    // redirect('product.php?id='.$_POST['pId']); die();
    if (isset($_GET['id'])) {
        updateCust($_POST);
    } else {
        // $prod = addCust($_POST);
        // $pId = getLastInsertedId();
        // redirect("customer.php?id=$pId");
    }
}
if (isset($_GET['id'])) {
    $edit = true;
    $pTitle = 'Edit';
    $row = getCustById($_GET['id']);
}
if (isset($_GET['delete'])) {
    $dId = $_GET['delete'];
    if (is_numeric($dId)) {
        deleteCustById($dId);
    }
    redirect('customers.php');
}
?>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title"><?php echo $pTitle; ?> Customer</h4>
                <form class="form-horizontal m-t-30" id="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name (<span class="text-danger">*</span>)</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $edit ? $row['name'] : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label>User Name (<span class="text-danger">*</span>)</label>
                        <input type="text" name="user_name" class="form-control" value="<?php echo $edit ? $row['user_name'] : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email (<span class="text-danger">*</span>)</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $edit ? $row['email'] : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label>Phone (<span class="text-danger">*</span>)</label>
                        <input type="number" name="phone" class="form-control" value="<?php echo $edit ? $row['phone'] : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label>Company (<span class="text-danger">*</span>)</label>
                        <input type="text" name="company" class="form-control" value="<?php echo $edit ? $row['company'] : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label>Address (<span class="text-danger">*</span>)</label>
                        <textarea name="address" class="form-control"><?php echo $edit ? $row['address'] : ""; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Country(<span class="text-danger">*</span>)</label>
                        <select name="country" class="form-control form-control-line">
                        <?php
                        $cArr = ['London', 'India', 'USA', 'Canada', 'Thailand'];
                        foreach ($cArr as $country) {
                            $op = "<option"; 
                            if (strtolower($country) == $row['country']) {
                                $op .= " selected";
                            }
                            $op .= ">$country</option>";
                            echo $op;
                        }
                        ?>
                        </select>
                    </div>
                    <input id="save" type="submit" name="submit" class="btn btn-success" value="submit">
                    <a href="customers.php" class="btn btn-danger">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
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
<script src="dist/js/customer.js"></script>
<?php require_once './templates/footer.php'; ?>