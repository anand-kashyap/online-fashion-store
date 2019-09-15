<?php 
/* function for setting user as logged in */
function setUserAsLoggedIn($userArr) {
	if (!empty($userArr)) {
		$_SESSION['user'] = $userArr;
	} else{
		$userArr = [];
	}
}

/* function for checking logged in user's role */
function checkLoggedInUser($needAdmin = false) {
	if (isset($_SESSION['user'])) {
		if ($needAdmin && $_SESSION['user']['role'] != 'admin') {
			setMessage('Need Admin account to access this page');
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

/* function for getting logged in user */
function getLoggedInUser() {
	if (isset($_SESSION['user'])) {
		return $_SESSION['user'];
	}	
}

/* function for checking if user has logged in */
function isLoggedIn() {
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}	
}

/* function for checking if loggedin user is admin */
function isAdmin() {
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
		return true;
	} else {
		return false;
	}	
}

/* function for logging in user */
function loginUser() {
	if (isset($_POST['submit'])) {
		$username = escapeString($_POST['username']);
		$userpass = escapeString($_POST['userpass']);
		$query = query("SELECT user_id, role, user_name, email FROM users WHERE user_name='{$username}' AND password='{$userpass}'");
		confirm($query);
		if (mysqli_num_rows($query) == 0) {
			setMessage('username/password combination does not exist');
			redirect('login.php');
		} else {
			while ($row = fetchArray($query)) {
				setUserAsLoggedIn($row);
				if ($row['role'] == 'admin') {
					redirect('admin');
				} else {
					redirect(HOME);
				}
			}
		}
		
	}
}

/* function for registering a new user */
function registerUser() {
	if (isset($_POST['submit_register'])) {
		$username = escapeString($_POST['username']);
		$useremail = escapeString($_POST['useremail']);
		$userpass = escapeString($_POST['userpass']);
		$query = query("INSERT INTO `users` (`user_name`, `email`, `password`) VALUES ('{$username}', '{$useremail}', '{$userpass}')");
		confirm($query);
		unset($_POST['submit_register']);
		header("Location: signup.php");
		setMessage('User created successfully!', true);
	}
}

/* function for getting a user's details */
function getUserDetails() {
	if ($user = getLoggedInUser()) {
		$query = query("SELECT * FROM users WHERE user_id='".$user['user_id']."'");
		confirm($query);
			while ($row = fetchArray($query)) {
				return $row;
			}
	}
}

/* function for updating a user */
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