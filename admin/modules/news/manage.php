<?php 
require_once './template/header.php';
$sql = "SELECT * FROM news";
$query = mysqli_query($connection,$sql);
?>
<style>
	.news{
		width: 100%;
	}
	h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	table{
		width: 80%;
		margin: auto;
	}
	table, tr, td, th{
		border: 1px solid #eee;
		border-collapse: collapse;
	}
	table tr td img{
		width: 240px;
		height: 120px;
	}
</style>
<div class="news">
	<h4>News</h4>
	<a href="?modules=news&action=add">Add Post</a>
	<table>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Img</th>
			<th>Modified At</th>
			<th>Editor</th>
			<th>Action</th>
		</tr>
		<?php foreach ($query as $value): ?>
			<tr>
				<td> <?php echo $value['id']; ?> </td>	
				<td> <?php echo $value['title']; ?> </td>	
				<td> <img src="../public/img/template/<?php echo $value['img']; ?>" alt=""> </td>	
				<td> <?php echo $value['time']; ?> </td>	
				<td> <?php echo $value['editor']; ?> </td>
				<td><a href="?modules=news&action=edit&id=<?php echo $value['id'] ?>">Edit</a>| <a href="?modules=news&action=delete&id=<?php echo $value['id'] ?>">Delete</a></td>	
			</tr>
		<?php endforeach ?>
	</table>
</div>
<?php 
require_once './template/footer.php';
?>