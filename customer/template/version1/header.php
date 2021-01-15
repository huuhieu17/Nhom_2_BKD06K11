<?php
	$sql = "SELECT * FROM brands";
	$query_brand = mysqli_query($connection,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<title>Document</title>
	<style>
		*{
			padding: 0;
			margin: 0;
			font-family: 'Open Sans', sans-serif;
		}
		#container{
			width: 100%;
			height: 100vh;
		}
		#header{
			box-sizing: border-box;
			z-index: 99;
			top: 0;
			position: fixed;
			width: 100%;
			background: white;
			margin-bottom: 3%;
			border-bottom: 1px solid #eee;
		}
		#left{
			vertical-align: middle;
		    width: 20%;
		    box-sizing: border-box;
		    float: left;
		    padding: 10px 30px;
		}
		#right{
			box-sizing: border-box;
			width: 80%;
			float: right;
			text-align: right;
		}
		ul{
			position: relative;
			float: right;
			display: flex;
			flex: wrap;
			list-style-type: none;
		}
		ul li{
			padding: 20px;
			display: list-item;
		}
		ul li a{
			font-size: 13px;
			/*padding: 10px;*/
			color: #999;
			text-decoration: none;
			text-transform: uppercase;
		}
		ul li:hover{
			background: #f5f5f5;
		}
		ul li ul{
			text-align: left;
			margin: 35px -25px;
			background: white;
			position: absolute;
			display: none;
		}
		ul li ul li{
			padding-right: 130px;
		}
		ul li:hover ul{
			display: block;
		}
		#search form input{
			display: inline;
			padding: 5px;
		}
		#search form button{
			display: inline;
			padding: 5px;
		}
		#footer{
			background: #000;
			color: white;
			padding: 20px;
		}
		#menu{
			background: none;
			outline: none;
			display: none;
			box-sizing: border-box;
		}
		#logout{
			display: none;
		}
		@media only screen and (max-width: 768px) {
		 ul{
		  	display: none;
		  	margin: 0;
		  	padding: 0;
		 }
		 ul li ul li{
		 	display: none;
		 }
		 ul li{
		 	padding: 20px;
		 	background: gray;
		 	
		 }
		 ul li a{
		 	padding: 20px;
		 	background: gray;
		 	color: white;
		 }
		}

		@media only screen and (max-width: 768px) {
		  #menu{
		  	padding: 15px;
		  	float: right;
		  	display: block;
		  }
		  #left{
		  	width: 100%;
		  }
		  #right{
		  }
		 
		  #left img{
		  	float: left;
		  }
		 .responsive {position: relative;}
		   .topnav.responsive ul {
		    display: block;
		    text-align: right;
		    float: right;
		    width: 125%;
		  	}
		  	.topnav.responsive ul li ul{
		  		display: none;
		  	}
		  	#logout{
			display: block;
		}
		}


	</style>
</head>
<body>
	<div id="container">
		<div id="header" class="topnav">
			<div id="left">
				<button id="menu" onclick="menu()"><i class="fa fa-bars"></i></button>
				<img src="public/img/template/logo.png" alt="">
			</div>
			<div id="right">
				<ul>
					<li id="search">
						<form>
							<input type="text" placeholder="Search" name="keyword"><button><i class="fa fa-search"></i></button>
						</form>
						
					</li>
					<li><a href="#">Brand</a>
						<ul>
							<?php foreach ($query_brand as $key): ?>
								<li><a href="?s=product&act=brand&id=$key['id']"><?php echo $key['name']; ?></a></li>
							<?php endforeach?>
						</ul>
					</li>
					<li><a href="#">Type</a></li>
					<li><a href="#">Upcomming</a></li>
					
					<?php 
					if (!isset($_SESSION['user'])|| $_SESSION['user'] === "") {
						echo "<li><a href='index.php?s=home&act=login'>Login</a></li>";
						echo "<li><a href='index.php?s=home&act=register'>Sign Up</a></li>";
					}else{
						echo "<li><a href='#' style='font-weight:bold;'>".$_SESSION['user']['name']."</a>
						<ul>
										<li><a class='act' href='#'><i class='fa fa-user-o'></i>  Account Information</a></li>
										<li><a class='act' href='index.php?s=home&act=logout'><i class='fa fa-power-off'></i>  Logout</a></li>
									</ul>
						</li>";
					}
					?>
					<li><a href="Login"><i class="fa fa-shopping-cart"></i></a></li>
					<li id="logout"><a class='act' href='index.php?s=home&act=logout'><i class='fa fa-power-off'></i>  Logout</a></li>
					
				</ul>
			</div>
			
		</div>
	