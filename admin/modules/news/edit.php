<?php 
require_once './template/header.php';
if (isset($_POST['submit'])) {
	$id = $_GET['id'];
	$title  = $_POST['title'];
	$content = $_POST['editor1'];
	$editor = $_SESSION['admin']['name'];
	$sql = "UPDATE news SET title = '$title',content = '$content',editor = '$editor' WHERE id = '$id' ";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo 'Error'.mysqli_error($connection);
	}else{
		echo "<script>window.location.replace('?modules=news&action=manage')</script>";
	}
}
	
?>
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<style>
	.news{
		width: 100%;
	}
	h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	form{
		width: 80%;
		margin: auto;
		border: 1px solid #eee;
		padding: 10px;
	}
	form input{
		width: 100%;
		padding: 10px;
	}
</style>
<div class="news">
	<?php 
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$f = "SELECT * FROM news WHERE id = '$id' ";
		$fetch = mysqli_fetch_assoc(mysqli_query($connection,$f));
	}
		
	?>
	<h4>New / Add Post</h4>
	<form action="#" method="POST" enctype="multipart/form-data">
		Title: <input type="text" name="title" value="<?php echo $fetch['title'] ?>"><br>
		Content: 
		 <textarea name="editor1" class="ckedit"><?php echo $fetch['content']?></textarea>
      <script>
                        CKEDITOR.replace( 'editor1' );
      </script>

    <input type="submit" name="submit">
	</form>
</div>

<?php 
require_once './template/footer.php';
?>