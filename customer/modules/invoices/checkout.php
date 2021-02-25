<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Checkout";
?>
<div class="checkout">
	<?php if (!isset($_SESSION['user'])): ?>
		<?php header("Location:?s=home&act=login&error=1"); ?>
		<?php else: ?>
			<h1>Checkout</h1>
	<?php endif ?>
</div>