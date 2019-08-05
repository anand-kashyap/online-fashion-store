<?
if (isset($_POST['subId'])) {
  require_once '../includes/config.php';
  $cats = getCategories(true, $_POST['subId']);
  $rowcount=mysqli_num_rows($cats);
  if ($rowcount == 0) {
    echo '';
    return;
  }
  $html = '<ul>';
  while ($row = fetch_array($cats)) {
    $html .= '<li><a href="category.php?id='.$row['id'].'">'.$row['label'].'</a></li>';
  }
  $html .= '</ul>';
  echo $html;
  return;
}
?>
<?php require_once './templates/header.php'; ?>
<?php require_once './templates/top_nav.php'; ?>
<?php require_once './templates/left_sidebar.php'; ?>