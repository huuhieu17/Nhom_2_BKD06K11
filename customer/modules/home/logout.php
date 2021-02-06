<?php
require_once('customer/template/version1/header.php');
unset($_SESSION["user"]);
echo "<script>window.location.replace('?s=home');</script>";
?>