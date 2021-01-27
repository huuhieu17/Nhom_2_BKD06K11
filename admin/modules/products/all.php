<?php 
$sql = "SELECT * FROM products";
$query = mysqli_query($connection,$sql);
if (!$query) {
	echo "Error :". mysqli_connect_error();
}else{
	if (mysqli_num_rows($query) == 0) {
		echo "No record!";
	}
}
?>
<style>
	a.nav{
		color: gray;
		font-weight: bold;
	}
	a#add{
	font-weight: bold;
	text-decoration: underline;
}
	.imgpdct{
		width: 150px;
		height: 200px;
	}
	table{
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}
	td,th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2;}

	tr:hover {background-color: #ddd;}

	th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: gray;
		color: white;
	}
	td a{
		font-weight: bold;
	}
</style>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=products&action=all">Products</a><br><br>
<h1>Manage Products</h1>
<a id="add" href="?modules=products&action=add">Add new product</a>
<table>
	<tr>
		<th>Id</th>
		<th>Product</th>
		<th>Price</th>
		<th>Status</th>
		<th colspan="2">Action</th>
	</tr>
	<?php 
	foreach ($query as $row) {
		$id = $row['id'];
		$result = "";
		switch ($row['product_status']) {
			case '0':
				$result = 'Not Available';
				break;
			case '1':
				$result = 'Available';
				break;
			case '2':
				$result = 'Comming Soon';
				break;
			default:
				# code...
				break;
		}
		echo "<tr>";
		echo "<td>".$row['id']."</td>";
		echo "<td align='center'><b>".$row['product_name']."</b><br><img class='imgpdct' src='../public/img/product/".$row['product_images']."'>"."</td>";
		echo "<td>".$row['product_price']."</td>";
		echo "<td>".$result."</td>";
		echo "<td class='action'><a href='?modules=products&action=edit&id=$id'><i class='fa fa-pencil'></i>Edit</a></td>";
			echo "<td class='action'><a href='?modules=products&action=delete&id=$id'><i class='fa fa-times-circle'></i>Delete</a></td>";
		echo "</tr>";
	}
	?>
</table>