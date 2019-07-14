<?php 
 require_once('functions/loginandregister.php');

function setMessage($msg, $success = false)
{
	if (!empty($msg)) {
		$textClass = 'text-danger';
		if ($success) {
		 $textClass = 'text-success';
		}
		$_SESSION['message'] = "<div class='$textClass container text-center'>$msg</div>";
		// die($_SESSION['message']);
	} else{
		$msg = '';
	}
}

function displayMessage($check = false)
{
	if (isset($_SESSION['message'])) {
		echo "{$_SESSION['message']}";
		unset($_SESSION['message']);
	}
}

function checkIfMessage()
{
	if (isset($_SESSION['message'])) {
		return true;
	}   else {
		return false;
	}
}

function compareStrings($s1, $s2) {
	// PHP code to check if a string is 
	// substring of other 
	// $s1 = "geeksforgeeks"; 
	// $s2 = "geeks"; 
	if (strpos($s1, $s2) >= 0 && 
		strpos($s1, $s2) < strlen($s1)) 
		return true;
	else
		return false;
}
//helper functions
function redirect($location){
	//FIXME
	/*if (compareStrings($_SERVER['REQUEST_URI'], 'admin')) {
		header("Location: ../$location");
	} else {*/
		// header("Location: $location"); //prod
		// $location = '/online-fashion-store/'+$location;//dev mac
		header("Location: $location"); //dev mac
	// }
}


function query($sql)
{
	global $connection;
	return mysqli_query($connection, $sql);
}

function confirm($result)
{
	global $connection;
	if (!$result) {
		die("Query failed". mysqli_error($connection));
	}
}

function escape_string($string)
{
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}

function fetch_obj($result)
{
	return mysqli_fetch_object($result);
}

function fetch_array($result) //assoc
{
	return mysqli_fetch_assoc($result);
}


/****************FRONT END FUNCTIONS*********************************/
//dynamic menu
function custom_dyn_menu()
{
	$main_array = get_cat_for_nav();
	$parent_array = $main_array['parent_menu'];
	$sub_array = $main_array['sub_menu'];
	$menu = "";
	foreach ($parent_array as $pkey => $pval) {

		if (!empty($pval['count'])) {
			$menu.='<li class="has-children">
			<a href="category.php?id='.$pval["id"].'">'.$pval["label"].'</a>
			<ul class="dropdown">';
			$smenu = "";
			foreach ($sub_array[$pkey] as $sobj) {
				$smenu.='<li><a href="category.php?id='.$sobj['id'].'">'.$sobj['label'].'</a></li>';
			}
			$menu.=$smenu.'</ul></li>';
		} else {
			$menu.='<li><a href="category.php?id='.$pval["id"].'">'.$pval["label"].'</a></li>';
		}


	}
	return $menu;
}

//get products
function get_products()
{
	$res = query("SELECT * FROM products");
	confirm($res);
	while ($row = fetch_array($res)) {
		$product = '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id='.$row['product_id'].'"><img src="images/'.$row['product_image'].'" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id='.$row['product_id'].'">'.$row['product_title'].'</a></h3>
                    <p class="mb-0">'.$row['product_short_desc'].'</p>
                    <p class="text-primary font-weight-bold">$'.$row['product_price'].'</p>
                    <p><a href="shop-single.php?id='.$row['product_id'].'" class="btn btn-primary btn-sm">View Details</a></p>
                  </div>
                </div>
              </div>';
		echo $product;					
	}
}

function get_products_in_cat_page()
{
	$res = query("SELECT * FROM products WHERE product_category_id=".escape_string($_GET['id']));
	confirm($res);
	while ($row = fetch_array($res)) {
		$product = '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id='.$row['product_id'].'"><img src="images/'.$row['product_image'].'" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id='.$row['product_id'].'">'.$row['product_title'].'</a></h3>
                    <p class="mb-0">'.$row['product_short_desc'].'</p>
                    <p class="text-primary font-weight-bold">$'.$row['product_price'].'</p>
                    <p><a href="shop-single.php?id='.$row['product_id'].'" class="btn btn-primary btn-sm">View Details</a></p>
                  </div>
                </div>
              </div>';
		echo $product;					
	}
}

//categories for nav
function get_cat_for_nav()
{
	$parent_menu = array();
	$sub_menu = array();

	$query = "SELECT * FROM categories ORDER BY parent_id, id ASC";
	$send_query = query($query);
	confirm($send_query);

	while ($obj = fetch_obj($send_query)) {
		if ($obj->parent_id == 0) {
			$parent_menu[$obj->id]['id'] = $obj->id;
			$parent_menu[$obj->id]['label'] = $obj->label;
			$parent_menu[$obj->id]['link'] = $obj->link_url;
		} else {
			// $sub_menu[$obj->id]['parent'] = $obj->parent_id;
			$sub_menu[$obj->parent_id][$obj->id]['id'] = $obj->id;
			$sub_menu[$obj->parent_id][$obj->id]['label'] = $obj->label;
			$sub_menu[$obj->parent_id][$obj->id]['link'] = $obj->link_url;
			if (empty($parent_menu[$obj->parent_id]['count'])) {
				$parent_menu[$obj->parent_id]['count'] = 0;
			}
			$parent_menu[$obj->parent_id]['count']++;
		}
	}
	return ['parent_menu' => $parent_menu, 'sub_menu' => $sub_menu];
}

//sidebar with cats
function site_dyn_cats()
{
	$main_array = get_cat_for_nav();
	$parent_array = $main_array['parent_menu'];
	$sub_array = $main_array['sub_menu'];
	foreach ($parent_array as $pkey => $pval) {
	echo '<li class="mb-1"><a href="category.php?id='.$pval["id"].'" class="d-flex"><span>'.$pval["label"].'</span> <span class="text-black ml-auto">(2,220)</span></a></li>';

	}
}

function send_message()
{
	
	if (isset($_POST['submit'])) {
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/
		$to = "anandkashyap60@gmail.com";
		$name = $_POST['c_fname']." ".$_POST['c_lname'];
		$email = $_POST['c_email'];
		$subject = $_POST['c_subject'];
		$message = $_POST['c_message'];

		$headers = "From: {$name} {$email}";
		$res = mail($to, $subject, $message, $headers);
		if (!$res) {
			echo "ERROR";
		} else {
			echo "SENT";
		}
		// redirect('contact.php');
				
		/*$username = escape_string($_POST['username']);
		$userpass = escape_string($_POST['userpass']);
		// die($username);
		$query = query("SELECT * FROM users WHERE user_name='{$username}' AND password='{$userpass}'");
		confirm($query);
		if (mysqli_num_rows($query) == 0) {
			set_message('username/password combination does not exist');
		} else {
			// $username = strtolower($username);
			// $username = ucfirst($username);
			set_message("Welcome to admin panel {$username}");
			redirect('admin');
		}*/
		
	}
}


/****************BACK END FUNCTIONS*********************************/

?>