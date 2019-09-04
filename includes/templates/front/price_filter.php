<div class="mb-4">
  <form action="" method="post">
    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
    <div id="slider-range" class="border-primary"></div>
    <input type="text" readonly="readonly" name="priceRange" id="amount" class="form-control border-0 pl-0 bg-white"/>
    <input type="hidden" id="lowerLimit" value="<?php echo $priceLower;?>">
    <input type="hidden" id="upperLimit" value="<?php echo $priceUpper;?>">
    <button name="priceFilter" class="btn-sm btn-primary">Apply filter</button>
    <?php
    if (isset($_POST['priceFilter'])) { ?>
    <button onclick="window.location=<?php echo $cPage;?>" id="resetprice" class="btn-sm btn-outline-primary">Reset</button>
    <?php }
    ?>
  </form>
</div>