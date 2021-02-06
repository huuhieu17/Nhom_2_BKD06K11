<?php $subTitle = "Home";
require_once('customer/template/version1/header.php');
 ?>

<style>
.mySlides img {
  height: 100%;
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */

.slideshow {
  padding: 1% 0;
  width: 100%;
  margin-top: 60px;
  z-index: 0;
  height: 100%;
}
#content{
      margin-top: 0%;
      width: 100vw;
    }
.slideshow #sleft{
  height: 90%;
	position: relative;
	width: 100%;
}

/* Hide the images by default */
.mySlides {
  height: 100%;
	position: relative;
	width: 100%;
 	display: none;
}
.mySlides img{
  height: 90vh;
}
/* Add a pointer when hovering over the thumbnail images */
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





/* Six columns side by side */
.column {
  float: left;
  width: 25%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
  background: #f1f1f1;
  text-align: center;
  padding: 10px;
}

.active,
.demo:hover {
  opacity: 1;
}
.slideshow:after {
    content:'';
    display:block;
    clear: both;
}
.new{
 box-sizing: border-box;
    height: 100%;
    padding: 0;
    width: 100vw;
    margin: auto;
    text-align: center;
    flex-flow: row wrap;
    display: flex;
    flex-direction: row;
}
.new:after{
  content: "";
  display: table;
  clear: both;
}
.item{
  box-sizing: content-box;
  text-align: center;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  float: left;
  width: 23%;
  padding: 10px;
  margin: auto;
  height: 500px;
}

.item:hover{
  transition: 0.1s;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  background: black;
  border-radius: 2px;
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
.item img{
  width: 100%;
  height: 80%;
}
.view{
  text-decoration: none;
  color: black;
}


h1{
  text-align: center;
}
@media only screen and (max-width: 425px) {
  .slideshow{
    display: none;  
  }
  .item{
      height: 300px;
      width: 44%;
  }
  #content{
    margin-top: 20%;
  }
}
@media only screen and (max-width: 768px) and (min-width: 426px) {
  .slideshow {
    padding: 3% 0;
  }
  .mySlides img{
    height: 100%;
  }
  .item{
    height: 350px;
    width: 30%;
  }
}
 
}


@media only screen and (max-width: 1024px) {
.item{
  width: 22%;
}
}
@media only screen and (max-width: 2250px) {
.item{
  width: 17%;
}
}

</style>




<div class="slideshow">
	<div id="sleft">
		<div class="mySlides">
    
    <img src="public/img/template/banner.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <img src="public/img/template/img_nature_wide.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <img src="public/img/template/img_mountains_wide.jpg" style="width:100%">
  </div>
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" id="next" onclick="plusSlides(1)">❯</a>

  <div class="caption-container">
    <p id="caption"></p>
  </div>


	</div>
</div>

<script>
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
 
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
  
}
setInterval(next,2000); 
function next() {
  document.getElementById('next').click();
}

</script>
    <h1>New Product</h1>
    <hr>
<div class="new">
     <?php 
        $sql = "SELECT * FROM `products` ORDER BY id DESC LIMIT 8";
        $query = mysqli_query($connection,$sql);
        if (!$query) {
          echo "Error: ". mysql_connect_error();
        }else if (mysqli_num_rows($query) == 0) {
          echo "No products";
        }else{
          foreach ($query as $key) {
            $id = $key['id'];
            $img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM products_images WHERE id = '$id'"));
            echo "<div class='item'>";
              echo "<a class='view' href='?s=products&act=detail&id=$id'>";
              echo "<img src='./public/img/product/".$img['url']."'>";
              echo "<b>".$key['product_name']."</b><br>";
                  echo "<b><p style='color:red'>".$key['product_price']."$</p></b>";
              echo "</a>";
            echo "</div>";
          }
        }
      ?>
</div>
<center>
  <a href="#">SEE MORE</a>
</center>

<hr>
<?php 
require_once('customer/template/version1/footer.php'); ?>