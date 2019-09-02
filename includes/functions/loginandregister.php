<?php 

function setUserAsLoggedIn($userArr) {
	if (!empty($userArr)) {
		$_SESSION['user'] = $userArr;
	} else{
		$userArr = [];
	}
}

function checkLoggedInUser($needAdmin = false) {
	if (isset($_SESSION['user'])) {
		if ($needAdmin && $_SESSION['user']['role'] != 'admin') {
			setMessage('Need Admin account to access this page');
			// die($_SESSION['message']);
			redirect('../index.php');	
		}
	} else{
		setMessage('Please login first');
		if ($needAdmin) {
			redirect('../login.php');
		} else {
			redirect('login.php');
		}
	}
}

function getLoggedInUser() {
	if (isset($_SESSION['user'])) {
		return $_SESSION['user'];
	}	
}

function isLoggedIn() {
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}	
}

function isAdmin() {
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
		return true;
	} else {
		return false;
	}	
}

function loginUser() {
	if (isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$userpass = escape_string($_POST['userpass']);
		// die($username);
		$query = query("SELECT user_id, role, user_name, email FROM users WHERE user_name='{$username}' AND password='{$userpass}'");
		confirm($query);
		if (mysqli_num_rows($query) == 0) {
			setMessage('username/password combination does not exist');
			redirect('login.php');
		} else {
			while ($row = fetch_array($query)) {
				setUserAsLoggedIn($row);
				if ($row['role'] == 'admin') {
					// setMessage("Welcome to admin panel $username");
					redirect('admin');
				} else {
					redirect(HOME);
				}
			}
			// redirect('admin');
		}
		
	}
}

function registerUser() {
	if (isset($_POST['submit_register'])) {
		$username = escape_string($_POST['username']);
		$useremail = escape_string($_POST['useremail']);
		$userpass = escape_string($_POST['userpass']);
		$query = query("INSERT INTO `users` (`user_name`, `email`, `password`) VALUES ('{$username}', '{$useremail}', '{$userpass}')");
		confirm($query);
		unset($_POST['submit_register']);
		header("Location: signup.php");
		setMessage('User created successfully!', true);
	}
}

function getUserDetails() {
	if ($user = getLoggedInUser()) {
		$query = query("SELECT * FROM users WHERE user_id='".$user['user_id']."'");
		confirm($query);
			while ($row = fetch_array($query)) {
				return $row;
			}
	}
}

function updateUser() {
	if (isset($_POST['submit'])) {
		$userId = $_POST['userId'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$psw = $_POST['psw'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$country = strtolower($_POST['country']);
		$query = query("UPDATE users SET name='$name', email='$email', password='$psw', phone='$phone', address='$address', country='$country' WHERE user_id=".$userId);
		confirm($query);
		redirect('profile.php');
	}
}

 ?>