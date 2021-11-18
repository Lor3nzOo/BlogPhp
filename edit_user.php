<?php
    include "includes/header-overflow.php";
    include "includes/dbh.inc.php";


$id = $_SESSION["useruid"];// get id through query string

$qry = mysqli_query($conn,"SELECT * FROM users where usersUid='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update_user'])) // when click on Update button
{
    $name_edit = $_POST['name_edit'];
    $email_edit = $_POST['email_edit'];
    $uid_edit = $_POST['uid_edit'];

    $targetDir = "profile-picture/";
    $UserFileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $UserFileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','JPG','png','jpeg','gif','pdf');

    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    if (empty($UserFileName)){
        $edit = mysqli_query($conn,"UPDATE users SET usersName='$name_edit', usersEmail='$email_edit', usersUid='$uid_edit' WHERE usersUid='$id'");

    } else{
        $edit = mysqli_query($conn,"UPDATE users SET usersName='$name_edit', usersEmail='$email_edit', usersUid='$uid_edit' ,file_name='".$UserFileName."' WHERE usersUid='$id'");
    }

    if($edit)
    {
        mysqli_close($conn); // Close connection
        header("location: profile.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }
}
?>
<?php
$sql = "SELECT * FROM users where usersUid='$id'";
$results = $conn->query($sql);
    ?>
<div class="container">
    <div class="row">
        <?php
        while ($row = $results->fetch_assoc()) {
        ?>
        <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data">
                <h1 class="text-center">Uredi Profil</h1>
                <input type="text" name="name_edit" value="<?php echo $data['usersName'] ?>" placeholder="Unesi ime" Required><br>
                <input type="text" name="email_edit" value="<?php echo $data['usersEmail'] ?>" placeholder="Unesi email" Required><br>
                <input type="text" name="uid_edit" value="<?php echo $data['usersUid'] ?>" placeholder="Unesi korisničko ime" Required><br>
                <?php  $imageURL = 'profile-picture/'.$row["file_name"]; ?>
                <img class="edit_image" src="<?php echo $imageURL; ?>" alt="" />
                <input type="file" name="file"><br>
                <button class="login" type="submit" name="update_user">Spremi Promjene</button><br>
            </form>
        </div>
            <?php
        }
        ?>
    </div>
</div>

<?php
include "includes/footer.php";
?>
