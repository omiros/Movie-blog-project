<?php require'../includes/session.php'; ?>
<?php require'../includes/functions.php'; ?>
<?php

if(isset($_POST["submit"])) {
    //target file path with the name of the file
    $target_file = "../uploads/" . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    //move uploaded file to the uploads folder & set $_SESSION
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION["last_uploaded_filename"] = basename( $_FILES["fileToUpload"]["name"]);
        $_SESSION['message'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        redirect_to('new_posts.php');
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
/*
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
*/
