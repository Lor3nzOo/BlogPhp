<?php
    include "includes/header.php";
?>
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <form action="includes/signup.inc.php" method="POST">
                <input type="text" name="name" placeholder="Ime i prezime"><br>
                <input type="text" name="uid" placeholder="Korisničko ime"><br>
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="pwd" placeholder="Lozinka"><br>
                <input type="password" name="pwdrepeat" placeholder="Ponovno upišite lozinku"><br>
                <button class="login sign-up" type="submit" name="submit">Registriraj Se</button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_GET["error"])){
        if ($_GET["error"] == "emptyinput"){
            echo "<p>Popunite sva polja!</p>";
        } elseif ($_GET["error"] == "invalidUid"){
            echo "<p>Unesite odgovarajuće korisničko ime!</p>";
        } elseif ($_GET["error"] == "invalidemail"){
            echo "<p>Unesite odgovarajući email!</p>";
        } elseif ($_GET["error"] == "passwordsdontmatch"){
            echo "<p>Lozinke se ne podudaraju!</p>";
        } elseif ($_GET["error"] == "stmtfailed"){
            echo "<p>Nešto je pošlo po zlu, pokušajte ponovno!</p>";
        } elseif ($_GET["error"] == "usernametaken"){
            echo "<p>Korisničko ime je zauzeto!</p>";
        } elseif ($_GET["error"] == "none"){
            echo "<p>Uspješno ste se registrirali!</p>";
        }
    }
    ?>
</div>

<?php
    include "includes/footer.php";
?>
