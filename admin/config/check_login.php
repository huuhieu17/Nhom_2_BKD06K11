<?php 
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
	header('Location:?modules=common&action=login');
}
 ?>