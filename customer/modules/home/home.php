<style>
img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.slideshow {
  padding: 10px 0;
  width: 100%;
  z-index: 0;
}
.slideshow #sleft{
	position: relative;
	width: 69%;
	float: left;
}
.slideshow #sright{
	overflow: auto;
	width: 30%;
	float: right;
}
#sright img{
	margin-bottom: 2%;
	width: 100%;
}
/* Hide the images by default */
.mySlides {
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



.row:after {
  content: "";
  display: table;
  clear: both;
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
.content123{
	background: white;
	border:2px solid #feafb7;
}
</style>




<div class="slideshow">
	<div id="sleft">
		<div class="mySlides">
    <div class="numbertext">1 / 6</div>
    <img src="public/img/template/img_snow_wide.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
    <img src="public/img/template/img_nature_wide.jpg" style="width:100%">
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
    <img src="public/img/template/img_mountains_wide.jpg" style="width:100%">
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

  <div class="row">
    <div class="column" onclick="currentSlide(1)">
      <p class = "demo cursor"> Hello </p>
    </div>
    <div class="column" onclick="currentSlide(2)">
      <p class = "demo cursor"> Hello </p>
    </div>
    <div class="column" onclick="currentSlide(3)">
     <p class = "demo cursor"> Hello </p>
    </div>
    <div class="column" onclick="currentSlide(4)">
     <p class = "demo cursor"> Hello </p>
    </div>
   
  </div>
	</div>
  	<div id="sright">
  		<img src="public/img/template/1.png" alt="">
  		<img src="public/img/template/2.png" alt="">
  		<img src="public/img/template/1.png" alt="">
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
    
<div class="content123">
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
	1231321222222
</div>