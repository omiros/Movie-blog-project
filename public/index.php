<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php 

if (isset($_POST['submit'])) {
	$stm = $connection->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");
	$stm->execute(array(
		":email" => $_POST['email'],
		":password" => $_POST['password']
		));
	if ($stm->rowCount() == 1) {
		$row = $stm->fetch();

		$_SESSION["status"] = "Loggedin";
		$_SESSION["email"] = $_POST['email'];
		$_SESSION["admin_id"] =  $row["admin_id"];
		$_SESSION["access"] = $row["access"];
		$_SESSION["username"] = $row["username"];
		$_SESSION["time"] = date("Y-m-d H:i:s");
		redirect_to("../admin/admin.php");
	}
	else {
		echo "<div class=";
		echo "'alert alert-danger'";
		echo "role='alert'>";
		echo "Invalid Email or Password, try again!";
		echo "</div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sofhäng</title>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../admin/js/ajax.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<!-- // <script type="text/javascript" src="../admin/js/ajax.js"></script> -->

	<link rel="stylesheet" type="text/css" media="all" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="sass/css/blog_style.css">
	<link href='http://fonts.googleapis.com/css?family=Spinnaker' rel='stylesheet' type='text/css'>
	<style>
  </style>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default navbar-static-top top-heading" role="navigation">
			<div class="panel-heading">
				<div class="panel-title">
					<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user"></span><a href="#" class="navbar-link"data-toggle="modal" data-target="#Modal-form" data-whatever="@mdo"> Login</a></p>
				</div>
			</div>
		</nav>
		<div class="modal fade" id="Modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="exampleModalLabel">Subscribe your credentials</h4>
					</div>
					<div class="modal-body">
						<form action="index.php" method="post">
							<input type="hidden" name="username" value="">
							<div class="form-group">
								<label for="InputEmail">Email address:</label>
								<input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter email">
							</div>
							<div class="form-group">
								<label for="InputPass">Password:</label>
								<input type="password" class="form-control" name="password" id="InputPass" placeholder="Password">
							</div>
							<button type="submit" name="submit" class="btn btn-default">Login</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- SLIDESHOW -->
		<div id="show">
			<div class="col-xs-12">
				<div class="element"><img src="img/soff.png" id="element"></div>
				<div class="img1 slide" >
					<img src="img/filmkamera.png" alt="kamera" />
				</div>
				<div class="img2 slide" >
					<img src="img/hustle.png" alt="american hustle" />	
				</div>
				<div class="img3 slide">
					<img src="img/killing.png" alt="killing" />
				</div>
				<div class="img4 slide" >
					<img src="img/sunshine.png" alt="sunshine" />
				</div>
				<div class="img5 slide" >
					<img src="img/gravity.png" alt="gravity" />
				</div>
			</div>
		</div>
		<!-- #SLIDESHOW -->
				<!-- #Search area -->
				<section id="search-area">
					<h2 class="hidden">Lorem ipsizzle</h2>
					<p>Search in my archive for movies..</p>
					<div class="search-inner">
						<form>
							<input type="text" id="movie" name="searchsite" placeholder="Movietime..">
							<input type="submit" name="search" class="button" value="Search">
						</form>
					</div><!-- end/.search-inner -->
				</section><!-- end/#search-area -->
				<div id="content" class="hidden"></div>
		<section>
			<div class="row">
				<div class="col-xs-8 all-posts" style="margin-top:30px;">
					<?php show_post_pagination(); ?>
				</div><!--! /.col-md-8 -->
				<aside class="col-xs-4"style="margin-top:30px;">
					<div class="panel panel-info">
						<div class="panel-heading">
							<a href="api_movie.php"><div class="panel-title">
								Top Rated TV-Series!
							</div></a>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">About me</h3>
						</div>
						<div class="panel-body">
							<a href="showposts.php?userid=1"><img src="img/elias.png" alt="elias"style="width:250px; height:250px;"></a>
							<p>I'm a paragraph. Click here Let your users get to know you. Let your users get to know you</p>
							<a href="showposts.php?adminid=1" class="button-tag">Read more</a>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">About me</h3>
						</div>
						<div class="panel-body">
							<img src="img/marcus.png" alt="marcus"style="width:250px; height:250px;">
							<p>I'm a paragraph. Click here Let your users get to know you. Let your users get to know you</p>
							<a href="showposts.php?adminid=10" class="button-tag">Read more</a>
						</div>
					</div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">
									<a href="#category"
									data-toggle="collapse"
									data-parent="#accordion">Categories</a>
								</div>
							</div>
							<div class="collapse collapse" id="category">
								<div class="panel-body">
									<ul class="list-group">
										<?php echo categories(); ?>
										<?php
										if(isset($_GET['category_id'])) {
											echo show_category_posts($_GET['category_id']);
										}
										?>
									</ul>
								</div><!--! /.panel-body -->
							</div><!--! /.collapse -->
						</div><!--! /.panel panel-danger -->
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="panel-title">
									<a href="#archive"
									data-toggle="collapse"
									data-parent="#accordion">Archive</a>
								</div>
							</div>
							<div class="collapse collapse" id="archive">
								<div class="panel-body">
									<ul class="list-group">
										<?php
										noError();
										$months = array("Jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec");
										for($i = 0; $i<12; $i++) {
											?>
											<li class="list-group-item">
												<a href="index.php?month=<?php echo ($i+1); ?>"><?php echo $months[$i]; ?></a>
												<?php
												if(isset($_GET["month"])){ echo get_blogposts_by_month($_GET['month'],$i+1);}
												?>	<span class="badge"><?php echo posts_count($i+1); ?></span>	<?php
												?>
											</li>
											<?php
										}
										?>
									</ul>
								</div><!--! /.panel-body -->
							</div><!--! /.collapse -->
						</div><!--! /.panel-danger -->
						<div class="panel panel-info" id="accordion">
							<div class="panel-heading">
								<div class="panel-title">
									<a href="#recent"
									data-toggle="collapse"
									data-parent="#accordion">Recent posts</a>
								</div>
							</div>
							<div class="collapse collapse" id="recent">
								<div class="panel-body">
									<ul class="list-group list-unstyled">
										<?php recent_posts2(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div><!--! /.panel-group -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Favorite Links</h3>
						</div>
						<div class="panel-body">
							<ul class="list-group list-unstyled list-inline">
								<li><p><a href="http://www.sf.se/"target="_blank">SF BIO</a></p></li>
								<li><p><a href="https://www.netflix.com/?locale=sv-SE"target="_blank">NETFLIX</a></p></li>
								<li><p><a href="https://www.moviezine.se/nyheter"target="_blank">MOVIEZINE</a></p></li>
								<li><p><a href="http://www.imdb.com/"target="_blank">IMDB</a></p></li>
								<li><p><a href="http://movies.amctv.com/movie-guide/top-100-blockbusters/"target="_blank">MOVIES</a></p></li>
							</ul>
						</div>
					</div>
				</aside>
			</div><!--! /.row -->
		</section>
		<div id="toggle">
			<h5></h5>
			<img src="">
			<p></p>
		</div>
		<footer>
			<div class="row">
				<div class="col-md-4">
					<p>Kontakta oss</p>
				</div>
				<div class="col-md-4">
					<p>Kontakta oss</p>
				</div>
				<div class="col-md-4">
					<p>Kontakta oss</p>
				</div>
			</div>
		</footer>
	</div><!--! /.container -->
</body>
</html>