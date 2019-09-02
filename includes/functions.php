<?php 
 require_once('functions/loginandregister.php');
 require_once('functions/cart.php');

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

function compareStrings($str, $substr) {
	// PHP code to check if a string is 
	// substring of other 
	// $s1 = "geeksforgeeks"; 
	// $s2 = "geeks"; 
	if (strpos($str, $substr) !== false)
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

function getLastInsertedId()
{
	global $connection;
	return mysqli_insert_id($connection);
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
function custom_dyn_menu($category, $parent = 0)
{	
	$html = "";
	$url = $_SERVER['REQUEST_URI'];
	if (isset($category['parent_cats'][$parent])) {
		foreach ($category['parent_cats'][$parent] as $cat_id) {
			$href = "category.php?id=".$category['categories'][$cat_id]['id'];
			$activeClass = compareStrings($url, $href) ? 'active' : '';
			if (!isset($category['parent_cats'][$cat_id])) {
				$html .= "<li class='$activeClass'><a href='$href'>". $category['categories'][$cat_id]['label']."</a></li>";
			} else {
				$html .= "<li class='has-children $activeClass'><a href='$href'>". $category['categories'][$cat_id]['label'] . "</a>";
				$html .= "<ul class='dropdown'>";
				$html .= custom_dyn_menu($category, $cat_id);
				$html .= "</ul></li>";
			}
		}
	}
	return $html;
}

//get products
function getProducts($admin = false)
{
	$res = query("SELECT * FROM products");
	confirm($res);
	if ($admin == true) {
		return $res;
	}
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

//get products
function searchProducts($searchTerm)
{
	$searchTerm = filter_var($searchTerm, FILTER_SANITIZE_STRING);
	$res = query("SELECT * FROM products WHERE product_title LIKE '%$searchTerm%' OR product_short_desc LIKE '%$searchTerm%'");
	confirm($res);
	$rowcount = mysqli_num_rows($res);
	echo "<div class='col-sm-12'><p>$rowcount result(s) found for search: <strong>$searchTerm</strong></p></div>";
	if ($rowcount > 0) {
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
}

function getCategories($admin = false, $parentId = 0)
{
	$sql = "SELECT * FROM categories";
	if ($admin) {
		$sql .= " WHERE parent_id=$parentId";
	}
	$cats = query($sql);
	confirm($cats);
	return $cats;
}

function getFeaturedProducts()
{
	$sql = "SELECT * FROM products";
	$sql .= " WHERE is_featured=1";

	$featuredProds = query($sql);
	confirm($featuredProds);
	return $featuredProds;
}

function updateProduct($title, $price, $qty, $shortDesc, $desc, $cat, $fname, $isFeatured)
{
	$product = query("UPDATE products SET product_title='$title', product_price=$price, product_quantity=$qty, product_short_desc='$shortDesc', product_description='$desc', product_category_id=$cat, product_image='$fname', is_featured=$isFeatured WHERE product_id=".escape_string($_GET['id']));
	confirm($product);
}

function updateCat($title, $parentCat)
{
	$cat = query("UPDATE categories SET label='$title', parent_id=$parentCat WHERE id=".escape_string($_GET['id']));
	confirm($cat);
}

function addProduct($title, $price, $qty, $shortDesc, $desc, $cat, $fname, $isFeatured)
{
	$product = query("INSERT INTO products (product_title, product_price, product_quantity, product_short_desc, product_description, product_category_id, product_image, is_featured) VALUES ('$title', $price, $qty, '$shortDesc', '$desc', $cat, '$fname', $isFeatured)");
	confirm($product);
}

function addCat($title, $parentCat)
{
	$cat = query("INSERT INTO categories (label, parent_id) VALUES ('$title', $parentCat)");
	confirm($cat);
}

function getProductById($id)
{
	$product = query("SELECT * FROM products WHERE product_id=".escape_string($id));
	confirm($product);
	$row = fetch_array($product);
	return $row;
}

function getCatById($id)
{
	$cat = query("SELECT * FROM categories WHERE id=".escape_string($id));
	confirm($cat);
	$row = fetch_array($cat);
	return $row;
}

function deleteProductById($id)
{
	$product = query("DELETE FROM products WHERE product_id=".escape_string($id));
	confirm($product);
}

function deleteCatById($id)
{
	$cat = query("DELETE FROM categories WHERE id=".escape_string($id));
	confirm($cat);
}

function getProductsInCat()
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
	// $parent_menu = array();
	// $sub_menu = array();

	$query = "SELECT * FROM categories ORDER BY parent_id, label ASC";
	$send_query = query($query);
	confirm($send_query);
	//create a multidimensional array to hold a list of category and parent category
	$category = array(
		'categories' => array(),
		'parent_cats' => array()
	);

	//build the array lists with data from the category table
	while ($row = mysqli_fetch_assoc($send_query)) {
		//creates entry into categories array with current category id ie. $categories['categories'][1]
		$category['categories'][$row['id']] = $row;
		//creates entry into parent_cats array. parent_cats array contains a list of all categories with children
		$category['parent_cats'][$row['parent_id']][] = $row['id'];
	}
	return $category;
}

//sidebar with cats
function site_dyn_cats()
{
	$category = get_cat_for_nav();
	$parent_array = $category['categories'];
	foreach ($parent_array as $pval) {
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

function addOrder($productIds)
{
	$cust_id = getLoggedInUser()['user_id'];
	$valQuery = "";
	foreach ($productIds as $pId) {
		$valQuery .= " ($cust_id, $pId, 1)";
	}
	$order = query("INSERT INTO customer_order (cust_id, product_id, quantity) VALUES $valQuery");
	confirm($order);
}


/****************BACK END FUNCTIONS*********************************/
//dynamic menu
function dyn_menu_admin($category, $parent = 0)
{	
	$html = "";
	if (isset($category['parent_cats'][$parent])) {
		foreach ($category['parent_cats'][$parent] as $cat_id) {
			$href = "category.php?id=".$category['categories'][$cat_id]['id'];
			$dhref = "category.php?delete=".$category['categories'][$cat_id]['id'];
			if (!isset($category['parent_cats'][$cat_id])) {
				$html .= "<li>". $category['categories'][$cat_id]['label']." <a href='$href' class='label label-success label-rounded'>Edit</a> <a href='$dhref' class='label label-danger label-rounded'>Delete</a></li>";
			} else {
				$html .= "<li class='has-children' >". $category['categories'][$cat_id]['label'] . " <a href='$href' class='label label-success label-rounded'>Edit</a> <a href='$dhref' class='label label-danger label-rounded'>Delete</a>";
				$html .= "<ul class='dropdown'>";
				$html .= dyn_menu_admin($category, $cat_id);
				$html .= "</ul></li>";
			}
		}
	}
	return $html;
}

?>