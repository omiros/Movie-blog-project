<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php
$result = "";
if (isset($_GET['post_id'])) {

$sql = "SELECT * FROM blog_posts WHERE post_id = {$_GET['post_id']}";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if($_GET['adminid'] == 1 ){echo "Elias";}
		elseif ($_GET['adminid'] == 10) {
		echo "Marcus";
	} ?> Blog</title>

	<meta charset="utf-8">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="sass/css/blog_style.css">
	
</head>
<body>
	<div class="container show-single-post">
		<div class="row">
		<div class="jumbotron">
		<?php if ($_GET['post_id']) {
			echo "<a href='index.php'><img src='img/soff.png' style='margin-left:135px;'></a>";
		}
		 ?>
		</div>
			<div class="col-md-12">
				<div class="blog-posts">
			<?php foreach ($result as $key) { 
					$id = $key['post_id'];
					$adminid = $key['admin_id'];
					$title = $key['post_title'];
			?>
					<img src="<?php echo $key['image_path'] ?>">
					<h3 class="title"><?php echo $key['post_title'] ?></h3>
					<p><?php echo myTruncate($key['post_content'], 200, ' ', $pad="...").'<br><a href="#"> Read more</a>'; ?></p><br>
			<?php
					$output = "";
					$output_comment = "";
					$output_button = "";
					$output = "<div class='comments'>";
					$output .= "<form action='comments.php?&id=$id&adminid=$adminid&post_title=$title' method='post'>";
					$output .= "<div class='form-group'>";
					$output .= "<input type='text' name='name' class='form-control'placeholder='Name'>";
					$output .= "</div>";
					$output .= "<div class='form-group'>";
					$output .= "<input type='text' name='email' class='form-control'placeholder='Email'>";
					$output .= "</div>";
					$output .= "<div class='form-group'>";
					$output .= "<textarea name='comment' id='comment' class='form-control'placeholder='Leave a comment'>";
					$output .= "</textarea>";
					$output .= "</div>";
					$output .= "<button type='submit' class='btn btn-success' name='submit'>Send</button>";
					$output .= "</form>";
					echo $output; 
					?>
				</div><!--! /.blog-posts -->
					<?php
					$sql2 = "SELECT * FROM comments WHERE post_id='$id'";
					$stmt = $connection->prepare($sql2);
					$stmt->execute();
					$result2 = $stmt->fetchAll();

					$sql3 = "SELECT COUNT(*) FROM comments WHERE post_id= '$id'";
					$stmt = $connection->prepare($sql3);
					$stmt->execute();
					$resultset = $stmt->fetchAll();
					foreach ($resultset as $r) {
						$count_com = $r[0];
					}
					?>
				<div class='panel-group' id='accordion'>
					<div class='panel-heading'>
						 <div class='panel-title'>
						 	<a href='#comment-coll' data-toggle='collapse' data-parent='accordion'>
						 	<button type='button' class='btn btn-default'
						 value='comments'>Comments <span class='badge'>
						 <?php echo $count_com ?>
						 	</span></button></a>
					     </div>
				     </div><br><hr>
					<div class='panel-collapse collapse' id='comment-coll'>
				  		<div class='panel-body'>
		<?php 	foreach ($result2 as $row) {  ?>
		
						id :<?php echo $row['comment_id'] ?><br>
						Name :<?php echo $row['author_name'] ?><br>
						<p><?php echo $row['comment_time'] ?></p><br>
						Comment :
						<div class="well"><p style="color:#000;"><?php echo $row['comment_text'] ?></p></div><br>
						Reply :
						<div class="well well-sm"><p style="color:#000;"><?php echo $row['reply'] ?></p></div><br>
					<?php
						 
					?>
		 <?php	} 	?>
						</div>
				  	</div>
			    </div>
	<?php	}
	}   ?>
			</div><!--! /.col-md-12 -->
		</div><!--! /.row -->
	</div><!--! /.container -->
</body>
</html>
