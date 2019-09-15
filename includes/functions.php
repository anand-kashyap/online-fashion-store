<?php 
 require_once('functions/loginandregister.php');
 require_once('functions/cart.php');

/****************HELPER FUNCTIONS*********************************/

/* function for setting success/error message */
function setMessage($msg, $success = false)
{
	if (!empty($msg)) {
		$textClass = 'text-danger';
		if ($success) {
		 $textClass = 'text-success';
		}
		$_SESSION['message'] = "<div class='$textClass container text-center'>$msg</div>";
	} else{
		$msg = '';
	}
}

/* function for showing message */
function displayMessage($check = false)
{
	if (isset($_SESSION['message'])) {
		echo "{$_SESSION['message']}";
		unset($_SESSION['message']);
	}
}

/* function for checking if message is present in SESSION variable */
function checkIfMessage()
{
	if (isset($_SESSION['message'])) {
		return true;
	}   else {
		return false;
	}
}

/* function for comparing strings if second string is a substring of first string */
function compareStrings($str, $substr) {
	if (strpos($str, $substr) !== false)
		return true;
	else
		return false;
}

/* function for redirecting to a page */
function redirect($location){
		header("Location: $location");
}

/* function for making sql query to database */
function query($sql)
{
	global $connection;
	return mysqli_query($connection, $sql);
}

/* function for checking if ran sql query was successful */
function confirm($result)
{
	global $connection;
	if (!$result) {
		die("Query failed". mysqli_error($connection));
	}
}

/* function for getting last inserted auto incremented id after an insert operation in database */
function getLastInsertedId()
{
	global $connection;
	return mysqli_insert_id($connection);
}

/* function for escaping/sanitising input before making sql query in database */
function escapeString($string)
{
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}

/* function for fetching mysql result as an associative array */
function fetchArray($result)
{
	return mysqli_fetch_assoc($result);
}


/****************FRONT END FUNCTIONS*********************************/
/* function for dynamic category menu for top navbar */
function dynamicMenu($category, $parent = 0)
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
				$html .= dynamicMenu($category, $cat_id);
				$html .= "</ul></li>";
			}
		}
	}
	return $html;
}

/* function for getting products and apply filters if any */
function getProducts($admin = false, $orderBy = 'created', $orderDir = 'DESC', $offset = 0, $recordsPerPage = 10, $where = '')
{
	$qStr = "SELECT * FROM products";
	if (!$admin) {
		$qStr .= " $where ORDER BY $orderBy $orderDir LIMIT $offset, $recordsPerPage";
	}
	$res = query($qStr);
	confirm($res);
	if ($admin == true) {
		return $res;
	}
	while ($row = fetchArray($res)) {
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

/* function for searching products */
function searchProducts($searchTerm)
{
	$searchTerm = escapeString($searchTerm);
	$res = query("SELECT * FROM products WHERE product_title LIKE '%$searchTerm%' OR product_short_desc LIKE '%$searchTerm%'");
	confirm($res);
	$rowcount = mysqli_num_rows($res);
	echo "<div class='col-sm-12'><p>$rowcount result(s) found for search: <strong>$searchTerm</strong></p></div>";
	if ($rowcount > 0) {
		while ($row = fetchArray($res)) {
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

/* function for fetching categories */
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

/* function for fetching featured products */
function getFeaturedProducts()
{
	$sql = "SELECT * FROM products";
	$sql .= " WHERE is_featured=1";

	$featuredProds = query($sql);
	confirm($featuredProds);
	return $featuredProds;
}

/* function for getting all sizes of a product by its id from database */
function getProdSizesById($pId)
{
	$sizes = query("SELECT * FROM inventory WHERE product_id=$pId");
	confirm($sizes);
	return $sizes;
}

/* function for getting full size names from size codes */
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

/* function for getting a product by id from database */
function getProductById($id)
{
	$product = query("SELECT * FROM products WHERE product_id=".escapeString($id));
	confirm($product);
	$row = fetchArray($product);
	return $row;
}

/* function for getting a category by id from database */
function getCatById($id)
{
	$cat = query("SELECT * FROM categories WHERE id=".escapeString($id));
	confirm($cat);
	$row = fetchArray($cat);
	return $row;
}

/* function for getting all products in a category from database */
function getProductsInCat( $orderBy = 'created', $orderDir = 'DESC', $offset = 0, $recordsPerPage = 10, $filter = '')
{
	$catId = escapeString($_GET['id']);
	$orCond = "";
	$res = query("SELECT id from categories WHERE parent_id = $catId");
	confirm($res);
	while($childId = fetchArray($res)['id']) {
		$orCond .= "OR product_category_id=$childId ";
	}
	$qStr = "SELECT * FROM products WHERE (product_category_id=".$catId." $orCond)" .$filter;
	$qStr .= " ORDER by $orderBy $orderDir LIMIT $offset, $recordsPerPage";
	$res = query($qStr);
	
	confirm($res);
	while ($row = fetchArray($res)) {
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

/* function for getting categories for navbar from database */
function catsForNav()
{
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

/* function for getting categories for sidebar from database */
function siteDynCats()
{
	$category = catsForNav();
	$parent_array = $category['categories'];
	foreach ($parent_array as $pval) {
	$pCount = getCount('products', $pval['id']);
	echo '<li class="mb-1"><a href="category.php?id='.$pval["id"].'" class="d-flex"><span>'.$pval["label"].'</span> <span class="text-black ml-auto">('.$pCount.')</span></a></li>';

	}
}

/* function for getting a count of rows from table with filters if any from database */
function getCount($tablename, $catId)
{
	$orCond = "";
	$res = query("SELECT id from categories WHERE parent_id = $catId");
	confirm($res);
	while($childId = fetchArray($res)['id']) {
		$orCond .= "OR product_category_id=$childId ";
	}
	$qstr = "SELECT COUNT(*) FROM $tablename";
	$qstr .= " WHERE product_category_id=$catId $orCond";
	$query = query($qstr);
	confirm($query);
	return mysqli_fetch_array($query)[0];
}

/* function for sending a mail to admin email for contact us page */
function sendMessage()
{
	
	if (isset($_POST['submit'])) {
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
	}
}

/* function for placing an order of products */
function addOrder($productIds, $pMethod)
{
	$cust_id = getLoggedInUser()['user_id'];
	$valQuery = [];
	foreach ($productIds as $pId) {
		$valQuery[]= " ($cust_id, {$pId['id']}, {$pId['qty']}, '{$pId['size']}', '$pMethod')";
		$curQty = query("SELECT id, quantity FROM inventory WHERE product_id={$pId['id']} AND product_size='{$pId['size']}'");
		confirm($curQty);
		$resInv = fetchArray($curQty);
		$upQty = (int)$resInv['quantity'] - (int)$pId['qty'];
		$res = query("UPDATE inventory SET quantity=$upQty WHERE id=".$resInv['id']);
		confirm($res);
	}
	$order = query("INSERT INTO customer_order (cust_id, product_id, quantity, size, payment_method) VALUES ".join(", ",$valQuery));
	confirm($order);
}

/* function for getting list of my orders */
function getMyOrders()
{
	$cust_id = getLoggedInUser()['user_id'];
	$orders = query("SELECT ord.order_id, prod.product_title, prod.product_image, prod.product_price, ord.quantity, ord.order_date, ord.payment_method FROM customer_order AS ord JOIN users ON ord.cust_id=users.user_id JOIN products AS prod ON ord.product_id=prod.product_id WHERE ord.cust_id=$cust_id");
	confirm($orders);
	return $orders;
}

/* function for pagination */
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
		$total_pages_sql .= " WHERE $idColName=".escapeString($_GET['id']);
	}
	$result = query($total_pages_sql);
	confirm($result);
	$total_rows = mysqli_fetch_array($result)[0];
	$totalPages = ceil($total_rows / $recordsPerPage);
	return ['pageNo' => $pno, 'offset' => $offset, 'recordsPerPage' => $recordsPerPage, 'totalPages' => $totalPages];
}

/* function for setting current page number in pagination */
function setPageNum($page)
{
	$queryStr = $_SERVER['QUERY_STRING'];
	parse_str($queryStr, $vars);
	$vars['page'] = $page;
	return http_build_query($vars);
}

/* function for sorting products based on different values */
function sortProds()
{
	$orderBy = 'created'; $orderDir = 'DESC'; $sorted = 'Latest';
	if (isset($_GET['name'])) {
		$orderBy = 'product_title'; $orderDir = escapeString($_GET['name']);
		$sorted = 'Name, ';
		if (strtolower($_GET['name']) == 'asc') {
			$sorted .= 'A to Z';
		} elseif (strtolower($_GET['name']) == 'desc') {
			$sorted .= 'Z to A';
		}
	} elseif (isset($_GET['price'])) {
		$orderBy = 'product_price'; $orderDir = escapeString($_GET['price']);
		$sorted = 'Price, ';
		if (strtolower($_GET['price']) == 'asc') {
			$sorted .= 'low to high';
		} elseif (strtolower($_GET['price']) == 'desc') {
			$sorted .= 'high to low';
		}
	}
	return ['orderBy' => $orderBy, 'orderDir' => $orderDir, 'sorted' => $sorted];
}

/****************BACK END FUNCTIONS*********************************/
/* create dynamic menu for admin */
function dynMenuAdmin($category, $parent = 0)
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
				$html .= dynMenuAdmin($category, $cat_id);
				$html .= "</ul></li>";
			}
		}
	}
	return $html;
}

/* function for adding a new product in database */
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

/* function for adding a new category in database */
function addCat($title, $parentCat)
{
	$cat = query("INSERT INTO categories (label, parent_id) VALUES ('$title', $parentCat)");
	confirm($cat);
}

/* function for updating a product in database */
function updateProduct($title, $price, $shortDesc, $desc, $cat, $fname, $isFeatured)
{
	$pId = escapeString($_GET['id']);
	$product = query("UPDATE products SET product_title='$title', product_price=$price, product_short_desc='$shortDesc', product_description='$desc', product_category_id=$cat, product_image='$fname', is_featured=$isFeatured WHERE product_id=".$pId);
	confirm($product);
}

/* function for updating a category in database */
function updateCat($title, $parentCat)
{
	$cat = query("UPDATE categories SET label='$title', parent_id=$parentCat WHERE id=".escapeString($_GET['id']));
	confirm($cat);
}

/* function for updating a stock/inventory in database */
function updateStockById($qty)
{
	$stock = query("UPDATE inventory SET quantity='$qty' WHERE id=".escapeString($_GET['id']));
	confirm($stock);
}


/* function for deleting a product by id from database */
function deleteProductById($id)
{
	$product = query("DELETE FROM products WHERE product_id=".escapeString($id));
	confirm($product);
}

/* function for deleting a category by id from database */
function deleteCatById($id)
{
	$cat = query("DELETE FROM categories WHERE id=".escapeString($id));
	confirm($cat);
}

/* function for getting all orders of all customers from database */
function getAllOrders($from = '', $to = '')
{
	$qstr = "SELECT ord.order_id, ord.size, prod.product_id, ord.cust_id, prod.product_title, prod.product_image, prod.product_price, ord.quantity, ord.order_date, ord.payment_method, users.name FROM customer_order AS ord JOIN users ON ord.cust_id=users.user_id JOIN products AS prod ON ord.product_id=prod.product_id";
	if (!empty($from) && !empty($to)) {
		$from = date_format(date_create($from), 'Y-m-d');
		$to = date_format(date_create($to), 'Y-m-d');
		$qstr .=  " WHERE ord.order_date>='$from' AND ord.order_date<='$to'";
	}
	$qstr .= " ORDER BY ord.order_date DESC";
	$orders = query($qstr);
	confirm($orders);
	return $orders;
}

/* function for getting all customers from database */
function getCustomers()
{
	$res = query("SELECT user_id, email, name, phone, country FROM users WHERE role='user'");
	confirm($res);
	return $res;
}

/* function for getting all inventory for products from database */
function getStock()
{
	$res = query("SELECT inv.*, pr.product_title, pr.product_image FROM inventory AS inv JOIN products AS pr ON inv.product_id = pr.product_id");
	confirm($res);
	return $res;
}

/* function for deleting a customer from database */
function deleteCustById($id)
{
	$cust = query("DELETE FROM users WHERE user_id=".escapeString($id));
	confirm($cust);
}

/* function for getting a customer from database */
function getCustById($id)
{
	$cust = query("SELECT user_name, email, name, company, phone, address, country FROM users WHERE user_id=".escapeString($id));
	confirm($cust);
	$row = fetchArray($cust);
	return $row;
}

/* function for getting a product's stock from database */
function getStockById($id)
{
	$stock = query("SELECT inv.*, pr.product_title, pr.product_image FROM inventory AS inv JOIN products AS pr ON inv.product_id = pr.product_id WHERE inv.id=".escapeString($id));
	confirm($stock);
	$row = fetchArray($stock);
	return $row;
}

/* function for updating a customer in database */
function updateCust($cData)
{
	$cat = query("UPDATE users SET user_name='".$cData['user_name']."', email='".$cData['email']."', name='".$cData['name']."', company='".$cData['company']."', phone='".$cData['phone']."', address='".$cData['address']."', country='".$cData['country']."' WHERE user_id=".escapeString($_GET['id']));
	confirm($cat);
}

/* function for adding a customer in database */
function addCust($cData)
{
	$product = query("INSERT INTO users (user_name, email, name, company, phone, address, country) VALUES "."('".implode("', '", $cData)."')");
	confirm($product);
}

/* get payment sticker color */
function getRoundedLabel($payStr) {
	switch ($payStr) {
		case $payStr == 'paypal':
			return 'label-purple';
			break;
		case $payStr == 'direct bank transfer':
			return 'label-info';
			break;
		case $payStr == 'cash on delivery':
			return 'label-success';
			break;
		
		default:
			return 'label-danger';
			break;
	}
}

/* get total sales of store */
function getTotalSales()
{
	$sales = query("SELECT SUM(ROUND(ord.quantity*prod.product_price, 2)) AS amount FROM customer_order AS ord JOIN products AS prod ON ord.product_id=prod.product_id");
	confirm($sales);
	return fetchArray($sales)['amount'];
}

/* get latest sales of store */
function getLatestSales()
{
	$res = query("SELECT ROUND(ord.quantity*prod.product_price, 2) AS price, ord.payment_method AS payment, prod.product_title AS name, ord.order_date AS date FROM customer_order AS ord JOIN products AS prod ON ord.product_id=prod.product_id ORDER BY date desc");
	confirm($res);
	return $res;
}

?>