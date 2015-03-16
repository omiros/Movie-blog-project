<?php require'../includes/session.php'; ?>
<?php require'../includes/db_connect.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php
//include database connection
include '../includes/db_connect.php';
 
try {
 
    // delete query
    $query = "DELETE FROM admins WHERE admin_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $_GET['id']);
 
    if($result = $stmt->execute()){
        $_SESSION['message'] = 'User deleted';
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
