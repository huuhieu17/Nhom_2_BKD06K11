<?php
require_once('customer/template/version1/header.php');
$subTitle = "Order History";
if (!isset($_SESSION['user']['id'])) {
	header("Location:?s=home");
}
$id_customer = $_SESSION['user']['id'];
$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' ";
$query = mysqli_query($connection,$sql);
?>
<style>
	.historyCart{
		width: 100%;
		height: 100vh;
	}
	.historyCart table{
		width: 80%;
		margin: auto;
	}
	.historyCart table,tr,td,th{
		border:1px solid #eee;
		border-collapse: collapse;
	}
</style>
<div class="historyCart">
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
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
			<td>Name</td>
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
<?php 
require_once('customer/template/version1/footer.php'); ?>