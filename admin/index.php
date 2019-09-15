<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
<?php require_once './templates/breadcrumb.php'; ?>

    
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sales Ratio</h4>
                        <div class="sales ct-charts mt-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-5">Total Sales</h5>
                        <h3 class="font-light">$<?php echo getTotalSales();?></h3>
                        <div class="m-t-20 text-center">
                            <div id="earnings"></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-0">Users</h4>
                        <h2 class="font-light">35,658 <span class="font-16 text-success font-medium">+23%</span></h2>
                        <div class="m-t-30">
                            <div class="row text-center">
                                <div class="col-6 border-right">
                                    <h4 class="m-b-0">58%</h4>
                                    <span class="font-14 text-muted">New Users</span>
                                </div>
                                <div class="col-6">
                                    <h4 class="m-b-0">42%</h4>
                                    <span class="font-14 text-muted">Repeat Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Revenue - page-view-bounce rate -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Latest Sales</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="border-top-0">NAME</th>
                                    <th class="border-top-0">PAYMENT</th>
                                    <th class="border-top-0">DATE</th>
                                    <th class="border-top-0">PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $latestSales = getLatestSales();
                                while ($row = fetchArray($latestSales)) {
                                ?>   
                                <tr>
                                    <td class="txt-oflo"><?php echo $row['name'];?></td>
                                    <td><span class="label <?php echo getRoundedLabel($row['payment']);?> label-rounded"><?php echo $row['payment'];?></span> </td>
                                    <td class="txt-oflo"><?php echo date_format(date_create($row['date']), 'd F, Y');?></td>
                                    <td><span class="font-medium">$<?php echo $row['price'];?></span></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Ravenue - page-view-bounce rate -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<!--chartis chart-->
<script src="assets/libs/chartist/dist/chartist.min.js"></script>
<script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<!--This page JavaScript -->
<script src="dist/js/pages/dashboards/dashboard1.js"></script>
<?php require_once './templates/footer.php'; ?>