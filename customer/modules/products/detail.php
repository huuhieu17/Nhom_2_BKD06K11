<?php
require_once('customer/template/version1/header.php');
$subTitle = "Product";
$sku_id = "";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM products WHERE id = '$id'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error";
	} 
	if (mysqli_num_rows($query) == 0) {
		echo "<script>window.location.replace('?s=home&act=404')</script>";
	}
	$row = mysqli_fetch_assoc($query);	
		//color fetch
			$sql = "SELECT product_variants.id,product_variants.product_id,product_variants.product_variant_value_id, variant_value.value FROM `product_variants` INNER JOIN variant_value WHERE product_variants.product_id = '$id' AND status = 1 AND product_variants.product_variant_value_id = variant_value.id"; // color
			$color = mysqli_query($connection,$sql);
			
		}

		$product_sku = "<br>";
		$product_quantity ="<br>";
		if (isset($_POST['size'])) {
			$sizep = $_POST['size'];
			$colorp = $_POST['color'];
			$sku_sql = "SELECT * FROM sku WHERE product_id = '$id' AND color_id= '$colorp' AND size_id='$sizep'";
			$sku_query = mysqli_query($connection,$sku_sql);
			$product_s = mysqli_fetch_assoc($sku_query);
			$product_sku = $product_s['sku'];
			$product_quantity ="Quantity: ".$product_s['quantity'];
			$sku_id = $product_s['id'];
		}
		?>
		<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'> </script>
		<style>
			.pcontent{
				border-top: 1px solid #eee;
			}
			.row{
				display: flex;
				flex-wrap: wrap;
			}
			.left{
				flex: 60%;
				width: 60%;
				float: left;
			}
			.left{
				display: flex;
				flex-flow: row wrap;
			}
			.left > .column {
				padding: 3px 3px;
			}

			.row:after {
				content: "";
				display: table;
				clear: both;
			}

			.left .column{
				flex:30%;
			}
			.thumb .column{
				width: 23%;
				border: 1px solid white;
				float: left;
			}
			/* The Modal (background) */
			.modal {
				display: none;
				position: fixed;
				z-index: 9999;
				padding-top: 30px;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				overflow: auto;
				background-color: black;
			}

			/* Modal Content */
			.modal-content {
				position: relative;
				background-color: #fefefe;
				margin: auto;
				padding: 0;
				width: 50%;
				max-width: 100vh;
			}

			/* The Close Button */
			.close {
				color: white;
				position: absolute;
				top: 10px;
				right: 25px;
				font-size: 35px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: #999;
				text-decoration: none;
				cursor: pointer;
			}

			.mySlides {
				display: none;
			}

			.cursor {
				cursor: pointer;
			}

			/* Next & previous buttons */
			.prev,
			.next {
				cursor: pointer;
				position: absolute;
				top: 50%;
				width: auto;
				padding: 16px;
				margin-top: -50px;
				color: white;
				font-weight: bold;
				font-size: 20px;
				transition: 0.6s ease;
				border-radius: 0 3px 3px 0;
				user-select: none;
				-webkit-user-select: none;
			}

			/* Position the "next button" to the right */
			.next {
				right: 0;
				border-radius: 3px 0 0 3px;
			}

			/* On hover, add a black background color with a little bit see-through */
			.prev:hover,
			.next:hover {
				background-color: rgba(0, 0, 0, 0.8);
			}

			/* Number text (1/3 etc) */
			.numbertext {
				color: #f2f2f2;
				font-size: 12px;
				padding: 8px 12px;
				position: absolute;
				top: 0;
			}

			img {
				margin-bottom: -4px;
			}

			.caption-container {
				text-align: center;
				background-color: black;
				padding: 2px 16px;
				color: white;
			}

			.demo {
				opacity: 0.6;
			}

			.active,
			.demo:hover {
				opacity: 1;
			}

			img.hover-shadow {
				transition: 0.3s;
			}
			.column img{
				width: 100%;
			}
			.hover-shadow:hover {
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			}
			.right{
				flex: 40%;
				box-sizing: border-box;
				padding: 0;
				width: 40%;
				float: left;
				
			}
			.right ul{
				padding: 0 20px;
				display: block;
				float: none;
			}
			.right ul li{
				padding: 0;
				float: none;
				font-size: 13px;
				list-style-type: disc;

			}
			h4{
				text-align: left;
				font-size: 13px;
				box-sizing: border-box;
				width: 100%;
				padding: 10px;
				background: #f1f1f1;
			}
			span{
				margin-right: 20px;
			}
			#addcart{
				background: black;
				padding: 10px;
				color: white;
				margin-bottom: 10px;
			}
			#quantity{
				color: black;
				font-size: 15px;
			}
			.random{
				display: flex;
				 justify-content: center;
				box-sizing: border-box;
				width: 80%;
				margin: auto;
				text-align: center;
				flex-flow: row wrap;
				display: flex;
				flex-direction: row;
				float: left;
				overflow: auto;
			}
			.item{
				height: 35vh;
				box-sizing: content-box;
				text-align: center;
				box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
				float: left;
				width: 15%;

				margin: 2%;
			}

			.item:hover{
				transition: 0.1s;
				box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
				background: black;
				border-radius: 2px;
				color: white;
			}
			.item:hover .view img{
				background: black;
				opacity: 0.5;
				transition: 0.2s;
			}
			.item:hover .view{
				text-decoration: none;
				color: white;
			}

			.item .view{
				height: 100%;
				text-decoration: none;
				color: black;
			}
			.item .view .img{
				width: 100%;
				height: 70%;
			}
			.item .view .img img{
				height: 100%;
				width: 100%;
			}
			.item .view .name{
				height: 20%;

			}
			.item .view .price{
				height: 9%;
			}
			@media only screen and (max-width: 768px){
				.row .left{
					flex: 61%;
				}
				.modal-content{
					width: 80%;
				}
				.item{
					height: 35vh;
					width: 44%;
				}
				.random{
					width: 100%;
				}
			}
		</style>
		<div class="pcontent">
			<div class="row">
				<div class="left">
					<?php 
					$sql = "SELECT url FROM products_images WHERE id = '$id'";
					$result = mysqli_query($connection,$sql);
					
					
					foreach ($result as $key => $value) {
						$i = ++$key;
						echo " <div class='column'>";
						echo "<img src='public/img/product/".$value['url']."' onclick='openModal();currentSlide($i)'>";
						echo "</div>";
					}
					?>
				</div>
				<div id="myModal" class="modal">
					<span class="close cursor" onclick="closeModal()">&times;</span>
					<div class="modal-content">
						<?php 
						$sql = "SELECT url FROM products_images WHERE id = '$id'";
						$result = mysqli_query($connection,$sql);
						
						
						foreach ($result as $key => $value) {
							echo " <div class='mySlides'>";
							echo "<img src='public/img/product/".$value['url']."' style='width:100%'>";
							echo "</div>";
						}
						?>
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(1)">&#10095;</a>
						


						

						

						<div class="thumb">
							<?php 
							$sql = "SELECT url FROM products_images WHERE id = '$id'";
							$result = mysqli_query($connection,$sql);
							
							
							foreach ($result as $key => $value) {
								$i = ++$key;
								echo " <div class='column'>";
								echo "<img src='public/img/product/".$value['url']."' style='width:100%' onclick='openModal();currentSlide($i)'>";
								echo "</div>";
							}
							?>
							
						</div>
						
					</div>
				</div>
				<script>
					function openModal() {
						document.getElementById("myModal").style.display = "block";
					}

					function closeModal() {
						document.getElementById("myModal").style.display = "none";
					}

					var slideIndex = 1;
					showSlides(slideIndex);

					function plusSlides(n) {
						showSlides(slideIndex += n);
					}

					function currentSlide(n) {
						showSlides(slideIndex = n);
					}

					function showSlides(n) {
						var i;
						var slides = document.getElementsByClassName("mySlides");
						var dots = document.getElementsByClassName("demo");
						var captionText = document.getElementById("caption");
						if (n > slides.length) {slideIndex = 1}
							if (n < 1) {slideIndex = slides.length}
								for (i = 0; i < slides.length; i++) {
									slides[i].style.display = "none";
								}
								for (i = 0; i < dots.length; i++) {
									dots[i].className = dots[i].className.replace(" active", "");
								}
								slides[slideIndex-1].style.display = "block";
								dots[slideIndex-1].className += " active";
								captionText.innerHTML = dots[slideIndex-1].alt;
							}
						</script>
						<div class="right">
							<form action="" method="POST">
								
								<script>
									if ( window.history.replaceState ) {
										window.history.replaceState( null, null, window.location.href );
									}
								</script>
								<h4>Product Detail</h4>
								<h1><?php echo $row['product_name'] ?></h1>
								<h5 style="color: gray"><?php echo $product_sku ?></h5>
								
								<h2 style="color: red">
									<?php if ($row['product_status'] == 1): ?>
										<?php echo number_format($row['product_price'],0,'','.')." $"; ?></h2>
									<?php endif ?>
									<?php if ($row['product_status'] == 0): ?>
										Not Available
									<?php endif ?>
									<?php if ($row['product_status'] == 2): ?>
										Contact
									<?php endif ?>
									
									<br>

									<h5>Color: </h5>
									<?php foreach ($color as $key => $colors): ?>
										<?php if (isset($_POST['color'])): ?>
											<?php if ($_POST['color'] == $colors['product_variant_value_id']): ?>
												<input type="radio" class="color" id="color" name="color" checked value="<?php echo $colors['product_variant_value_id'] ?>"> <span><?php echo $colors['value'] ?></span>
												<?php else: ?>
													<input type="radio" class="color" id="color" name="color" value="<?php echo $colors['product_variant_value_id'] ?>"> <span><?php echo $colors['value'] ?></span>
												<?php endif ?>
												<?php else: ?>
													<input type="radio" class="color" id="color" name="color" value="<?php echo $colors['product_variant_value_id'] ?>"> <span><?php echo $colors['value'] ?></span>
												<?php endif ?>
												
												
											<?php endforeach ?>
											
											<script>
												$('input[name=color]').change(function(){
													$('form').submit();

												});
											</script>
											<?php 
											if (isset($_POST['color'])) {
												$colorid = $_POST['color'];
					$sql = "SELECT sku.size_id, sku.sku,sku.quantity, variant_value.value FROM sku INNER JOIN variant_value WHERE sku.product_id = '$id' AND sku.color_id = '$colorid' AND sku.size_id = variant_value.id AND sku.quantity > 0"; // size
					$size = mysqli_query($connection,$sql);
				}
				
				
				?>
				<h5>Size:</h5>
				<?php if (isset($_POST['color'])): ?>
					<?php foreach ($size as $key => $sizes): ?>
						<?php if (isset($_POST['size'])): ?>
							<?php if ($_POST['size'] == $sizes['size_id']): ?>
								<input type="radio" name="size" checked value="<?php echo $sizes['size_id'] ?>">	<span><?php echo $sizes['value'] ?></span>
								<?php else: ?>
									<input type="radio" name="size" value="<?php echo $sizes['size_id'] ?>">	<span><?php echo $sizes['value'] ?></span>
								<?php endif ?>
								<?php else: ?>
									<input type="radio" name="size" value="<?php echo $sizes['size_id'] ?>">	<span><?php echo $sizes['value'] ?></span>
								<?php endif ?>
								
								<script>
									$('input[name=size]').change(function(){
										$('form').submit();

									});
								</script>
							<?php endforeach ?>
						<?php endif ?>
						<p id="quantity"><?php echo $product_quantity ?></p>
						<br>
						<?php if ($row['product_status'] == 1): ?>
							<?php if (isset($_POST['size'])): ?>
								<a href="?s=invoices&act=cart&id=<?php echo $sku_id ?>&up"><button id="addcart" type="button">Add To Cart</button></a>
								<?php else: ?>
									<a href="#"><button id="addcart" type="button">Add To Cart</button></a>
								<?php endif ?>
								
							<?php endif ?>
							
							<hr>
							<h4><b>Description</b></h4>
							<p><?php echo $row['product_description'] ?></p>
						</div>
					</form>
				</div>
				<h4>May you like</h4>
				<div class="random">
					
					<?php 
					$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 5 ";
					$query = mysqli_query($connection,$sql);
					if (!$query) {
						echo "Error: ". mysql_connect_error();
					}else if (mysqli_num_rows($query) == 0) {
						echo "No product";
					}else{
						foreach ($query as $key) {
							$id = $key['id'];
							$img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id = '$id'"));

							echo "<div class='item'>";
							echo "<a class='view' href='?s=products&act=detail&id=$id'>";
							echo "<div class ='img'>";
							echo "<img src='./public/img/product/".$img['url']."'>";
							echo "</div>";
							echo "<div class ='name'>";
							echo "<b>".$key['product_name']."</b>";   
							echo "</div>";
							echo "<div class ='price'>";
							echo "<b><p style='color:red'>".$key['product_price']."$</p></b>";
							echo "</div>";
							echo "</a>";
							echo "</div>";
						}
					}
					?>
				</div>
				
			</div>
			<?php 
			require_once('customer/template/version1/footer.php'); ?>