<?php 
require_once './template/header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM news WHERE id = '$id'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo 'Error';		
	}else{
		echo "<script>window.location.replace('?modules=news&action=manage')</script>";
	}
}else{
	echo "<script>window.location.replace('?modules=news&action=manage')</script>";
}
?>