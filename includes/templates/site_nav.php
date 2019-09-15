<div class="container">
	<ul class="site-menu js-clone-nav d-none d-md-block">
		<?php
		$category = catsForNav();
		echo dynamicMenu($category);
		?>
		<li><a href="shop.php">Shop</a></li>
		<li class="">
			<a href="about.php">About</a>
		</li>
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>