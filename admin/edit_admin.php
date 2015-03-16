<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php confirm_logged_in(); ?>
<?php
$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
if($action == "update"){
    try{
        $query = "UPDATE admins SET email = :email, username = :username, password  = :password WHERE admin_id = :id";
 
        $stmt = $connection->prepare($query);
        //bind the parameters
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':id', $_POST['id']);
 
        if($stmt->execute()){
            $_SESSION['message'] = "Admin was updated";
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
    $query = "SELECT * FROM admins WHERE admin_id = ? LIMIT 0,1";
    $stmt = $connection->prepare( $query );
 
    $stmt->bindParam(1, $_REQUEST['id']);
 
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    //values to fill up our form
    $id = $row['admin_id'];
    $email = $row['email'];
    $username = $row['username'];
    $password = $row['password'];
 
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
                            Edit user</a></div>
                        </div>
                        <div class="panel-group" id="manage1">
                            <div class="panel-body">
                                <div class="col-sm-4">

                                    <form name="post-input" action="#" method="post" role="form">
                                        <div class="form-group">
                                            <label for="InputTitle">Email:</label>
                                            <input type="text" class="form-control" id="InputEmail" name="email" placeholder="Email" value='<?php echo $email;  ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputImage">Username:</label>
                                            <input type='text' class="form-control" name="username" id="InputUsername" value='<?php echo $username;  ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputContent">Password:</label>
                                            <input type='password' class="form-control" name="password" id="InputPassword" value='<?php echo $password;  ?>'>
                                        </div>
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
