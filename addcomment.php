<?php
if (isset($_POST["com_submit"])){


    include 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    $user_com = $_POST['user'];

    $com = $_POST["com_input"];
    $post_id = $_POST['id'];

    $dateTime = new DateTime( "now", new DateTimeZone( "Europe/Zagreb" ) );
    $com_date = $dateTime->format( 'Y-m-d H:i');

    if (emptyInputCom($com) !== false){

        header("location: index.php?error=emptyinput");
        exit();
    }

    newCom($conn,$post_id,$com,$com_date,$user_com);
}
else{
    header("location: index.php");
    exit();
}