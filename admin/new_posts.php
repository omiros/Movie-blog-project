<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php confirm_logged_in();
$result = ""; 
$filename = "";
?> 
<?php 
if (isset($_POST['submit'])) {
    if (isset($_SESSION["last_uploaded_filename"])) {
     $filename = "http://localhost/blog_project/uploads/" . $_SESSION["last_uploaded_filename"];
     unset($_SESSION["last_uploaded_filename"]);   
    }

	$stm = $connection->prepare("INSERT INTO blog_posts
        (admin_id, username, category_name, post_title, image_path, post_content, visible, post_date) 
        VALUES (:admin_id, :username, :category, :title, :image, :content, :visible, :time)");
	$result = $stm->execute(array(
        ":category" => $_POST['categories'],
		":title" => $_POST['title'],
		":image" => $filename,
		":content" => $_POST['content'],
        ":visible" => $_POST['visible'],
		":time" => date("Y-m-d H:i:s"),
        ":admin_id" => $_SESSION["admin_id"],
        ":username" => $_SESSION["username"]
		));
}
	if ($result) {
		$_SESSION['message'] = "Post was added to Draft";
	} 
?>
<?php require'../includes/header.php'; ?>
<link rel="stylesheet" type="text/css" href="sass/css/admin_style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<div class="container">
    <div class="col-sm-4">
<?php echo message(); ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <h2>Post Form</h2>
                </div>
            </div>
            <div class="panel-body">
                <div id="preview"></div>
        <form name="image-input" enctype="multipart/form-data" action="upload.php"  method="POST">
            <div class="form-group"> 
                <label for="fileToUpload">Select image to upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <button type="submit" class="btn btn-info" value="" name="submit" id="image_upload">Upload Image</button>
            </div> 
        </form>
        <form name="post-input" action="new_posts.php" method="post" role="form">
            <div class="form-group">
                <label for="InputTitle">Title:</label>
                <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="InputContent">Content:</label>
                <textarea class="form-control" name="content" id="InputContent" placeholder="Your text"></textarea>
            </div>
            <div class="form-group">
                <label for="InputEmail">Email address:</label>
                <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
             <label for="input-categories">Categories:</label><br>
                <select class="form-control"name="categories">
                    <option value="General Blog">Choose category</option>
                    <option value="action">Action</option>
                    <option value="animate">Animate</option>
                    <option value="comedy">Comedy</option>
                    <option value="drama">Drama</option>
                    <option value="horror">Horror</option>
                    <option value="scifi">Sci-Fi</option>
                    <option value="tv_series">Tv-Series</option>
                    <option value="romance">Romance</option>
                </select>
            </div>
            Draft:
            <input type="radio" name="visible" value="0"/> Yes&nbsp<br><br>
            <!-- <input type="radio" name="visible" value="1"/> Yes&nbsp -->
          <button type="submit" name="submit" class="btn btn-info">Add post</button>
        </form><br>
        <a href="#" class="btn btn-default" id="btn-default">Preview</a>
        </div><!--! /.panel-body -->
        </div><!--! /.panel -->
    </div>
    <div class="col-md-8">
        <h1>Draft :</h1>
        <div class="show-preview">
            
        </div>
    </div>
</div>
<?php require'../includes/footer.php'; ?>