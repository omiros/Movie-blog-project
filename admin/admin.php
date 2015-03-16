<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require '../includes/functions.php' ?>
<?php confirm_logged_in(); ?>
<?php require'../includes/header.php'; ?>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel-group" id="accordion">
			<?php echo message(); ?>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
						<a href="#manage1" data-toggle="collapse" data-parent="accordion">Manage Posts</a>
						</div>
					</div>
					<div class="panel-collapse collapse" id="manage1">
						<div class="panel-body">
							<h4><a href="new_posts.php">Add new post</a></h4>
							<?php
						//select all data from blog_posts
							$query = "SELECT * FROM blog_posts WHERE admin_id = ?";
							$stmt = $connection->prepare( $query );
							$stmt->execute(array($_SESSION['admin_id']));
						// If admin access == ? / display all blogposts
							if($_SESSION['access'] == '1'){
								$query = "SELECT * FROM blog_posts";
								$stmt = $connection->prepare( $query );
							}
							$stmt->execute();

							//this is how to get number of rows returned
							$num = $stmt->rowCount();

							if($num>0){ //check if more than 0 record found
							?>
							<table class="table table-hover">
								<tr>
									<th>Username</th>
									<th>Category</th>
									<th>Title</th>
									<th>Image</th>
									<th>Content</th>
									<th>Post Date</th>
									<th colspan="2">Action</th>
								</tr>
							<?php
							//retrieve our table contents
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row);

							//creating new table row per record
							echo "<tr>";
							echo "<td>{$username}</td>";
							echo "<td>{$category_name}</td>";
							echo "<td>{$post_title}</td>"; ?>
							<td><?php echo trim_text($image_path,15); ?></td>
							<td><?php echo trim_text($post_content,15); ?></td>
					<?php	echo "<td>{$post_date}</td>";
							echo "<td>";
							echo "<a href='edit_blog_post.php?id={$post_id}'>Edit /</a>";
							echo "</td>";
							echo "<td>";
							echo "<a href='#' onclick='delete_blog_post( {$post_id} );'>Delete</a>";
							echo "</td>";
							echo "</tr>";
							} ?>
							</table>
							<?php 	}
							//if no records found
							else {
							echo "No records found.";
							}?>
							<!--! /Delete alert button -->
							<script type='text/javascript'>
							function delete_blog_post( id ){

							var answer = confirm('Are you sure?');
								if ( answer ){

								//if user clicked ok, pass the id to delete.php and execute the delete query
								// window.location = 'delete.php?id=' + id;
								window.location = 'delete_blog_post.php?id=' + id;

								}
							}
							</script>
						</div><!--! /.panel-body -->
					</div><!--! /.panel-collapse -->
				</div><!--! /.panel-info -->
			</div><!--! /.panel-group -->
		</div><!--! /.col-sm-12 -->
	</div><!-- /.row -->
	<div class="row">
			<div class="col-sm-12">
				<div class="panel-group" id="accordion">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">
								<a href="#manage2"
								data-toggle="collapse"
								data-parent="accordion">Manage Comments</a></div>
							</div>
							<div class="panel-collapse collapse in" id="manage2">
								<div class="panel-body">
									<?php
							//select all data from blog_posts
									$query = "SELECT * FROM comments WHERE admin_id = ?";
									$stmt = $connection->prepare( $query );
									$stmt->execute(array($_SESSION['admin_id']));
									$stmt->execute();

							//this is how to get number of rows returned
									$num = $stmt->rowCount();

							if($num>0){ //check if more than 0 record found
								?>
								<table class="table table-hover">
									<tr>
										<th>Post title</th>
										<th>Author name</th>
										<th>Author email</th>
										<th>Comment text</th>
										<th>Comment time</th>
										<th colspan="2">Action</th>
									</tr>
									<?php
							//retrieve our table contents
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										extract($row);

							//creating new table row per record
										echo "<tr>";
										echo "<td>{$post_title}</td>";
										echo "<td>{$author_name}</td>"; ?>
										<td><?php echo trim_text($author_email,15); ?></td>
										<td><?php echo trim_text($comment_text,15); ?></td>
										<?php	echo "<td>{$comment_time}</td>";
										echo "<td>";
										echo "<a href='reply.php?comment_id=$comment_id'>REPLY</a>";
										echo "</td>";
										echo "<td>";
										echo "<a href='#' onclick='delete_comment( {$comment_id} );'>Delete</a>";
										echo "</td>";
										echo "</tr>";
									} ?>
								</table>
								<?php 	}
							//if no records found
								else {
									echo "No records found.";
								}?>
								<!--! /Delete alert button -->
							<script type='text/javascript'>
							function delete_comment( id ){

							var answer = confirm('Are you sure?');
							if ( answer ){

							//if user clicked ok, pass the id to delete.php and execute the delete query
							// window.location = 'delete.php?id=' + id;
							window.location = 'delete_comment.php?id=' + id;

							}
							}
							</script>
							</div><!--! /.panel-body -->
						</div><!--! /.panel-collapse -->
					</div><!--! /.panel-info -->
				</div><!--! /.panel-group -->
			</div><!--! /.col-sm-12 -->
	</div><!--! /.row -->
	<div class="row">
			<div class="col-sm-6">
				<div id="accordion" class="panel-group">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">
								<a href="#first"
								data-toggle="collapse"
								data-parent="#accordion">Manage users</a>
							</div>
						</div>
						<div class="panel-collapse collapse" id="first">
							<div class="panel-body">
								<?php echo message(); ?>
								<?php
							//select all data
								$query = "SELECT * FROM admins WHERE admin_id = ?";
								$stmt = $connection->prepare( $query );
								$stmt->execute(array($_SESSION['admin_id']));
							// If admin access == ? / display all users
								if($_SESSION['access'] == '1'){
									$query = "SELECT * FROM admins";
									$stmt = $connection->prepare( $query );
								}
								

								$stmt->execute();

							//this is how to get number of rows returned
								$row = $stmt->rowCount();

							if($row>0){ //check if more than 0 record found
								?>
								<table class="table table-hover">
									<tr>
										<th>Email</th>
										<th>Username</th>
										<!-- <th>Password</th> -->
									<?php if($_SESSION['access'] == '1'){ ?>
										<th>Access</th>
									<?php } ?>
										<th colspan="2">Action</th>
									</tr>
									<?php
							//retrieve our table contents
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										
										extract($row);

								//creating new table row per record
										echo "<tr>";
										echo "<td>{$email}</td>";
										echo "<td>{$username}</td>";
										// echo "<td>{$password}</td>";
										if($_SESSION['access'] == '1'){ 
										echo "<td>{$access}</td>";
										}
										echo "<td>";
										echo "<a href='edit_admin.php?id={$admin_id}'>Edit</a>";
										echo "</td>";
								// If admin access == ? / display delete option 
										if($_SESSION['access'] == '1') {
											echo "<td>";
											echo "<a href='#' onclick='delete_user( {$admin_id} );'> / Delete</a>";
											echo "</td>";
											echo "</tr>";

										}
									} ?>
								</table>
								<?php 	}
							//if no records found
								else {
									echo "No records found.";
								}?>
								<!--! /Delete alert button -->
								<script type='text/javascript'>
								function delete_user( id ){

								var answer = confirm('Are you sure?');
								if ( answer ){

								//if user clicked ok, pass the id to delete.php and execute the delete query
								// window.location = 'delete.php?id=' + id;
								window.location = 'delete.php?id=' + id;

								}
								}
								</script>
							</div><!--! /.panel-body -->
							<!-- If admin access == ? / display add new user option -->	
							<?php if($_SESSION['access'] == '1') { ?>
							<div class="panel panel-danger">
								<div class="panel-heading">
									<div class="panel-title"><a href="#new-admin"
										data-toggle="collapse"data-parent="accordion">Add new user</a>
									</div>
								</div>
								<div class="panel-collapse collapse" id="new-admin">
									<div class="panel-body">
										<form action="create_admin.php" method="post">
											<div class="form-group">
												<label for="InputName">Name:</label>
												<input type="text" class="form-control" id="InputName" name="username" placeholder="Name">
											</div>
											<div class="form-group">
												<label for="InputPass">Password:</label>
												<input type="password" class="form-control" name="password" id="InputPass" placeholder="Password">
											</div>
											<div class="form-group">
												<label for="InputEmail">Email address:</label>
												<input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter email">
											</div>
											<div class="form-group">
												<label for="input-access">Access:</label><br>
												<select class="form-control"name="access">
													<option value="General Question">Choose access level</option>
													<option value="1">1</option>
													<option value="2">2</option>
												</select>
											</div>
											<button type="submit" name="submit" class="btn btn-default">Create user</button>
										</form>
									</div>
								</div>
							</div><!-- /.panel-danger -->
							<?php }?>		
						</div><!--! /.panel-collapse -->
					</div><!--! /.panel panel-info -->
				</div><!--! /.panel-group -->
			</div><!--! /.col-sm-6 -->
    	<div class="col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title"><a href="#my-account"
					data-toggle="collapse"data-parent="accordion">My Account</a>
					</div>
				</div>
				<div class="panel-collapse collapse in" id="my-account">
					<div class="panel-body">
							<?php
						// Retrieve the blogposts associated with the user ID
							$query = "SELECT COUNT(*) as post_count FROM blog_posts WHERE admin_id = ?";

						// Prepare the statement
							$stmt = $connection->prepare( $query );
						// Execute the statement using online user admin_id
							if($stmt->execute(array($_SESSION['admin_id'])))
								?>
							<table class="table table-hover">
								<tr>
									<th style="text-align:center">Blogposts</th>
									<th style="text-align:center">Comments</th>
									<th style="text-align:center">Average comments/blogposts</th>
								</tr>
								<?php
							//retrieve our table contents
								while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									$post_count = $row['post_count'];

								//creating new table row per record
									echo "<tr>";
									echo "<td style=text-align:center>" . $post_count . "</td>";
								}
								?>
								<?php
								// Retrieve the comments associated with the user ID
								$query = "SELECT COUNT(*) as comment_count FROM comments WHERE admin_id = ?";
								// Prepare the statement
								$stmt = $connection->prepare( $query );
								// Execute the statement using online user admin_id
								if($stmt->execute(array($_SESSION['admin_id'])))
									//retrieve our table contents
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										$comment_count = $row['comment_count'];
									//Dont display any errors if data = 0
										noError();
										$sum = $comment_count / $post_count;
										//creating new table row per record
										echo "<td style=text-align:center>" . $comment_count . "</td>";
										echo "<td style=text-align:center>" . number_format($sum, 2) . "</td>";
										echo "</tr>";
									}
									?>
								</table>
					</div>
				</div>
			</div>
    	</div>
	</div><!--! /.row -->
</div><!--! /.container -->
<script src="bootstrap/js/bootstrap.js"></script>
<?php require'../includes/footer.php'; ?>
