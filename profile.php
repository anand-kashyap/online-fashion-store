<?php 
require_once 'includes/config.php'; 
include TEMPLATE_FRONT.DS.'header.php'; 
if (!isLoggedIn()) {
    setMessage('You need to login first');
    redirect('login.php');
}
?>
<link rel="stylesheet" href="admin/dist/css/style.min.css">
<!-- Container fluid  -->
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
        <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Profile</strong></div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<div class="container">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <?php $user = getUserDetails();?>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"> <img src="admin/assets/images/users/5.jpg" class="rounded-circle" width="150" />
                        <h4 class="card-title m-t-10"><?php echo $user['name']; ?></h4>
                        <h6 class="card-subtitle"><?php echo $user['company']; ?></h6>
                        <div class="row text-center justify-content-md-center">
                        </div>
                    </center>
                </div>
                <div>
                    <hr> </div>
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6><?php echo $user['email']; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6><?php echo $user['phone']; ?></h6> <small class="text-muted p-t-30 db">Address</small>
                    <h6><?php echo $user['address']; ?></h6>
                    <small class="text-muted p-t-30 db">Social Profile</small>
                    <br/>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" class="form-horizontal form-material">
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" value="<?php echo $user['name']; ?>" placeholder="Johnathan Doe" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" value="<?php echo $user['email']; ?>" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="psw" value="<?php echo $user['password']; ?>" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" name="phone" value="<?php echo $user['phone']; ?>" placeholder="123 456 7890" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <textarea name="address" class="form-control"><?php echo $user['address']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="country" class="form-control form-control-line">
                                <?php
                                $cArr = ['London', 'India', 'USA', 'Canada', 'Thailand'];
                                foreach ($cArr as $country) {
                                    $op = "<option"; 
                                    if (strtolower($country) == $user['country']) {
                                        $op .= " selected";
                                    }
                                    $op .= ">$country</option>";
                                    echo $op;
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button name="submit" class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                        <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
                        <?php updateUser(); ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
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
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<?php 
include TEMPLATE_FRONT.DS.'footer.php'; ?>