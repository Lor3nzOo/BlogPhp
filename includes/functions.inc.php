<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invaildUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invaildEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if ($pwd !== $pwdRepeat){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $name, $email, $username, $pwd,$UserFileName) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, file_name) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd,$UserFileName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}
function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        if ($_SESSION["useruid"] == "admin"){
            header("location: ../admin.php");
            exit();
        }
        exit();
    }
}
function emptyInputPost($post_name, $post_details) {
    $result;
    if (empty($post_name) || empty($post_details)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function newPost($conn,$post_name,$post_date,$post_details,$fileName){
    $sql = "INSERT INTO posts (name,time,details,file_name) VALUES ('$post_name','$post_date','$post_details','".$fileName."');";

    if ($conn->query($sql) === TRUE) {
        header("location: ../admin.php");
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function emptyInputCom($com) {
    $result;
    if (empty($com)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function newCom($conn,$post_id,$com,$com_date,$user_com){
    $sql = "INSERT INTO comments (com,post_id,date,user) VALUES ('$com','$post_id','$com_date','$user_com');";

    if ($conn->query($sql) === TRUE) {
        header("location: index.php");
        echo "Comment posted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
function emptyInputProduct($prod_title,$prod_subtitle,$prod_price) {
    $result;
    if (empty($prod_title) || empty($prod_subtitle) || empty($prod_price)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function newProd($conn,$ProdFileName,$prod_title,$prod_subtitle,$prod_price){
    $sql = "INSERT INTO products (file_name,product_title,product_subtitle,product_price) VALUES ('".$ProdFileName."','$prod_title','$prod_subtitle','$prod_price');";

    if ($conn->query($sql) === TRUE) {
        header("location: ../admin.php");
        echo "Comment posted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


