<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Upcomming";
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
	.item img{
		box-sizing: border-box;
		float: left;
		width: 30%;
	}
	.item a{
		width: 69%;
		box-sizing: border-box;
		float: left;
		text-decoration: none;
		vertical-align: top;
		color: black;
		font-weight: bold;
	}
	.item:after{
		content: "";
		display: table;
		clear: both;
	}
	.item a:hover{
		color:red;
	}
	.litem{
		width: 100%;
	}
	.litem img{
		box-sizing: border-box;
		float: left;
		width: 30%;
	}
	.litem a{
		width: 69%;
		box-sizing: border-box;
		float: left;
		text-decoration: none;
		vertical-align: top;
		color: black;
		font-weight: bold;
	}
	.litem:after{
		content: "";
		display: table;
		clear: both;
	}
	.litem a:hover{
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
		<?php
		$sql = "SELECT * FROM news ";
		$query = mysqli_query($connection,$sql);
		$totalPost = mysqli_num_rows($query);
		if (!isset($_GET['page'])) {
			$present_page = 1;
		}else{
			$present_page = $_GET['page'];
		}
		$limit = 6;
		$totalPage = ceil($totalPost/$limit);
		$skip = ($present_page - 1)*$limit;
		$sql = $sql. " LIMIT $limit OFFSET $skip";
		$query = mysqli_query($connection,$sql);
		function custom_echo($x, $length)
		{
			if(strlen($x)<=$length)
			{
				echo $x;
			}
			else
			{
				$y=substr($x,0,$length) . '...';
				echo $y;
			}
		}
		?>
		<?php foreach ($query as $post): ?>
			<div class="litem">
				<img src="./public/img/template/<?php echo $post['img'] ?>" alt="">
				<a href="?s=home&act=news&id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a>
				<br>
				<span><?php echo $post['time'];?></span>
				<span><?php echo $post['editor'];?></span>
				<p><?php custom_echo($post['content'], 50); ?></p>		
			</div>	
		<?php endforeach ?>
		<div class="page1">
			<center>
				
				
				Page:
				<?php

				for ($i=1; $i <= $totalPage ; $i++) { 
  // /?s=products&act=search&keyword=&sort=&type=&brand=
					echo "<a href='?s=home&act=news&page=".$i."'>".$i."</a>";

				} ?>
			</center>
		</div>
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
				<a href="?s=home&act=news&id=<?php echo $post['id'] ?>"><?php echo $post['title']; ?></a>
			</div>	
		<?php endforeach ?>

	</div>
</div>
<?php 
require_once 'customer/template/version1/footer.php';
?>