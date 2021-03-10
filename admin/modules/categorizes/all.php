<?php require_once 'template/header.php'; ?>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=categorizes&action=all">Product Type</a><br><br>
<h4>Manage Product Type</h4>

<style>
	#contents{
		height: 100vh;
	}
	a.nav{
		color: gray;
		font-weight: bold;
	}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin:auto;
}
a#add{
	font-weight: bold;
	text-decoration: underline;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}

#customers tr:hover {background-color: #ddd;}

#customers th {
  		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;	
		color: black;
}
td a{
	font-weight: bold;
}
.action{
	text-align: center;
}
@media only screen and (max-width: 768px) {
	#customers{
		width: 100%;
	}
}
</style>

<table id="customers">
	<tr>
		<td colspan="4">
			<a id="add" href="?modules=categorizes&action=add">Add new product type</a>
		</td>
		
	</tr>
	<tr>
		<th>ID</th>
		<th>Product Type</th>
		<th colspan="2">Action</th>
	</tr>
	<?php 
	$sql = "SELECT * FROM categorizes";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error",mysqli_connect_error();
	}else if (mysqli_num_rows($query) == 0) {
		$result = "No record!";
		echo "<tr>";
		echo "<td colspan='3'> <b>No record!</b> </td>";
		echo "</tr>";
	}else{
		foreach ($query as $key) {
			$id = $key['id'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$key['name']."</td>";
			echo "<td class='action'><a href='?modules=categorizes&action=edit&id=$id'><i class='fa fa-pencil'></i>Edit</a></td>";
			echo "<td class='action'><a href='?modules=categorizes&action=delete&id=$id'><i class='fa fa-times-circle'></i>Delete</a></td>";
			echo "</tr>";
		}
	}
	?>
</table>
<?php require_once 'template/footer.php'; ?>