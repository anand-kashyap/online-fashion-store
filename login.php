<?php 
require_once 'includes/config.php'; 
include TEMPLATE_FRONT.DS.'header.php'; ?>
<div class="site-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="h3 mb-3 text-black text-center">Sign in to Your Account</h2>
			</div>
			<div class="col-md-8">

				<form action="" method="post">
					<?php login_user() ?>
					<div class="p-3 p-lg-5 border">
						<div class="form-group row">
							<div class="col-md-12">
								<label for="user_name" class="text-black">User Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="user_name" name="username" minlength="3"required>
							</div>
							<div class="col-md-12">
								<label for="user_pass" class="text-black">Password <span class="text-danger">*</span></label>
								<input type="password" class="form-control" id="user_pass" name="userpass" minlength="3" required >
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-12">
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
							</div>
						</div>
					</div>
				</form>
			</div>
          
  </div>
</div>


<?php include TEMPLATE_FRONT.DS.'footer.php'; ?>