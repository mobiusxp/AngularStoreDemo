<?php
    $pageName = "Cart";
    include ('./header.php');

    if(isset($_POST['emptyCart'])){
        unset($_SESSION['cart']);
        emptyCartDb($sessionid, $dbh);
    }

?>

<h2>Your Cart</h2>
<div class="cart">
    
    <?php
        if(isset($_SESSION['cart'])){
            //var_dump($_SESSION['cart']);
            outputCart($sessionid, $_SESSION['cart'], $dbh);
        }else{
            echo "<div class='row'>";
            echo "<div class='col-md-12'><h3> Your cart is empty! Go Shopping!</h3></div>";
            echo "</div>";
        }
    
    ?>

</div>

<?php include ('./footer.php'); ?>