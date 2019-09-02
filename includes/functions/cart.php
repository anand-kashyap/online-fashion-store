<?php 
function addToCart($ajax = false)
{
  $key = $ajax ? 'addByajax': 'add';
  // unset($_SESSION['cart']);
  if (isset($_GET[$key])) {
    $newProductId = escape_string($_GET[$key]);
    if (isset($_SESSION['cart'])) {
      array_push($_SESSION['cart'], $newProductId);
    } else {
      $_SESSION['cart'] = [$newProductId];
    }
    if (!$ajax) {
      header('Location: cart.php');
    } else {
      return count($_SESSION['cart']);
    }
  }
}

function removeFromCart()
{
  if (isset($_GET['remove'])) {
    $remProductId = escape_string($_GET['remove']);
    if (isset($_SESSION['cart'])) {
      $index = array_search($remProductId, $_SESSION['cart']);
      array_splice($_SESSION['cart'], $index, 1);
      header('Location: cart.php');
    }
  }
}

function getCartProductsDetail() {
  if (isset($_SESSION['cart'])) {
    
    $prodIds = $_SESSION['cart'];
    $whereCondArr = [];
    foreach ($prodIds as $key => $prodId) {
      $whereCondArr[] = "product_id=$prodId";
    }
    if (count($whereCondArr) > 0) {
      $product = query("SELECT * FROM products WHERE ". join(" OR ", $whereCondArr));
      confirm($product);
      return $product;
      
    } else {
      return false;
    }
  } else {
    return false;
  } 
}

?>