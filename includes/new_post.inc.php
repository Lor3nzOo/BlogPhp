<?php
if (isset($_POST["post_submit"]) && !empty($_FILES["file"]["name"])){

    $post_name = $_POST["post_name"];
    $post_details = $_POST["post_details"];
    $dateTime = new DateTime( "now", new DateTimeZone( "Europe/Zagreb" ) );
    $post_date = $dateTime->format( 'Y-m-d H:i');

    $targetDir = "../uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','JPG','png','jpeg','gif','pdf');

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputPost($post_name, $post_details) !== false){

        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    newPost($conn, $post_name,$post_date,$post_details,$fileName);
}
else{
    header("location: ../admin.php");
    exit();
}