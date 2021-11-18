<?php
include "includes/header.php";
include "includes/dbh.inc.php";
?>
<?php
$user = $_SESSION["useruid"];
$sql_users = "SELECT * FROM users WHERE usersUid='$user'";
$result_users = $conn->query($sql_users);

while($row_users = $result_users->fetch_assoc()) {
?>
<div style="align-items:center;" class="container">
    <div class="row">
        <div class="col-md-12">
            <table style="margin-top: 27vh" class="table">
                <tr>
                    <th style="white-space: nowrap">Moj Id</th>
                    <th style="white-space: nowrap">Moje Ime</th>
                    <th style="white-space: nowrap">Moj Email</th>
                    <th style="white-space: nowrap">Moje Korisničko ime</th>
                    <th style="white-space: nowrap">Moja Slika</th>
                    <th style="white-space: nowrap"></th>
                </tr>



                    <tr>
                        <td style="white-space: nowrap;vertical-align: top;"><?php echo $row_users['usersId'] ?></td>
                        <td style="white-space: nowrap;vertical-align: top;"><?php echo $row_users['usersName'] ?></td>
                        <td style="white-space: nowrap;vertical-align: top;"><?php echo $row_users['usersEmail'] ?></td>
                        <td style="white-space: nowrap;vertical-align: top;"><?php echo $row_users['usersUid'] ?></td>
                        <?php  $imageURL = 'profile-picture/'.$row_users["file_name"]; ?>
                        <td style="white-space: nowrap;"><img class="edit_image" style="border-radius: 50vw;max-width: 3vw;" src="<?php echo $imageURL; ?>" alt="" /></td>
                        <td style="vertical-align: top;"><a class="delete" href="edit_user.php">Uredi</a></td>
                    </tr>
            </table>
        </div>
    </div>
</div>
<?php }

?>


<?php
include "includes/footer.php";
?>

