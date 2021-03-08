<?php 
require_once 'template/header.php';
$sql = "SELECT * FROM invoices";
$filter = "";
if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	switch ($filter) {
		case 0:
					// code...
		$sql = $sql ."";
		break;
				case 1://pending
				$sql = $sql." WHERE status = 1";
				break;
				case 2://approved
				$sql = $sql." WHERE status = 2";
				break;
				case 3://complete
				$sql = $sql." WHERE status = 2";
				break;
				case 4://cancelled
				$sql = $sql." WHERE status = 0";
				break;
				default:
					// code...
				break;
			}	
		}
		if (!isset($_GET['page'])) {
			$present_page = 1;
		}else{
			$present_page = $_GET['page'];
		}
		$num1 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 1"));
		$num2 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 2"));
		$num3 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 3"));
		$num4 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 0"));
		$query = mysqli_query($connection,$sql);
		$totalInvoices = mysqli_num_rows($query);
		$limit = 20;
		$totalPage = ceil($totalInvoices/$limit);
		$skip = ($present_page - 1)*$limit;
		$sql = $sql. " ORDER BY id DESC LIMIT $limit OFFSET $skip";
		$query = mysqli_query($connection,$sql);
		?>
		<style>
			a.nav{
				color: gray;
				font-weight: bold;
			}
			#contents{
				height: 100vh;
			}
			.invoices{
				width: 100%;
				height: 100%;
			}
			table{
				padding: 10px;
			}
			table{
				width: 80%;
				margin: auto;
			}
			table,th,tr,td{
				border: 1px solid #eee;
				border-collapse: collapse;
			}
			#filter{
				text-align: center;
				margin: auto;
			}
			#filter button{
				padding: 4px;
			}
		</style>
		<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=invoices&action=manage">Invoices</a>
		<div class="invoices">
			<h1>Invoices</h1>
			<table>
				<tr>
					<td colspan="6" id="filter">
						<button name="btn"><a href="?modules=invoices&action=manage&filter=0">All</a></button>
						<button name="btn"><a href="?modules=invoices&action=manage&filter=1">Pending (<?php echo $num1?>)</a></button>
						<button name="btn"><a href="?modules=invoices&action=manage&filter=2">Approved (<?php echo $num2?>)</a></button>
						<button name="btn"><a href="?modules=invoices&action=manage&filter=3">Completed (<?php echo $num3?>)</a></button>
						<button name="btn"><a href="?modules=invoices&action=manage&filter=4">Cancelled (<?php echo $num4?>)</a></button>
					</td>

				</tr>
				<tr>
					<th>Id</th>
					<th>Created At</th>
					<th>Receiver</th>
					<th>Total Amount</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php foreach ($query as $value): ?>
					<tr>
						<td><?php echo $value['id']; ?></td>
						<td><?php echo date("F j, Y H:i:a", strtotime($value['create_at']));?></td>
						<td><?php echo $value['receiver']; ?></td>
						<td><?php echo $value['total_amounts']; ?></td>
						<td><?php echo $value['status']; ?></td>
						<td><a href="?modules=invoices&action=viewDetail&id=<?php echo $value['id'] ?>">ViewDetail</a></td>
					</tr>		
				<?php endforeach ?>
				<tr>
					<td colspan="6">
						Page: 
						<?php
						for ($i=1; $i <= $totalPage ; $i++) { 
  // /?s=products&act=search&keyword=&sort=&type=&brand=
							echo "<a href='?modules=invoices&action=manage&filter=$filter&page=$i'>".$i."</a>";

						} ?>
					</td>
				</tr>
			</table>	
		</div>
		<?php 
		require_once 'template/footer.php';
		?>