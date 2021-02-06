<?php
require_once 'template/header.php';
unset($_SESSION["admin"]);

header("Location:?modules=common");
?>