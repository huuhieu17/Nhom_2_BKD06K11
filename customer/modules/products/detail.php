<?php
require_once('customer/template/version1/header.php');
$subTitle = "Product";
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
		
	}
?>
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
		padding: 0 20px;
		width: 40%;
		float: left;
		
	}
	.right ul{
		display: block;
		float: none;
	}
	.right ul li{
		padding: 0;
		float: none;
		font-size: 13px;
		list-style-type: disc;

	}
	@media only screen and (max-width: 768px){
		.row .left{
			flex: 61%;
		}
		.modal-content{
			width: 80%;
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
			<?php 
			$sql = "SELECT * FROM product_variants WHERE product_id = '$id' AND status = 1 AND product_variant_value_id <= 11"; // color
			$color = mysqli_query($connection,$sql);
			$sql = "SELECT * FROM product_variants WHERE product_id = '$id' AND status = 1 AND product_variant_value_id > 11"; // size
			$size = mysqli_query($connection,$sql);
			?>
			<h1><?php echo $row['product_name'] ?></h1><br>
			<h2 style="color: red"><?php echo $row['product_price']."$" ?></h2>
			<br>
			<h4>Color</h4>
			<select name="color" id="">
			<?php
			foreach ($color as $key => $colors) {
			 	echo "<option>";
			 	switch ($colors['product_variant_value_id']) {
			 		case '1':
			 			echo "Black";
			 			break;
			 		case '2':
			 			echo "Blue";
			 			break;
			 		case '3':
			 			echo "Red";
			 			break;
			 		case '4':
			 			echo "Yellow";
			 			break;
			 		case '5':
			 			echo "Gray";
			 			break;
			 		case '6':
			 			echo "Green";
			 			break;
			 		case '7':
			 			echo "Orange";
			 			break;
			 		case '8':
			 			echo "Pink";
			 			break;
			 		case '9':
			 			echo "White";
			 			break;
			 		case '10':
			 			echo "Brown";
			 			break;
			 		case '11':
			 			echo "Purple";
			 			break;
			 		
			 		default:
			 			# code...
			 			break;
			 	}
			 	echo "</option>";
			 } 

			?>
			</select>
			<h4>Size</h4>
			<select name="size" id="">
				<?php
			foreach ($size as $key => $sizes) {
			 	echo "<option>";
			 	switch ($sizes['product_variant_value_id']) {
			 		case '12':
			 			echo "S";
			 			break;
			 		case '13':
			 			echo "M";
			 			break;
			 		case '14':
			 			echo "L";
			 			break;
			 		case '15':
			 			echo "XL";
			 			break;
			 		case '16':
			 			echo "XXL";
			 			break;
			 		case '17':
			 			echo "XXXL";
			 			break;
			 		default:
			 			# code...
			 			break;
			 	}
			 	echo "</option>";
			 } 

			?>
			</select><br><br>
			<a href="?s=invoices&act=cart&id=<?php echo $id ?>"><button>Add To Cart</button></a>
			<hr>
			<h4><b>Description</b></h4>
			<p><?php echo $row['product_description'] ?></p>
		</div>
	</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>