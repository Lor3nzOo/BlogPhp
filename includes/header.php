<?php
    session_start();
    error_reporting(0);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>MedMelon</title>
</head>
<body>
<nav>
    <div class="container">
        <div class="row">
            <?php
                if(basename($_SERVER['PHP_SELF']) === 'proizvodi.php') {
                    echo "<div class='col-md-2'>";
                } else{
                    echo "<div class='col-md-3'>";
                }
            ?>
                <a href="index.php" class="logo">Lor3nzov Blog</a>
            </div>
            <?php
                if(basename($_SERVER['PHP_SELF']) === 'proizvodi.php') {
                    echo "<div class='col-md-10'>";
                } else{
                    echo "<div class='col-md-9'>";
                }
            ?>
                <ul class="main-menu">
                    <li>
                    <?php
                        if ($_SESSION["useruid"] == "admin"){
                            echo "<a href='admin.php'>Početna</a>";
                        } else{
                            echo "<a href='index.php'>Početna</a>";
                        }
                    ?>
                    </li>
                    <li>
                        <a href="#">Kontakt</a>
                    </li>
                    <li>
                        <a href="proizvodi.php">Proizvodi</a>
                    </li>
                    <?php
                        if (isset($_SESSION["useruid"])){
                            echo "<li><a href='profile.php'>Moj račun</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Odjavi se</a></li>";
                        } else{
                            echo "<li><a href='login.php'>Prijava</a></li>";
                        }
                        if(basename($_SERVER['PHP_SELF']) === 'proizvodi.php') {
                            echo "<li><a href='cart.php'><i class='fas fa-shopping-cart'></i>Košarica</a><span id='cart'> 0 </span></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
