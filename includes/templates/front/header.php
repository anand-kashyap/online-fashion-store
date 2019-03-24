<?php 
$page_title = 'Online Fashion Store &mdash; e-Commerce Website';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">  -->
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  

<!-- NAVBAR -->
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <?php 
          include TEMPLATE_FRONT.DS.'top_nav.php'; 
         ?>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <?php 
          include TEMPLATE_FRONT.DS.'site_nav.php'; 
         ?>
      </nav>
    </header>
