<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require '../includes/functions.php' ?>
<?php
if (isset($_POST['submit'])) {

	$stm = $connection->prepare("UPDATE comments SET reply = :reply WHERE comment_id = :cid");
	$result = $stm->execute(array(
		":cid" =>  $_POST["comment_id"],
		":reply" => $_POST['reply'],
	));

	if ($result) {
		$_SESSION['message'] = 'Reply succcefully sent.';
		redirect_to('admin.php');
		
	}
}

?>
<form action="reply.php" method="post">
<input type="hidden" name="comment_id" value="<?php echo $_GET['comment_id']; ?>">
<textarea type="text" name="reply" placeholder="reply" width="50%"></textarea> 
<input type="submit" name="submit" >
</form>