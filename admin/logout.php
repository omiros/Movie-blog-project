<?php require '../includes/session.php' ?>
<?php require '../includes/functions.php' ?>
<?php

$_SESSION['email'] = null;
$_SESSION['status'] = null;
session_destroy();
redirect_to('../public/index.php');

?>