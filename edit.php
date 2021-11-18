<?php
    include "includes/header.php";
    include "includes/dbh.inc.php";
?>
<?php

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($conn,"SELECT * FROM posts where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $name_edit = $_POST['name_edit'];
    $details_edit = $_POST['details_edit'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','JPG','png','jpeg','gif','pdf');

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    if (empty($fileName)){
        $edit = mysqli_query($conn,"UPDATE posts SET name='$name_edit', details='$details_edit' WHERE id='$id'");

    } else{
        $edit = mysqli_query($conn,"UPDATE posts SET name='$name_edit', details='$details_edit', file_name='".$fileName."' WHERE id='$id'");
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
    $sql = "SELECT * FROM posts WHERE id='$id'";
    $results = $conn->query($sql);

    while ($row = $results->fetch_assoc()) {
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data">
                <h1 class="text-center">Uredi objavu</h1>
                <input type="text" name="name_edit" value="<?php echo $data['name'] ?>" placeholder="Unesi ime objave" Required><br>
                <textarea  cols="80" rows="10" name="details_edit" placeholder="Unesi opis objave" Required><?php echo $data['details'] ?></textarea><br>
                <?php  $imageURL = 'uploads/'.$row["file_name"]; ?>
                <img class="edit_image" src="<?php echo $imageURL; ?>" alt="" />
                <input type="file" name="file"><br>
                <button class="login" type="submit" name="update">Spremi Promjene</button><br>
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