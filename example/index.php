<?php
    $pageName = "Index";
    include ('./header.php');
    if(isset($_GET['catPage'])){
        // validate GET
        $totalPages = getCatPages($dbh);
        $catPage = validateCatPage($_GET['catPage'], $totalPages);
    }else{
        $catPage = 1;
    }
    
    $status;
    if(isset($_POST['cartAdd'])){
        $itemCount = countEntries($dbh, null);
        $validatedAdd = validateProdSelect($_POST['cartItem'], $itemCount, null);
        
        if(addToCart($validatedAdd, $sessionid, $dbh)){
            $status = "Added to cart item $validatedAdd";
        }else{
            $status = "Failed to cart item $validatedAdd";
        }
        // var_dump($_SESSION['cart']);
        
        
    }


?>

<h2>Welcome!</h2>
<p>Welcome to the Store Store! A place where you can buy all your favorite stores and more!</p>

<div class="status">
    <?php
        if(isset($status)){
            echo "<h4 class='status'>" . $status . "</h4>";
        }
    ?>
</div>

<?php

    // makeCatalog($dbh, null, null);
    echo "<div class='catalog'>";
    echo "<h2>On Special Offer!</h2>";
    makeCatalog($dbh, $catPage, true); // send in catPage to keep track of current catalog page
    echo "</div>";

    echo "<hr />";

    echo "<div class='catalog'>";
    echo "<h2>Catalog</h2>";
    makeCatalog($dbh, $catPage, false);
    echo "</div>";

?>

<?php include ('./footer.php'); ?>