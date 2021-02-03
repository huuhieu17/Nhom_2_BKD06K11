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
	<link type="text/css" rel="stylesheet" href="template/image-uploader.min.css">
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
			height: 100%;
			width: 100%;
			float: right;
		}
		#sidebar{
			width: 15%;
			height: 100%;
			float: left;
			border: 1px solid #d2d6de;
			border-top: 0;
			box-sizing: border-box;
			background: #f9fafc;
		}
		#footer{
			width: 100%;
		    overflow: hidden;
		    display: block;
		    float: none;
		}
		#content{
			box-sizing: border-box;
			height: 100%;
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
			position: absolute;
			width: 15%;
			right: 0;
			float: right;
			box-sizing: border-box;
		}
		ul{
			padding: 10px;
			text-align: right;
			width: 100%;
			list-style-type: none;
		}
		ul li{

			position: relative;
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
		.menu{
			border: 0;
			background: none;
			font-size: 24px;
			display: none;
		}
		#logout{
			display: none;
		}
		@media only screen and (max-width: 768px) {
		 .topnav{
		 	display: none;
		 }
		 ul{
		 	display: none;
		 }

		@media only screen and (max-width: 768px) {
		  .menu{
		  	float: right;
		  	display: block;
		  }
		   .responsive {position: relative;}
		   .responsive {
		    display: block;
		    text-align: right;
		    float: right;
		  	}
		  	#sidebar{
		  		width: 100%;
		  	}
		  	.link{
		  		text-align: left;
		  		padding: 2% 0;
		  	}
		  	#logout{
		  		display: block;	
			}
	  	}
	</style>
</head>
<body>
	<div id="container">
		<div id="nav">
			<div id="logo" onclick="window.location.replace('?modules=common&action=home')">
				<img src="../public/img/template/logo.png" alt="">
			</div>
			<div id="action">
				<div id="left"> </div>
				<div id="right">
					<button class="menu" onclick="menu()"><i class="fa fa-bars"></i></button>
					<ul>
					<li><a href="#">Welcome <b><?php echo $_SESSION['admin']['username'];?></a></b>
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
			<div id="sidebar" class="topnav">
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
					<a href="?modules=brands&action=all"><i class="fa fa-th-list"></i> Manage Brand</a>
				</div>
				<div class="link">
					<a href="?modules=products&action=all"><i class="fa fa-th-list"></i> Manage Product</a>
				</div>
				<div class="link">
					<a href="?modules=categorizes&action=all"><i class="fa fa-newspaper-o"></i> Manage Categorizes</a>
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
				<div class="link" id="logout">
					<a href="?modules=common&action=logout"><i class="fa fa-power-off"></i> Log Out</a>
				</div>
				
			</div>
			<script>
				function menu() {
				  var x = document.getElementById("sidebar");
				  if (x.className === "topnav") {
				    x.className += " responsive";
				  } else {
				    x.className = "topnav";
				  }		
				}
			</script>
			<div id="content">
			