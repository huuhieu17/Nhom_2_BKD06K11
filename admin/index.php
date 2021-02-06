<?php 


// module
error_reporting(0);	
$module = $action = "";
if (isset($_GET['modules'])) {
	$module = $_GET['modules'];
}
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

// if empty module action = login
if ($module == "" || $action== "") {
		$module = "common";
		$action = "login";
}
// check path
$path = "modules/$module/$action.php";
if (file_exists($path)) {
	require_once("config/session.php");
	if (isset($_SESSION['admin']) || $_SESSION['admin'] != "") {
		
		require_once($path);
		
	}else{
		require_once($path);
	}
	
}else{
	$path = "modules/common/404.php";
	require_once($path);
}
?>