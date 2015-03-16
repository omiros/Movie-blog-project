<?php require '../includes/session.php' ?>
<?php require'../includes/db_connect.php'; ?>
<?php require '../includes/functions.php' ?>
<?php confirm_logged_in(); ?>
<?php 
$result = "";
if (isset($_POST['submit'])) {
	$stm = $connection->prepare("INSERT INTO admins (username, password, email, access) VALUES (:username, :password, :email, :access)");
	$result = $stm->execute(array(
		":username" => $_POST['username'],
		":password" => $_POST['password'],
		":email" => $_POST['email'],
		":access" => $_POST['access']
		));
}
	if ($result) {
		$_SESSION['message'] = "New admin created!";
		// $_SESSION['username'] = $_POST['username'];
		redirect_to('admin.php');
	}
?>
