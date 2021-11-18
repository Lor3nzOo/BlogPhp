<?php
include 'includes/header.php';
include "includes/dbh.inc.php";

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($conn,"SELECT * FROM posts where id='$id'"); // select query

$row = mysqli_fetch_array($qry);
?>
<div class="container mt-5">
    <div class="row"><h1 class="text-center"><?php echo $row['name'] ?></h1></div>
    <div class="row">
        <div class="col-md-2">
            <?php  $imageURL = 'uploads/'.$row["file_name"]; ?>
            <img class="post_image" src="<?php echo $imageURL; ?>" alt="" />
        </div>
        <div class="col-md-10">
            <p><?php echo  $row['details'] ?></p>
            <h2 class="obj">Objavljeno: <?php echo $row['time'] ?></h2>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
