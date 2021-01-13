<?php 
$s = $action = "";
if (isset($_GET['s'])) {
	$s = $_GET['s'];
}
if (isset($_GET['act'])) {
	$action = $_GET['act'];
}
if ($s == "" || $action == "") {
	$s = "home";
	$action = "home";
}
$path ="customer/modules/$s/$action.php";
if (file_exists($path)){
	require_once('customer/config/config.php');
	require_once("customer/config/session.php");
	require_once('customer/template/header.php');
	require_once($path); 
	require_once('customer/template/footer.php');
}else{
	$path = "customer/modules/home/404.php";
	require_once($path);
}
?>
