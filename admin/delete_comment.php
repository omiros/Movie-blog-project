<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php 
try {
 
    // delete query
    $query = "DELETE FROM comments WHERE comment_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $_GET['id']);
 
    if($result = $stmt->execute()){
        $_SESSION['message'] = "Comment deleted.";
        // redirect to index page
        redirect_to('admin.php');
    }
    else{
        die('Unable to delete record.');
    }
}
 // to handle error
catch(PDOException $exception){
    echo "Error: " . $exception->getMessage();
}
?>