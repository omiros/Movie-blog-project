<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php confirm_logged_in(); ?>
<?php
$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
if($action == "update"){
    try{
        $query = "UPDATE blog_posts SET category_name = :category_name, post_title = :post_title, image_path  = :image_path, post_content = :post_content, visible = :visible, post_date = :time WHERE post_id = :id";

        $stmt = $connection->prepare($query);
        //bind the parameters
        $stmt->bindParam(':post_title', $_POST['title']);
        $stmt->bindParam(':image_path', $_POST['image_path']);
        $stmt->bindParam(':post_content', $_POST['post_content']);
        $stmt->bindParam(':visible', $_POST['visible']);
        $stmt->bindParam(':category_name', $_POST['category']);
        $stmt->bindParam(':time', (date ("Y-m-d H:i:s")), PDO::PARAM_STR);
        $stmt->bindParam(':id', $_POST['id']);

        if($stmt->execute()){
            $_SESSION['message'] = "Blogpost was updated";
            redirect_to("admin.php");
        }else{
            die('Unable to update record.');
        }

    }catch(PDOException $exception){ //to handle error
        echo "Error: " . $exception->getMessage();
    }
}

try {

    //prepare query
    $query = "SELECT * FROM blog_posts WHERE post_id = ? LIMIT 0,1";
    $stmt = $connection->prepare( $query );

    $stmt->bindParam(1, $_REQUEST['id']);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //values to fill up our form
    $id = $row['post_id'];
    $post_title = $row['post_title'];
    $image_path = $row['image_path'];
    $post_content = $row['post_content'];
    $visible = $row['visible'];
    $category_name = $row['category_name'];

}catch(PDOException $exception){ //to handle error
    echo "Error: " . $exception->getMessage();
} 
?>
<?php require'../includes/header.php'; ?>
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Edit blogpost</a></div>
                        </div>
                        <div class="panel-group" id="manage1">
                            <div class="panel-body">
                                <div class="col-sm-4">

                                    <form name="post-input" action="#" method="post" role="form">
                                        <div class="form-group">
                                            <label for="InputTitle">Title:</label>
                                            <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Title" value='<?php echo $post_title;  ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputImage">Image path:</label>
                                            <input type='text' class="form-control" name="image_path" id="InputImage" value='<?php echo $image_path;  ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputContent">Content:</label>
                                            <textarea class="form-control" name="post_content" id="InputContent" rows='10' placeholder="Your text"><?php echo $post_content;  ?></textarea>
                                        </div>
                                        <div class="form-group">
                                           <label for="input-categories">Categories:</label><br>
                                           <select class="form-control"name="category">
                                            <option value="General Blog"><?php echo $category_name; ?></option>
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
                                    Publish:
                                        <input type="radio" name="visible" value="0"/> No&nbsp
                                        <input type="radio" name="visible" value="1"/> Yes&nbsp<br>
                                    <label>
                                        <input type='hidden' name='id' value='<?php echo $id ?>' /> 
                                        <input type='hidden' name='action' value='update' />

                                        <button type="submit" name="submit" class="btn btn-info">Update</button>
                                    </label>
                                </form>
                            </div>
                        </div><!--! /.panel-body -->
                    </div><!--! /.panel-collapse -->
                </div><!--! /.panel-info -->
            </div><!--! /.panel-group -->
        </div><!--! /.col-sm-12 -->
    </div><!-- /.row -->
</div>