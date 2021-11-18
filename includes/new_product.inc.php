<?php
if (isset($_POST["post_submit"]) && !empty($_FILES["file"]["name"])){

    $prod_title = $_POST["product_title"];
    $prod_subtitle = $_POST["product_subtitle"];
    $prod_price = $_POST["product_price"];

    $targetDir = "../products/";
    $ProdFileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $ProdFileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','webp','JPG','png','jpeg','gif','pdf');

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputProduct($prod_title,$prod_subtitle,$prod_price) !== false){

        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    newProd($conn,$ProdFileName,$prod_title,$prod_subtitle,$prod_price);
}
else{
    header("location: ../admin.php");
    exit();
}
