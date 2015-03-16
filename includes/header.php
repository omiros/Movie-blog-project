<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../admin/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../admin/sass/css/admin_style.css">
		<style type="text/css">
			.message { 
				border: 2px solid #8D0D19;
				color: #8D0D19; font-weight: bold;
				margin: 1em 0 ; padding: 1em; 
				width: auto;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="col-sm-12">
				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="navbar-header">
					<a href="admin.php"><h1>Admin</h1></a>
					</div>
					<p class="navbar-text navbar-right">Welcome <?php echo $_SESSION['username'];?>
					<br>Server time: <?php echo $_SESSION['time'];?><br><a href="logout.php">Logout</a>
					</p><br>
				</nav>
			</div>
		</div>