<?php
    include "includes/header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="includes/login.inc.php" method="POST">
                <?php
                if (isset($_GET["error"])){
                    if ($_GET["error"] == "emptyinput"){
                        echo "<p class='warning'>Popunite sva polja!</p><br>";
                    } elseif ($_GET["error"] == "wronglogin"){
                        echo "<p class='warning'>Provjerite podatke i pokušajte ponovno!</p><br>";
                    }
                }
                ?>
                <input type="text" name="uid" placeholder="Korisničko ime ili email"><br>
                <input type="password" name="pwd" placeholder="Lozinka"><br>
                <button class="login" type="submit" name="submit">Prijava</button><br>
                <a class="signup" href="signup.php">Nemam račun</a>
            </form>
        </div>
    </div>
</div>
<?php
    include "includes/footer.php";
?>

