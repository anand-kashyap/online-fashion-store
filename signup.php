<?php
require_once 'includes/config.php';
include TEMPLATE_FRONT . DS . 'header.php'; ?>
<div class="site-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="h3 mb-3 text-black text-center">Register Your Account</h2>
				<?php 
				/* error messages if any */
				displayMessage(); 
				?>
			</div>
			<div class="col-md-6 offset-md-3">
				<form action="" method="post">
					<div class="p-3 p-lg-5 border">
						<div class="form-group row">
							<div class="col-md-12">
								<label for="user_email" class="text-black">Email <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="user_email" autocomplete="new-email" name="useremail" minlength="3" required>
							</div>
							<div class="col-md-12 mt-4">
								<label for="user_name" class="text-black">User Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" autocomplete="new-user_name" id="user_name" name="username" minlength="3" required>
							</div>
							<div class="col-md-12 mt-4">
								<label for="user_pass" class="text-black">Password <span class="text-danger">*</span></label>
								<input type="password" autocomplete="new-password" class="form-control" id="user_pass" name="userpass" minlength="3" required>
							</div>
						</div>
						<div class="form-group mt-4 row">
							<div class="col-lg-12">
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign Up" name="submit_register">
								<p>Already a User? <a href="login.php">LOGIN</a> </p>
							</div>
						</div>
						<?php registerUser(); ?>
					</div>
				</form>
			</div>

		</div>
	</div>


	<?php include TEMPLATE_FRONT . DS . 'footer.php'; ?>