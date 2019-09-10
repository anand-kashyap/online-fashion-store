<?php 
require_once 'includes/config.php'; 
include TEMPLATE_FRONT.DS.'header.php'; 
?>
  <?php if(checkIfMessage()) { ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?php displayMessage(); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php } ?>
  <!-- BANNER HERE -->
    <div class="site-blocks-cover" style="background-image: url(images/hero_1.jpg);" data-aos="fade">
      <?php 
        include TEMPLATE_FRONT.DS.'home_banner.php'; 
       ?>
    </div>
  
    <? include TEMPLATE_FRONT.DS.'site_blocks.php'?>

    <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
            <a class="block-2-item" href="category.php?id=2">
              <figure class="image">
                <img src="images/women.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <span class="text-uppercase">Collections</span>
                <h3>Women</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" href="category.php?id=1">
              <figure class="image">
                <img src="images/men.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <span class="text-uppercase">Collections</span>
                <h3>Men</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- SLIDER HERE -->
    <div class="site-section block-3 site-blocks-2 bg-light">
      <?php 
        include TEMPLATE_FRONT.DS.'slider.php'; 
       ?>
    </div>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>We Curate, You Shop</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="images/blog_1.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="#">Min 30% Off! New Styles Added</a></h2>
            <p>Handpicked Favourites just for you. Be a class apart with these new styles</p>
            <p><a href="shop.php" class="btn btn-primary btn-sm">Shop Now</a></p>
          </div>
        </div>
      </div>
    </div>

<?php 
include TEMPLATE_FRONT.DS.'footer.php'; ?>
