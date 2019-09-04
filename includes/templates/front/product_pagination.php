<?php if ($paginArr['totalPages'] > 1) { ?>
  
<div class="row" data-aos="fade-up">
  <div class="col-md-12 text-center">
    <div class="site-block-27">
      <ul>
        <?php 
        if ($paginArr['pageNo'] > 1) { ?>
          <li><a href="<?php echo "?".setPageNum(1);?>">&lt;&lt;</a>
        <?php }?>
        <?php
        if ($paginArr['pageNo'] + 1 < $paginArr['totalPages']) {
          $pCount = $paginArr['pageNo'] + 1;
          $pStart = $paginArr['pageNo'] - 1;
          if ($pStart == 1) {
            $pCount = $pStart+2 < $paginArr['totalPages'] ? $pStart+2 : $paginArr['totalPages'];
          }
        } else {
          $pStart = $paginArr['pageNo'] - 1;
          $pCount = $paginArr['totalPages'];
        }
        if ($pStart < 1) {
          $pStart = 1;
        }
        for ($i=$pStart; $i <= $pCount; $i++) { 
          $pNum = $i ;
          echo "<li";
          if ($pNum == $paginArr['pageNo']) {
            echo " class='active' ";
          }
          echo "><a href='?".setPageNum($pNum)."'>$pNum</a></li>";
        }
        ?>
        <?php
        if ($paginArr['pageNo'] < $paginArr['totalPages']) { ?>
        <li><a href="<?php echo "?".setPageNum($paginArr['totalPages']);?>">&gt;&gt;</a>
        <?php }?>
      </ul>
    </div>
  </div>
</div>
<?php }?>