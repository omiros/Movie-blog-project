<?php
//redirect function
function redirect_to($new_location) {
	header("Location:" . $new_location);
}
//Confirm log in
function logged_in(){
	return isset($_SESSION['admin_id']);
}
function confirm_logged_in() {
	if (!logged_in()) {
		redirect_to('login.php');
	}
}
//trim text
function trim_text($input,$length) {
	$input = substr($input, 0, $length);
	$input .= "...";
	return $input;
}
//display Archive, posts by month
function get_blogposts_by_month($month,$i) {
	global $connection;
	$output = "";

	if ($month == $i) {

		$sql = "SELECT * FROM blog_posts
		WHERE MONTH (post_date) = {$month}";
		foreach ($connection->query($sql) as $row) { 
		
			$output = "<ul>";
			$output .= "<li class='list-group-item'>";
			$output .= $row['post_title'];
			$output .= "</li>";
			$output .= "</ul>";
			echo $output;
		} 
	}	return $output;
}
//show the six recent posts
function recent_posts() {
	global $connection;
	$output = "";

	$sql = 
	"SELECT 
	blog_posts.admin_id,
	blog_posts.post_id,
	blog_posts.category_name, 
	blog_posts.post_title, 
	blog_posts.image_path,
	blog_posts.post_content,
	blog_posts.post_date,
	admins.username

	FROM blog_posts 
	JOIN admins ON (blog_posts.admin_id = admins.admin_id) 
	ORDER BY post_id DESC LIMIT 4";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach ($result as $key) {

	$output = "<div class='col-md-12'>";
	$output .= "<section>";
	$output .= "<div class='article'>";
	$output .= "<h3 class='panel-title'>";
	$output .= $key['post_title'];
	$output .= "</h3>";
	$output .= "<span class='blog-date'>";
	$output .= $key['post_date'];
	$output .= "</span>";
	$output .= "<img src='";
	$output .= $key['image_path'];
	$output .= "'style='width:280px; height:210px;padding:5px 10px'>";
	$output .= "</div>";//end.article
	$output .= "<div class='article'>";
	$output .=	"<p class='content'>";
	$output .= $key['post_content'];
	$output .= "<span class='author'>";
	$output .= $key['username'];
	$output .= "</span>";
	$output .= "</p>";
	$output .= "<a class='button-tag' href='showposts.php?post_id=";
	$output .= $key['post_id'];
	$output .= "&adminid=";
	$output .= $key['admin_id'];
	$output .= "'>";
	$output .= "Read more</a>";
	$output .= "</div>";//end.article
	$output .= "</section>";
	$output .= "</div>";//end.col-md-10
	echo $output;
	}
	return $output;
}
//show recent posts at showposts.php
//show the six recent posts
function recent_posts2() {
	global $connection;
	$output = "";

	$sql = 
	"SELECT 
	blog_posts.admin_id,
	blog_posts.post_id,
	blog_posts.category_name, 
	blog_posts.post_title, 
	blog_posts.image_path,
	blog_posts.post_content,
	blog_posts.post_date,
	admins.username

	FROM blog_posts 
	JOIN admins ON (blog_posts.admin_id = admins.admin_id) 
	ORDER BY post_id DESC LIMIT 4";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach ($result as $key) {

	$output = "<li class='grey-background'><h3>";
	$output .= $key['post_title'];
	$output .= "</h3></li>";
	$output .= "<li>";
	$output .= "<span class='blog-date'>";
	$output .= $key['post_date'];
	$output .= "</span>";
	$output .= "</li>";
	$output .= "<li>";
	$output .= "<span class='author'>";
	$output .= "Author: ";
	$output .= $key['username'];
	$output .= "</span>";
	$output .= "<a href='showposts.php?post_id=";
	$output .= $key['post_id'];
	$output .= "&adminid=";
	$output .= $key['admin_id'];
	$output .= "'>";
	$output .= "</a>";
	$output .= "<hr>";
	echo $output;
	}
	return $output;
}

function show_post_pagination() {
	global $connection;
	$output = "";

	try {

    // Find out how many items are in the table
    $total = $connection->query('SELECT COUNT(*) FROM blog_posts WHERE visible = 1')->fetchColumn();

    // How many items to list per page
    $limit = 4;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some alternative information to display
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;Previous</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page"></a><a href="?page=' . $pages . '" title="Last page">Next&rsaquo;&raquo;</a>' : '<span class="disabled">&rsaquo;</span><span class="disabled">&raquo;</span>';

    // Prepare the paged query
    $stmt = $connection->prepare('SELECT * FROM blog_posts ORDER BY post_id LIMIT :limit OFFSET :offset');

    // Bind the query params
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Do we have any results?
    if ($stmt->rowCount() > 0) {
        // Define how we want to fetch the results
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);

        // Display the results
        foreach ($iterator as $row) {
	$output = "<div class='col-md-12'>";
	$output .= "<section>";
	$output .= "<div class='article'>";
	$output .= "<h3 class='panel-title'>";
	$output .= $row['post_title'];
	$output .= "</h3>";
	$output .= "<span class='blog-date'>";
	$output .= $row['post_date'];
	$output .= "</span>";
	$output .= "<img src='";
	$output .= $row['image_path'];
	$output .= "'style='width:280px; height:210px;padding:5px 10px'>";
	$output .= "</div>";//end.article
	$output .= "<div class='article'>";
	$output .=	"<p class='content'>";
	$output .= myTruncate($row['post_content'], 100);
	$output .= "<span class='author'>";
	// $output .= $row['username'];
	$output .= "</span>";
	$output .= "</p>";
	$output .= "<a class='button-tag' href='show_single_post.php?post_id=";
	$output .= $row['post_id'];
	$output .= "&adminid=";
	$output .= $row['admin_id'];
	$output .= "'>";
	$output .= "Read more</a>";
	$output .= "</div>";//end.article
	$output .= "</section>";
	$output .= "</div>";//end.col-md-10
	echo $output;
        }
        // Display the paging information
    echo '<div id="paging" class="paging"><p>', $prevlink, '  ', $page, ' of ', $pages, ' pages',' ', $nextlink, '</p></div>';

    } 
    else {
        echo '<p>No results could be displayed.</p>';
    }
} 
catch (Exception $e) {
	    echo '<p>', $e->getMessage(), '</p>';
	} 
	return $output;
}
//count how many posts per month
function posts_count($count) {
	global $connection;

	$sql = "SELECT COUNT(*) FROM blog_posts AS itemCount WHERE MONTH(post_date) = {$count}";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $key) {
		return $key[0];
	}
}
//output categories
function categories() {
	global $connection;

	$sql = "SELECT DISTINCT category_name from blog_posts ORDER BY category_name ASC";

		foreach ($connection->query($sql) as $row) {
			$output = "<li class='list-group-item'>";
			$output .= "<a href='index.php?category_id=";
			$output .= $row['category_name'];
			$output .= "'>";
			$output .= $row['category_name'];
			$output .= "</a>";
			$output .= "</li>";
			echo $output;
		}
		return $output;
}
//select posts_title from database
function show_category_posts($input) {
	global $connection;

	$sql = "SELECT * FROM blog_posts WHERE category_name = '{$input}'";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $key) {
		$output = "<ul>";
		$output .= "<li class='list-group-item'>";
		$output .= $key['post_title'];
		$output .= "</li>";
		$output .= "</ul>";
		echo $output;
	}	 //return $key;
}
//Don't display errors
function noError() {
	error_reporting(0);
}
//Truncate text
function myTruncate($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}
function isValidMail($mail){
			$expression = " /^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/";
			if(preg_match($expression,$mail)){
				return true;
			}else{
				return false;
			} 
}
?>