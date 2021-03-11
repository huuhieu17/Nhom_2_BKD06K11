<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Upcomming";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM news WHERE id = '$id'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		header("Location:?s=home");
	}else{
		$fetch = mysqli_fetch_assoc($query);
	}
}else{
	header("Location:?s=home");
}
?>
<style>
	.upcomming{
		width: 100%;
	}
	.left{
		box-sizing: border-box;
		width: 70%;
		float: left;
		padding: 7px;
		border:1px solid #eee;
	}
	.right{
		box-sizing: border-box;
		width: 30%;
		border:1px solid #eee;
		float: left;
	}
	h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	h5{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
	}
	.left span{
		font-size: 13px;
		font-weight: bold;
	}
	.left img{
		display: block;
		width: 70%;
	}
	.item{
		margin: 0 0 10px 0;
		width: 100%;
	}
	.item:after{
		content: "";
		clear: both; 
		display: table;
	}
	.item img{
		box-sizing: border-box;
		float: left;
		width: 30%;
	}
	.item a{
		width: 70%;
		box-sizing: border-box;
		float: left;
		text-decoration: none;
		vertical-align: top;
		color: black;
		font-weight: bold;
	}
	.item a:hover{
		color:red;
	}
	@media only screen and (max-width: 768px){
		.left{
			width: 100%;
		}
		.right{
			width: 100%;
		}
	}
</style>
<div class="upcomming">
	<h4>Upcomming</h4>
	<div class="left">
		<h1><?php echo $fetch['title']; ?></h1><!-- title -->
		<span><?php echo $fetch['time']; ?></span> <span><?php echo $fetch['editor']; ?></span>
		<center><img src="./public/img/template/<?php echo $fetch['img'] ?>" alt=""> </center><!-- img put here -->
		<p><?php echo $fetch['content']; ?></p>
	</div>
	<div class="right">
		<h5>Another Post</h5>
		<?php
		$sql = "SELECT * FROM news ORDER BY ID DESC LIMIT 6";
		$query = mysqli_query($connection,$sql);
		?>
		<?php foreach ($query as $post): ?>
			<div class="item">
				<img src="./public/img/template/<?php echo $post['img'] ?>" alt="">
				<a href="?s=home&act=upcomming&id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a>
			</div>	
		<?php endforeach ?>
	</div>
</div>
<?php 
require_once 'customer/template/version1/footer.php';
?>