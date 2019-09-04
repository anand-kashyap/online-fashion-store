<div class="row">
  <div class="col-md-12 mb-5">
    <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
    <div class="d-flex">
      <div class=" dropdown mr-1 ml-md-auto btn-group">
        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown"><?php echo $sorted;?></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
          <a class="dropdown-item" href="<?php echo $cPage;?>">Latest</a>
          <a class="dropdown-item" href="<?php echo $cPage; echo isset($_GET['id']) ? '&': '?' ?>name=asc">Name, A to Z</a>
          <a class="dropdown-item" href="<?php echo $cPage; echo isset($_GET['id']) ? '&': '?'?>name=desc">Name, Z to A</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo $cPage; echo isset($_GET['id']) ? '&': '?'?>price=asc">Price, low to high</a>
          <a class="dropdown-item" href="<?php echo $cPage; echo isset($_GET['id']) ? '&': '?'?>price=desc">Price, high to low</a>
        </div>
      </div>
    </div>
  </div>
</div>