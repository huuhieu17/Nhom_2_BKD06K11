<?php 
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
		header('Location:?modules=common&action=login');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../public/img/template/favicon.ico" type="image/gif" sizes="16x16">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Admin Panel | HStore</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: 'Open Sans', sans-serif;
		}
		#container{
			width: 100%;
			height: 100vh;
			background: #f9f9f9;
		}
		#nav{
			height: 7%;
			width: 100%;
			background: white;
			border-bottom: 1px solid #d2d6de;
		}
		#nav #logo{
			height: 100%;
			width: 14.9%;
			float: left;
			text-align: center;
			border: 1px solid #d2d6de;
			border-bottom: 0;
			border-top: 0;
		}
		#nav #logo img{
			height: 97%;
		}
		#nav #action{
			width: 84%;
			float: left;
			text-align: right;
		}
		#contents{
			width: 100%;
			float: right;
		}
		#sidebar{
			width: 15%;
			float: left;
			border: 1px solid #d2d6de;
			border-top: 0;
			box-sizing: border-box;
			background: #f9fafc;

		}

		#content{
			width: 84%;
			float: left;
		}
		span{
			color:#848484;
			text-transform: uppercase;
			font-family: arial;
			font-size: 13px;

		}
		#info{
			padding: 10px;
			text-align: center;
		}
		.link{
			width: 100%;
			padding: 5% 5%;
			box-sizing: border-box;
		}
		.link:hover{
			background: #f1f1f1;
		}
		i{
			padding: 10px;
		}
		a{

			width: 100%;
			text-decoration: none;
			color: black;
		}
		#left{
			padding: 1%;
			width: 85%;
			float: left;
			box-sizing: border-box;
		}
		#right{
			padding: 1%;
			position: absolute;
			width: 15%;
			right: 0;
			float: right;
			box-sizing: border-box;
		}
		ul{
			text-align: right;
			width: 100%;
			list-style-type: none;
		}
		ul li{
			text-align: left;
			padding: 1%;
			overflow: auto;
		}
		ul li ul{
			text-align: left;
			background: white;
			padding: 7% 0;
			display: none;
		}
		ul:hover li ul{
			display: block;
		}
		ul:hover li ul li:hover{
			background: #f1f1f1;
		}
		ul:hover li ul li:hover a{
			width: 100%;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="nav">
			<div id="logo">
				<img src="../public/img/template/logo.png" alt="">
			</div>
			<div id="action">
				<div id="left"> </div>
				<div id="right">
					<ul>
					<li>Welcome <b><?php echo $_SESSION['admin']['username'];?></b>
						<ul>
							<li><a href=""><i class="fa fa-user-circle-o"></i> Edit Infomation</a></li>
							<li><a href="index.php?modules=common&action=logout"><i class="fa fa-power-off"></i> Logout</a> </li>
						</ul>
					</li>

					</ul>
				</div>
				
			</div>
		</div>
		<div id="contents">
			<div id="sidebar">
				<div id="info">
					<b><?php echo $_SESSION['admin']['name']?></b>
					<p><?php 
						if ($_SESSION['admin']['level'] == 1) {
							echo "Moderator";
						}else{
							echo "Administrator";
						}
					?></p>
					<hr>
				</div>
				<center><span>Function</span></center>
				<div class="link">
					<a href="#"><i class="fa fa-archive"></i> All Product</a>
				</div>
				<div class="link">
					<a href="#"><i class="fa fa-th-list"></i> Manage Brand</a>
				</div>
				<div class="link">
					<a href="#"><i class="fa fa-th-list"></i> Manage Product</a>
				</div>
				<?php if ($_SESSION['admin']['level'] == 2): ?>
					<div class="link">
						<a href="#"><i class="fa fa-user"></i> Admin List</a>
					</div>
						
					<?php endif ?>
				
				<div class="link">
					<a href="#"><i class="fa fa-handshake-o"></i> Transaction / Order </a>
				</div>
				<div class="link">
					<a href="#"><i class="fa fa-newspaper-o"></i> News</a>
				</div>
				<div class="link">
					<a href="#"><i class="fa fa-user-circle-o"></i> Edit Information</a>
				</div>
				
			</div>
			<div id="content">
			