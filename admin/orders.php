<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>
<?php //require_once './templates/breadcrumb.php'; 
$from = ''; $to = '';
if (isset($_POST['from']) && isset($_POST['to'])) {
  $from = $_POST['from'];
  $to = $_POST['to'];
}
?>

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Orders List -->
  <!-- ============================================================== -->
  <div class="row">
    <!-- column -->
    <div class="col-12">
      <div class="card">
        <div class="card-body mp-1">
          <div class="row">
            <div class="col-4">
              <h4 class="card-title mb-0">Available Orders</h4>
            </div>
            <div class="col-8">
              <form action="" method="post">
                <div class="row date-picker" id="date-picker">
                  <div class="col-3">
                    <input placeholder="YYYY/MM/DD" value="<?php echo $from;?>" name="from" class="form-control form-control-sm" type="text">
                    <span class="text-danger"></span>
                  </div>
                  <div class="col-1"><span>to</span></div>
                  <div class="col-3">
                    <input placeholder="YYYY/MM/DD" name="to" value="<?php echo $to;?>" class="form-control form-control-sm" type="text">
                    <span class="text-danger"></span>
                  </div>
                  <div class="col-5">
                    <button class="btn btn-sm btn-outline-success">Search</button>
                    <button class="btn btn-sm btn-outline-danger" type="button" onclick="window.location='orders.php'">Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <span class="border-bottom border-dark"></span>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="border-top-0">#ID</th>
                <th class="border-top-0">PRODUCT IMAGE</th>
                <th class="border-top-0">NAME</th>
                <th class="border-top-0">SIZE</th>
                <th class="border-top-0">QUANTITY</th>
                <th class="border-top-0">AMOUNT</th>
                <th class="border-top-0">ORDER DATE</th>
                <th class="border-top-0">CUSTOMER</th>
                <th class="border-top-0">PAYMENT</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $orders = getAllOrders($from, $to);
              while ($row = fetchArray($orders)) {
                ?>
                <tr>
                  <td><h5><?php echo $row['order_id'] ?></h5></td>
                  <td class="w-25 id-link"><a href="product.php?id=<?php echo $row['product_id']?>"> <img src="../images/<?php echo $row['product_image'] ?>" alt="Image placeholder" class="w-50"></a></td>
                  <td class="id-link"><a href="product.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_title']; ?></a></td>
                  <td><?php echo getSize($row['size']); ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><span class="font-medium">$<?php echo $row['product_price'] * $row['quantity']; ?></span></td>
                  <td><?php echo date_format(date_create($row['order_date']), 'l, d/m/Y');?></td>
                  <td class="id-link"><a href="customer.php?id=<?php echo $row['cust_id']?>"><?php echo ucwords($row['name']);?></a></td>
                  <td><?php echo ucwords($row['payment_method']);?></td>
                </tr>
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
<?php require_once './templates/footer.php'; ?>