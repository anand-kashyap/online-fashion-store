<?php 

function setUserAsLoggedIn($userArr) {
	if (!empty($userArr)) {
		$_SESSION['user'] = $userArr;
	} else{
		$userArr = [];
	}
}

function getLoggedInUser() {
	if (isset($_SESSION['user'])) {
		//FIXME
		print_r($_SESSION['user']);
	} else{
		set_message('Please login first');
		redirect('login.php');
	}
}

function login_user() {
	if (isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$userpass = escape_string($_POST['userpass']);
		// die($username);
		$query = query("SELECT * FROM users WHERE user_name='{$username}' AND password='{$userpass}'");
		confirm($query);
		if (mysqli_num_rows($query) == 0) {
			set_message('username/password combination does not exist');
			redirect('login.php');
		} else {
			while ($row = fetch_array($query)) {
				setUserAsLoggedIn($row);
			}
			set_message("Welcome to admin panel {$username}");
			redirect('admin');
			// redirect('admin');
		}
		
	}
}

function register_user() {
	if (isset($_POST['submit_register'])) {
		$username = escape_string($_POST['username']);
		$useremail = escape_string($_POST['useremail']);
		$userpass = escape_string($_POST['userpass']);
		// die($username);
		// die($useremail);
		// die($userpass);
		$query = query("INSERT INTO `users` (`user_name`, `email`, `password`) VALUES ('{$username}', '{$useremail}', '{$userpass}')");
		confirm($query);
		
	}
}

 ?>