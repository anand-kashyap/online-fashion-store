<div class="container">
	<div class="row align-items-center">

		<div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
			<p class="site-block-top-search">
				<span class="icon icon-search2"></span>
				<input type="text" class="form-control border-0"
				<?php 
				if (isset($_GET['q'])) {
					echo "value='".$_GET['q']."'";
				}
				?>
				placeholder="Search" id="search-input">
			</p>
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
								<?php if (isAdmin()) { ?>
									<a class="dropdown-item" href="admin">Admin panel</a>
								<?php } else { ?>
									<a class="dropdown-item" href="orders.php">My orders</a>
									<a class="dropdown-item" href="profile.php">My Profile</a>
								<?php } ?>
							    <a class="text-danger dropdown-item" onclick="logout()">Logout</a>
							  </div>
						</li>
					<?php } else { ?>
						<li><a href="login.php">Login</a></li>
					<?php } ?>
					<li>
						<a href="cart.php" class="site-cart">
							<span class="icon icon-shopping_cart"></span>
							<span id="cart-count" class="count d-none"></span>
						</a>
					</li> 
					<li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
				</ul>
			</div> 
		</div>
	</div>
</div>
<script>
function logout() {
	localStorage.clear();
	document.location = 'logout.php';
}
</script>
