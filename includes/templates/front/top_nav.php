<div class="container">
	<div class="row align-items-center">

		<div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
			<form action="" class="site-block-top-search">
				<span class="icon icon-search2"></span>
				<input type="text" class="form-control border-0" placeholder="Search">
			</form>
		</div>

		<div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
			<div class="site-logo">
				<a href="index.php" class="js-logo-clone">Online Fashion Store</a>
			</div>
		</div>

		<div class="col-6 col-md-4 order-3 order-md-3 text-right">
			<div class="site-top-icons">
				<ul>
					<?php if(isLoggedIn()) { ?>
						<li id="user-icon" class="dropdown">
							<a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon icon-person"><?php echo ucfirst(getLoggedInUser()['user_name']) ?></span></a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							    <a class="dropdown-item" href="#">My orders</a>
							    <a class="text-danger dropdown-item" href="logout.php">Logout</a>
							  </div>
						</li>
					<?php } else { ?>
						<li><a href="login.php">Login</a></li>
					<?php } ?>
					<li><a href="#"><span class="icon icon-heart-o"></span></a></li>
					<li>
						<a href="cart.php" class="site-cart">
							<span class="icon icon-shopping_cart"></span>
							<span class="count">2</span>
						</a>
					</li> 
					<li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
				</ul>
			</div> 
		</div>
	</div>
</div>
