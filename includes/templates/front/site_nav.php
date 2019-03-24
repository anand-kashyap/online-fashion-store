<div class="container">
	<ul class="site-menu js-clone-nav d-none d-md-block">
		<?php
		echo custom_dyn_menu();
		?>
		<li class="has-children active">
			<a href="index.php">Home</a>
			<ul class="dropdown">
				<li><a href="#">Menu One</a></li>
				<li><a href="#">Menu Two</a></li>
				<li><a href="#">Menu Three</a></li>
				<li class="has-children">
					<a href="#">Sub Menu</a>
					<ul class="dropdown">
						<li><a href="#">Menu One</a></li>
						<li><a href="#">Menu Two</a></li>
						<li><a href="#">Menu Three</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li class="has-children">
			<a href="about.php">About</a>
			<ul class="dropdown">
				<li><a href="#">Menu One</a></li>
				<li><a href="#">Menu Two</a></li>
				<li><a href="#">Menu Three</a></li>
			</ul>
		</li>
		<li><a href="shop.php">Shop</a></li>
		<li><a href="#">Catalogue</a></li>
		<li><a href="#">New Arrivals</a></li>
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>