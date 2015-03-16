<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require '../includes/functions.php' ?>
<?php
$result = "";
if (isset($_POST['submit'])) {
	if($_POST['email']){
			$email = $_POST['email'];
			$regex = '/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/';

			if (preg_match($regex, $email)) {
					$stm = $connection->prepare("INSERT INTO comments (comment_id, post_id, admin_id, post_title, author_name, author_email, comment_text, comment_time) VALUES (NULL, :post_id, :admin_id, :post_title, :author_name, :author_email, :comment_text, :time)");
					$result = $stm->execute(array(
						":post_id" => $_GET['id'],
						":admin_id" => $_GET['adminid'],
						":post_title" => $_GET['post_title'],
						":author_name" => $_POST['name'],
						":author_email" => $_POST['email'],
						":comment_text" => $_POST['comment'],
						":time" => date("Y-m-d H:i:s")
					));
				
			} 
			else { 
				$_SESSION['message'] = 'Comment not sent.';
				redirect_to('showposts.php?adminid='. $_GET['adminid']);

			}
		}
		if ($result) {
			$_SESSION['message'] = 'Comment succcefully sent.';
			redirect_to('showposts.php?adminid='.$_GET['adminid']);
		}
}

?>