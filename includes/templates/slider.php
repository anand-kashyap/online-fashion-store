<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7 site-section-heading text-center pt-4">
			<h2>Featured Products</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="nonloop-block-3 owl-carousel">
				<?php 
				$res = getFeaturedProducts();
				while ($row = fetchArray($res)) {?>
				<div class="item">
					<div class="block-4 text-center">
						<figure class="block-4-image">
							<img src="images/<?php echo $row['product_image']?>" alt="Image placeholder" class="img-fluid">
						</figure>
						<div class="block-4-text p-4">
							<h3><a href="shop-single.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_title'] ?></a></h3>
							<p class="mb-0"><?php echo $row['product_short_desc']?></p>
							<p class="text-primary font-weight-bold">$<?php echo $row['product_price']?></p>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>