<?php

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    $targetDir = "../profile-picture/";
    $UserFileName = "guest.png";
    $targetFilePath = $targetDir . $UserFileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','webp','JPG','png','jpeg','gif','pdf');

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false){

        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invaildUid($username) !== false){

        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invaildEmail($email) !== false){

        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false){

        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false){

        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd,$UserFileName);

} else{
    header("location: ../signup.php");
    exit();
}