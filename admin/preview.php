<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require '../includes/functions.php' ?>
<?php
if (isset($_POST['submit'])) {
	try{
        $query = "UPDATE blog_posts SET visible = 1 WHERE post_id = {$_POST['visible']}";
        $stmt = $connection->prepare($query);
        if($stmt->execute()){
            $_SESSION['message'] = "Blogpost was published";
            redirect_to("new_posts.php");
        }
        else {
            die('Unable to publish record.');
        }
}
catch(PDOException $exception){ //to handle error
        echo "Error: " . $exception->getMessage();
    }
}

$sql = 
	"SELECT 
	blog_posts.admin_id,
	blog_posts.post_id,
	blog_posts.username,
	blog_posts.category_name, 
	blog_posts.post_title, 
	blog_posts.image_path,
	blog_posts.post_content
	FROM blog_posts 
	WHERE admin_id = ?
	AND visible = 0";
	$stmt = $connection->prepare($sql);
	$stmt->execute(array($_SESSION['admin_id']));
	$row = $stmt->fetchAll();

		foreach ($row as $key) {	
	$output = "<section class='preview'";
	$output .= "<div class='col-md-6'>";
	$output .= "<h3 class='panel-title'>";
	$output .= $key['post_title'] . ' ' .$key['post_id'];
	$output .= "</h3>";
	$output .= "<img src='";
	$output .= $key['image_path'];
	$output .= "'style='width:340px; height:210px; padding:5px 10px'>";
	$output .= "</div>";//end.article
	$output .= "<div class='col-md-6'>";
	$output .=	"<p class='content' style='padding: 20px 12px 10px 0px;'>";
	$output .= $key['post_content'];
	$output .= "</p>";
	$output .= "<span class='author'>";
	$output .= $key['username'];
	$output .= "</span>";
	$output .= "<form action='preview.php' method='post'>";
	$output .= "Publish: ";
	$output .= "<input type='radio' name='visible'";
	$output .= "value=";
	$output .= $key['post_id'].">";
	$output .= "<br>";
	$output .= "<button type='submit' name='submit' class='btn btn-info'>Send</button>";
	$output .= "</form>";
	$output .= "</div>";//end.article
	$output .= "</section>";
		echo $output;
	}

?>