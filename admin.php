<?php
include "includes/header.php";
include "includes/dbh.inc.php";

if ($_SESSION['useruid'] !== "admin"){
    header('location: index.php');
}
?>
<div class="dodaj">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                    $sql = "SELECT * FROM posts";
                    $result = $conn->query($sql);
                ?>
                <table class="table">
                    <tr>
                        <th style="white-space: nowrap">Id Objave</th>
                        <th style="white-space: nowrap">Ime Objave</th>
                        <th style="white-space: nowrap">Vrijeme Objavljivanja</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <?php
                    while($row = $result->fetch_assoc()) {?>

                        <tr>
                            <td style="white-space: nowrap"><?php echo $row['id'] ?></td>
                            <td style="white-space: nowrap"><?php echo $row['name'] ?></td>
                            <td style="white-space: nowrap"><?php echo $row['time'] ?></td>
                            <td><a class="delete" href="edit.php?id=<?php echo $row['id']; ?>">Uredi</a></td>
                            <td><a class="delete" href="includes/delete.inc.php?id=<?php echo $row['id']; ?>">Izbriši</a></td>
                        </tr>

                    <?php }

                    ?>
                </table>
            </div>
            <div class="col-md-6">
                <form action="includes/new_post.inc.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyinput"){
                            echo "<p class='warning'>Popunite sva polja!</p><br>";
                        }
                    }
                    ?>
                    <input type="text" name="post_name" placeholder="Unesi ime objave"><br>
                    <textarea cols="80" rows="10" name="post_details" placeholder="Unesi sadržaj objave"></textarea><br>
                    <input type="file" name="file"><br>
                    <button class="login" type="submit" name="post_submit">Postavi na Blog</button><br>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="dodaj">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <?php
                $sql_prod = "SELECT * FROM products";
                $result_prod = $conn->query($sql_prod);
                ?>
                <table style="margin-top: 27vh" class="table">
                    <tr>
                        <th style="white-space: nowrap">Id Proizvoda</th>
                        <th style="white-space: nowrap">Slika Proizvoda</th>
                        <th style="white-space: nowrap">Ime Proizvoda</th>
                        <th style="white-space: nowrap">Opis Proizvoda</th>
                        <th style="white-space: nowrap">Cijena Proizvoda</th>
                    </tr>

                    <?php
                    while($row_prod = $result_prod->fetch_assoc()) {?>

                        <tr>
                            <td style="white-space: nowrap"><?php echo $row_prod['id'] ?></td>
                            <td style="white-space: nowrap"><?php echo substr($row_prod['file_name'], 0, 4)."..."; ?></td>
                            <td style="white-space: nowrap"><?php echo $row_prod['product_title'] ?></td>
                            <td style="white-space: nowrap"><?php echo substr($row_prod['product_subtitle'], 0, 4)."...";?></td>
                            <td style="white-space: nowrap"><?php echo $row_prod['product_price'] ?></td>
                            <td><a class="delete" href="edit_prod.php?id=<?php echo $row_prod['id']; ?>">Uredi</a></td>
                            <td><a class="delete" href="includes/del_prod.inc.php?id=<?php echo $row_prod['id']; ?>">Izbriši</a></td>
                        </tr>

                    <?php }

                    ?>
                </table>
            </div>
            <div class="col-md-5">
                <form action="includes/new_product.inc.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyinput"){
                            echo "<p class='warning'>Popunite sva polja!</p><br>";
                        }
                    }
                    ?>
                    <input type="text" name="product_title" placeholder="Unesi ime Proizvoda"><br>
                    <textarea cols="80" rows="10" name="product_subtitle" placeholder="Unesi opis Proizvoda"></textarea><br>
                    <input type="file" name="file"><br>
                    <input type="text" name="product_price" placeholder="Unesi cijenu proizvoda"><br>
                    <button class="login" type="submit" name="post_submit">Dodaj Proizvod</button><br>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>

