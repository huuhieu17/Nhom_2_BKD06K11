<?php
require_once('customer/template/version1/header.php');
$subTitle = "Order History";
if (!isset($_SESSION['user']['id'])) {
	header("Location:?s=home");
}
$id_customer = $_SESSION['user']['id'];
$check1 = $check2 = $check3 = $check4 = $check5 = "";
if (isset($_POST['paid'])) {
	if ($_POST['paid'] == '1') {
		$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' AND status = 1 ORDER BY id DESC ";
		
		
		$check2 = "checked";
	}else
	if ($_POST['paid'] == '2') {
		$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' AND status = 2 ORDER BY id DESC ";
		$check3 = "checked";
	}else
	if ($_POST['paid'] == '3') {
		$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' AND status = 3 ORDER BY id DESC ";
		
		$check4 = "checked";
	}else
	if ($_POST['paid'] == '0') {
		$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' AND status = 0 ORDER BY id DESC ";
		
		$check5 = "checked";
	}else{	
		$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' AND status = 1 ORDER BY id DESC ";
		$check1 = "checked";
	}
	
}else{
	$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' ORDER BY id DESC";
}

$query = mysqli_query($connection,$sql);
?>
<style>
	.historyCart{
		width: 100%;
		height: 100vh;
	}
	.historyCart #cleft{
		width: 10%;
		float: left;
		border-right: 1px solid #eee;
	}
	.historyCart #cleft form{
		padding: 14px;
	}
	.historyCart #cright{
		width: 89%;
		float: left;
	}
	.historyCart #cright table{
		text-align: center;
		width: 100%;
	}
	.historyCart table,tr,td,th{
		border:1px solid #eee;
		border-collapse: collapse;
	}
	h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
</style>
<div class="historyCart">
	<h1>Order History</h1>
	<hr>
	<h4> Order History Information</h4>
	<div id="cleft">
		<form action="#" method="POST">
			<input type="radio" name="paid" <?php echo $check1 ?> value="">All <br>
			<input type="radio" name="paid" <?php echo $check2 ?> value="1">Pending <br>
			<input type="radio" name="paid" <?php echo $check3 ?> value="2">Approved <br>
			<input type="radio" name="paid" <?php echo $check4 ?> value="3">Completed <br>
			<input type="radio" name="paid" <?php echo $check5 ?> value="0">Cancelled <br>
		</form>
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>
</script>
		<script>
			$('input[name=paid]').change(function(){
    		 $('form').submit();

			});
		</script>
	</div>
	<div id="cright">
		<table>
		<tr>
			<th>Id</th>
			<th>Total Amount</th>
			<th>Time</th>
			<th>Receiver</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Status</th>
			<th></th>
		</tr>
		<?php foreach ($query as $row): ?>
			<tr>
			<td><?php echo $row['id'] ?></td>
			<td><?php echo $row['total_amounts'] ?></td>
			<td><?php echo $row['create_at'] ?></td>
			<td><?php echo $row['receiver'] ?></td>		
			<td><?php echo $row['phone'] ?></td>		
			<td><?php echo $row['address'] ?></td>
			<td>
				<?php 
					switch ($row['status']) {
						case '1':
							echo "Pending";
							break;
						case '2':
							echo "Approved";
							break;
						case '3':
							echo "Completed";
							break;
						case '0':
							echo "Cancelled";
							break;
						default:
							# code...
							break;
					}
				?>
			</td>
			<td><a href="?s=invoices&act=detail&id=<?php echo $row['id'] ?>">View Detail</a></td>		
			</tr>	
		<?php endforeach ?>
	</table>
	</div>
	
	
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>