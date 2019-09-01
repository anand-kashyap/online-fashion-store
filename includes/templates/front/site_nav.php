<div class="container">
	<ul class="site-menu js-clone-nav d-none d-md-block">
		<?php
		$category = get_cat_for_nav();
		echo custom_dyn_menu($category);
		?>
		<li class="">
			<a href="about.php">About</a>
		</li>
		<li><a href="shop.php">Shop</a></li>
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>