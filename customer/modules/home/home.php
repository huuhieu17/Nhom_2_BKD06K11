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
  padding: 10px;
  flex-direction: row;
  display: flex;
  flex-wrap: wrap;
  box-sizing: border-box;
  width: 100%;
  margin-top: 0%;
}
.item{
  text-transform: uppercase;
  margin:10px;
  box-sizing: border-box;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  text-align: center;
  flex: 20%;
  width: 25%;
}
.item:hover{
  transition: 0.1s;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  border: 2px solid gray;
  border-radius: 2px;
}
.item img{
  width: 100%;
  height: 400px;
}


h1{
  text-align: center;
}
@media only screen and (max-width: 768px) {
  .slideshow {
    padding: 3% 0;
  }
  td .item img{
    height: 200px;
    width: 100%;
  }
  .item{
    flex: 40%;
  }
}
@media only screen and (max-width: 420px) {
.item{
    flex: 50%;
  }
}

</style>




<div class="slideshow">
	<div id="sleft">
		<div class="mySlides">
    <div class="numbertext">1 / 6</div>
    <img src="public/img/template/banner.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
    <img src="public/img/template/img_nature_wide.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
    <img src="public/img/template/img_mountains_wide.jpg" style="width:100%">
  </div>
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

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
              echo "<img src='./public/img/product/".$img['url']."'>";
              echo "<b>".$key['product_name']."</b><br><br>";
                  echo "<b><p style='color:red'>".$key['product_price']."$</p></b>";
            echo "</div>";
          }
        }
      ?>
</div>
<center>
  <a href="#">SEE MORE</a>
</center>

<hr>