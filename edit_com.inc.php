<?php
    include "includes/header-overflow.php";
    include "includes/dbh.inc.php";
?>
<?php

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($conn,"SELECT * FROM comments where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['com_update'])) // when click on Update button
{
    $com_edit = $_POST['com_edit'];

    $edit = mysqli_query($conn,"UPDATE comments SET com='$com_edit' WHERE id='$id'");

    if($edit)
    {
        mysqli_close($conn); // Close connection
        header("location: index.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }
}
?>
<?php
$sql = "SELECT * FROM comments";
$results = $conn->query($sql);

while ($row = $results->fetch_assoc()) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">
                    <h1 class="text-center">Uredi Komentar</h1>
                    <textarea  cols="80" rows="10" name="com_edit" placeholder="Unesi komentar" Required><?php echo $data['com'] ?></textarea><br>
                    <button class="login" type="submit" name="com_update">Spremi Promjene</button><br>
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
