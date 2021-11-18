<?php
include "includes/header.php";
include "includes/dbh.inc.php";
?>
<?php
    $sql = "SELECT * FROM products ORDER BY product_title ASC";
    $results = $conn->query($sql);
?>
<div class="container">
    <div class="row">
        <?php while($row = $results->fetch_assoc()){ ?>
                <div class="col-md-4">
                    <div class="card" style="width:400px;margin: 1vw">
                        <?php  $imageURL = 'products/'.$row["file_name"]; ?>
                        <img class="card-img-top" src="<?php echo $imageURL; ?>" alt="Card image" style="width:100%" width="270" height="270">
                        <div class="card-body" >
                            <h4 class="card-title"><?php echo $row['product_title'] ?></h4>
                            <p class="card-text"><?php echo $row['product_subtitle'] ?></p>
                            <span><strong><?php echo $row['product_price'] ?></strong></span><br>
                            <button name="prod_add" type="submit" id="button"  class="btn btn-primary button6" onclick="plusOne(cart)">Dodaj u košaricu</button>
                        </div>
                    </div>
                </div>
        <?php }
        ?>
    </div>
</div>
<script type="text/javascript">
    let number = 0;
    function plusOne(button) {
        number++;
        button.textContent = number.toString();
    }
</script>

<?php
include "includes/footer.php";
?>



