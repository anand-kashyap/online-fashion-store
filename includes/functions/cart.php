<?php
function addToCart()
{
  // unset($_SESSION['cart']);
  $newProductId = $_POST['addByajax'];
  $size = $_POST['size'];
  $qty = $_POST['qty'];
  if (isset($_SESSION['cart'])) {
    // print_r($_SESSION['cart']);
    if (isset($_SESSION['cart'][$newProductId])) {
      if (isset($_SESSION['cart'][$newProductId][$size])) { //size present
        $sQty = (int)$_SESSION['cart'][$newProductId][$size] + $qty;
        if ($sQty < 6) {
          $_SESSION['cart'][$newProductId][$size] = $sQty;
          return getProdCount();
        }
        return 'Cannot add more than 5 products of same size';
      }
    }
  }
  $_SESSION['cart'][$newProductId][$size] = $qty;
  return getProdCount();
} 

function getProdCount()
{
  $arr = $_SESSION['cart'];
  $count = 0;
  foreach ($arr as $secLevel) {
    $count = $count + count($secLevel);
  }
  return $count;
}
/* function addToCart($ajax = false)
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
} */

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
  // unset($_SESSION['cart']);
  if (isset($_SESSION['cart'])) {
    
    $prodIds = $_SESSION['cart'];
    $whereCondArr = [];
    foreach ($prodIds as $prodId => $sizeQty) {
      $whereCondArr[] = "product_id=$prodId";
    }
    if (count($whereCondArr) > 0) {
      $product = query("SELECT * FROM products WHERE ". join(" OR ", $whereCondArr));
      confirm($product);
      // print_r(fetch_array($product)); die;
      $cartProds = [];
      while ($row = fetch_array($product)) {
        $prodArr = $_SESSION['cart'][$row['product_id']];
        foreach ($prodArr as $size => $qty) {
          $cartProds[] = [
            'product_id' => $row['product_id'],
            'product_image' => $row['product_image'],
            'product_title' => $row['product_title'],
            'product_price' => $row['product_price'],
            'size' => $size,
            'qty' => $qty
          ];
        }
      }
      return $cartProds;
      
    } else {
      return false;
    }
  } else {
    return false;
  } 
}

?>