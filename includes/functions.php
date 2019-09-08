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
function getProducts($admin = false, $orderBy = 'created', $orderDir = 'DESC', $offset = 0, $recordsPerPage = 10, $where = '')
{
	$qStr = "SELECT * FROM products";
	if (!$admin) {
		$qStr .= " $where ORDER BY $orderBy $orderDir LIMIT $offset, $recordsPerPage";
		// echo $qStr;
	}
	$res = query($qStr);
	confirm($res);
	if ($admin == true) {
		return $res;
	}
	while ($row = fetch_array($res)) {
		$product = '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border full-tile">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id='.$row['product_id'].'"><img src="images/'.$row['product_image'].'" alt="Image placeholder" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id='.$row['product_id'].'">'.$row['product_title'].'</a></h3>
                    <p class="mb-0">'.$row['product_short_desc'].'</p>
                    <p class="text-primary font-weight-bold">$'.$row['product_price'].'</p>
									</div>
									<p><a href="shop-single.php?id='.$row['product_id'].'" class="btn btn-primary btn-sm">View Details</a></p>
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

function updateProduct($title, $price, $shortDesc, $desc, $cat, $fname, $isFeatured)
{
	$pId = escape_string($_GET['id']);
	$product = query("UPDATE products SET product_title='$title', product_price=$price, product_short_desc='$shortDesc', product_description='$desc', product_category_id=$cat, product_image='$fname', is_featured=$isFeatured WHERE product_id=".$pId);
	confirm($product);
}

function updateCat($title, $parentCat)
{
	$cat = query("UPDATE categories SET label='$title', parent_id=$parentCat WHERE id=".escape_string($_GET['id']));
	confirm($cat);
}

function updateStockById($qty)
{
	$stock = query("UPDATE inventory SET quantity='$qty' WHERE id=".escape_string($_GET['id']));
	confirm($stock);
}

function getProdSizesById($pId)
{
	$sizes = query("SELECT * FROM inventory WHERE product_id=$pId");
	confirm($sizes);
	return $sizes;
}

function getSize($scode)
{
	switch ($scode) {
		case $scode == 'sm':
			return 'Small';
			break;
		case $scode == 'md':
			return 'Medium';
			break;
		case $scode == 'lg':
			return 'Large';
			break;
                    
		default:
			return 'Extra-Large';
			break;
	}
}

function addProduct($title, $price, $shortDesc, $desc, $cat, $fname, $isFeatured)
{
	$product = query("INSERT INTO products (product_title, product_price, product_short_desc, product_description, product_category_id, product_image, is_featured) VALUES ('$title', $price, '$shortDesc', '$desc', $cat, '$fname', $isFeatured)");
	confirm($product);
	$pId = getLastInsertedId($product);
	$sizeArr = ['sm', 'md', 'lg', 'xl'];
	$vQuery = [];
	foreach ($sizeArr as $size) {
		$vQuery[] = " ('$pId', '$size', '100')";
	}
	$vQuery = implode(", ", $vQuery);
	$order = query("INSERT INTO inventory (product_id, product_size, quantity) VALUES $vQuery");
	confirm($order);
	return $pId;
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

function getProductsInCat( $orderBy = 'created', $orderDir = 'DESC', $offset = 0, $recordsPerPage = 10, $filter = '')
{
	$catId = escape_string($_GET['id']);
	$orCond = "";
	$res = query("SELECT id from categories WHERE parent_id = $catId");
	confirm($res);
	while($childId = fetch_array($res)['id']) {
		$orCond .= "OR product_category_id=$childId ";
	}
	$qStr = "SELECT * FROM products WHERE (product_category_id=".$catId." $orCond)" .$filter;
	$qStr .= " ORDER by $orderBy $orderDir LIMIT $offset, $recordsPerPage";
	$res = query($qStr);
	
	confirm($res);
	while ($row = fetch_array($res)) {
		$product = '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border full-tile">
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
	$pCount = getCount('products', $pval['id']);
	echo '<li class="mb-1"><a href="category.php?id='.$pval["id"].'" class="d-flex"><span>'.$pval["label"].'</span> <span class="text-black ml-auto">('.$pCount.')</span></a></li>';

	}
}

function getCount($tablename, $catId)
{
	$orCond = "";
	$res = query("SELECT id from categories WHERE parent_id = $catId");
	confirm($res);
	while($childId = fetch_array($res)['id']) {
		$orCond .= "OR product_category_id=$childId ";
	}
	$qstr = "SELECT COUNT(*) FROM $tablename";
	$qstr .= " WHERE product_category_id=$catId $orCond";
	$query = query($qstr);
	confirm($query);
	return mysqli_fetch_array($query)[0];
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

function addOrder($productIds, $pMethod)
{
	$cust_id = getLoggedInUser()['user_id'];
	$valQuery = "";
	foreach ($productIds as $pId) {
		$valQuery .= " ($cust_id, $pId, 1, '$pMethod')";
	}
	$order = query("INSERT INTO customer_order (cust_id, product_id, quantity, payment_method) VALUES $valQuery");
	confirm($order);
}

function getMyOrders()
{
	$cust_id = getLoggedInUser()['user_id'];
	$orders = query("SELECT ord.order_id, prod.product_title, prod.product_image, prod.product_price, ord.quantity, ord.order_date, ord.payment_method FROM customer_order AS ord JOIN users ON ord.cust_id=users.user_id JOIN products AS prod ON ord.product_id=prod.product_id WHERE ord.cust_id=$cust_id");
	confirm($orders);
	return $orders;
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

function getAllOrders()
{
	$orders = query("SELECT ord.order_id, prod.product_id, ord.cust_id, prod.product_title, prod.product_image, prod.product_price, ord.quantity, ord.order_date, ord.payment_method, users.name FROM customer_order AS ord JOIN users ON ord.cust_id=users.user_id JOIN products AS prod ON ord.product_id=prod.product_id ORDER BY ord.order_id");
	confirm($orders);
	return $orders;
}

function getCustomers()
{
	$res = query("SELECT user_id, email, name, phone, country FROM users WHERE role='user'");
	confirm($res);
	return $res;
}

function getStock()
{
	$res = query("SELECT inv.*, pr.product_title, pr.product_image FROM inventory AS inv JOIN products AS pr ON inv.product_id = pr.product_id");
	confirm($res);
	return $res;
}

function deleteCustById($id)
{
	$cust = query("DELETE FROM users WHERE user_id=".escape_string($id));
	confirm($cust);
}

function getCustById($id)
{
	$cust = query("SELECT user_name, email, name, company, phone, address, country FROM users WHERE user_id=".escape_string($id));
	confirm($cust);
	$row = fetch_array($cust);
	return $row;
}

function getStockById($id)
{
	$stock = query("SELECT inv.*, pr.product_title, pr.product_image FROM inventory AS inv JOIN products AS pr ON inv.product_id = pr.product_id WHERE inv.id=".escape_string($id));
	confirm($stock);
	$row = fetch_array($stock);
	return $row;
}

function updateCust($cData)
{
	$cat = query("UPDATE users SET user_name='".$cData['user_name']."', email='".$cData['email']."', name='".$cData['name']."', company='".$cData['company']."', phone='".$cData['phone']."', address='".$cData['address']."', country='".$cData['country']."' WHERE user_id=".escape_string($_GET['id']));
	confirm($cat);
}

function addCust($cData)
{
	$product = query("INSERT INTO users (user_name, email, name, company, phone, address, country) VALUES "."('".implode("', '", $cData)."')");
	confirm($product);
}

function paginatedResults($tableName, $recordsPerPage = 10, $idColName = '')
{
	if (isset($_GET['page']) && is_numeric($_GET['page'])) {
		$pno = $_GET['page'];
	} else {
		$pno = 1;
	}
	$offset = ($pno-1) * $recordsPerPage; 
	$total_pages_sql = "SELECT COUNT(*) FROM $tableName";
	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$total_pages_sql .= " WHERE $idColName=".escape_string($_GET['id']);
	}
	$result = query($total_pages_sql);
	confirm($result);
	$total_rows = mysqli_fetch_array($result)[0];
	$totalPages = ceil($total_rows / $recordsPerPage);
	return ['pageNo' => $pno, 'offset' => $offset, 'recordsPerPage' => $recordsPerPage, 'totalPages' => $totalPages];
}

function setPageNum($page)
{
	$queryStr = $_SERVER['QUERY_STRING'];
	parse_str($queryStr, $vars);
	$vars['page'] = $page;
	return http_build_query($vars);
}

function sortProds()
{
	$orderBy = 'created'; $orderDir = 'DESC'; $sorted = 'Latest';
	if (isset($_GET['name'])) {
		$orderBy = 'product_title'; $orderDir = escape_string($_GET['name']);
		$sorted = 'Name, ';
		if (strtolower($_GET['name']) == 'asc') {
			$sorted .= 'A to Z';
		} elseif (strtolower($_GET['name']) == 'desc') {
			$sorted .= 'Z to A';
		}
	} elseif (isset($_GET['price'])) {
		$orderBy = 'product_price'; $orderDir = escape_string($_GET['price']);
		$sorted = 'Price, ';
		if (strtolower($_GET['price']) == 'asc') {
			$sorted .= 'low to high';
		} elseif (strtolower($_GET['price']) == 'desc') {
			$sorted .= 'high to low';
		}
	}
	return ['orderBy' => $orderBy, 'orderDir' => $orderDir, 'sorted' => $sorted];
}
?>