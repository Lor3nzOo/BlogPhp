<?php
    include "includes/header.php";
    include "includes/dbh.inc.php";
?>
<?php
    $sql = "SELECT * FROM posts ORDER BY time DESC";
    $results = $conn->query($sql);
    $sql_max = "SELECT MAX(time) FROM posts";
    $result_max = $conn->query($sql_max);

function custom_echo($x, $length)
{
    if(strlen($x)<=$length)
    {
        echo $x;
    }
    else
    {
        $y=substr($x,0,$length) . '...';
        echo $y;
    }
}
?>
<div class="posts">
    <div class="container">
        <div class="row">
        <?php while($row = $results->fetch_assoc()){ ?>
            <div class="col-md-12">
                <div class="post-inner">
                    <?php while($row_max = $result_max->fetch_assoc()){ ?>
                        <span class="new_title">Novo!</span>
                    <?php } ?>
                    <h1><?php echo $row['name'] ?></h1>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                                <?php  $imageURL = 'uploads/'.$row["file_name"]; ?>
                                <img class="post_image" src="<?php echo $imageURL; ?>" alt="" />
                            </div>
                            <div class="col-md-7">
                                <p><?php custom_echo($row['details'], 461); ?></p>
                                <?php if (strlen($row['details']) >= 461){
                                        $row_id = $row["id"];
                                        echo "<a class='continue' href='post.php?id=$row_id'>Nastavi čitati</a>";
                                      }
                                ?>
                            </div>
                            <div class="col-md-3">
                                <form class="com_form" action="addcomment.php" method="POST">
                                    <input type="hidden" name="user" value="<?php if (isset($_SESSION["useruid"])){
                                        echo $_SESSION["useruid"];
                                    } else{
                                        echo "Gost";
                                    }?>">
                                    <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                                    <textarea rows="3" cols="35" name="com_input" placeholder="Napiši komentar..."></textarea>
                                    <button class="login" type="submit" name="com_submit">Komentiraj</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h4>Komentari</h4>
                    <?php
                    $post_id = $row["id"];
                    $sql_com = "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY date DESC";
                    $results_com = $conn->query($sql_com);
                    while ($row_com = $results_com->fetch_assoc()){
                        ?>
                    <div class="comments">
                        <?php
                        $user = $row_com['user'];
                        $sql_users = "SELECT * FROM users WHERE usersUid='$user'";
                        $result_users = $conn->query($sql_users);

                        while($row_users = $result_users->fetch_assoc()) {

                            if ($row_com['user'] !== "Gost") {
                                $imageURL = 'profile-picture/' . $row_users["file_name"];
                                echo "<img style='border-radius: 10vw;max-width: 3vw' class='edit_image' src='$imageURL'/>";
                            } else {
                                echo "<img style='border-radius: 10vw;max-width: 3vw' class='edit_image' src='profile-picture/guest.png'/>";
                            }
                        }
                        ?>
                        <h5><?php if ($row_com['user'] === "admin"){
                                $user_com = $row_com['user'];
                                echo "<strong class='admin_user'>$user_com</strong>";
                            }else{
                                echo $row_com['user'];
                            }?></h5>
                        <p><?php echo $row_com['com'] ?></p>
                        <h6><?php echo "Objavljeno: ";echo $row_com['date'] ?></h6>
                        <?php if (isset($_SESSION["useruid"])){
                            if ($_SESSION["useruid"] === $row_com['user']){
                                $com_id = $row_com['id'];
                                $com = $row_com['com'];
                                echo "<a class='delete' href='includes/del_com.inc.php?id= $com_id'>Izbriši komentar</a>";
                                echo "<a class='delete' href='edit_com.inc.php?id=$com_id'>Uredi komentar</a>";
                            } elseif ($_SESSION["useruid"] === "admin"){
                                $com_id = $row_com['id'];
                                $com = $row_com['com'];
                                echo "<a class='delete' href='includes/del_com.inc.php?id= $com_id'>Izbriši komentar</a>";
                            }
                        }
                        ?>
                    </div>
                    <?php }

                    ?>
            </div>
        </div>
            <?php }

            ?>
    </div>
</div>
</div>
<?php
    include 'includes/footer.php';
?>