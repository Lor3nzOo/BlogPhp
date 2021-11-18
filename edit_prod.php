<?php
include "includes/header-overflow.php";
include "includes/dbh.inc.php";
?>
<?php

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($conn,"SELECT * FROM products where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['prod_update'])) // when click on Update button
{
    $prod_title = $_POST['title_edit'];
    $prod_subtitle = $_POST['subtitle_edit'];
    $prod_price = $_POST['price_edit'];

    $targetDir = "products/";
    $ProdFileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $ProdFileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','webp','JPG','png','jpeg','gif','pdf');

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    if (empty($ProdFileName)){
        $edit = mysqli_query($conn,"UPDATE products SET product_title='$prod_title', product_subtitle='$prod_subtitle', product_price='$prod_price' WHERE id='$id'");

    } else{
        $edit = mysqli_query($conn,"UPDATE products SET file_name='".$ProdFileName."', product_title='$prod_title', product_subtitle='$prod_subtitle', product_price='$prod_price' WHERE id='$id'");
    }


    if($edit)
    {
        mysqli_close($conn); // Close connection
        header("location: admin.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }
}
?>
<?php
$sql = "SELECT * FROM products WHERE id='$id'";
$results = $conn->query($sql);

while ($row = $results->fetch_assoc()) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">
                    <h1 class="text-center">Uredi Proizvod</h1>
                    <input type="text" name="title_edit" value="<?php echo $data['product_title'] ?>" placeholder="Unesi ime proizvoda" Required><br>
                    <textarea  cols="80" rows="10" name="subtitle_edit" placeholder="Unesi opis proizvoda" Required><?php echo $data['product_subtitle'] ?></textarea><br>
                    <?php  $imageURL = 'products/'.$row["file_name"]; ?>
                    <img class="edit_image" src="<?php echo $imageURL; ?>">
                    <input type="file" name="file"><br>
                    <input type="text" name="price_edit" value="<?php echo $data['product_price'] ?>" placeholder="Unesi cijenu proizvoda"><br>
                    <button class="login" type="submit" name="prod_update">Spremi Promjene</button><br>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php
include "includes/footer.php";
?>