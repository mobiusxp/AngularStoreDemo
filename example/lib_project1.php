<?php

    /*
        Functions to get items for the front page
        The pdo object has to be passed through because the global pdo variable
        has some issues if it is just called
    */

    // Get all items in the database
    function getAllItems($pageNum, $pdodb){
        $query = "SELECT * FROM `product`;";
        if(isset($pageNum)){
            $startingId = (($pageNum-1) * 6)+1; // get six entries based on page number
            $query = "SELECT * FROM `product` WHERE id >= :startingId LIMIT 6";
        }
        $params[":startingId"] = $pageNum;
        $items = null;
        $result = getData($query, $params, $pdodb);
        $items = mapItems($result);
        return $items;
    }
    
    // Get items that are sellable only
    function getSellableItems($pageNum, $pdodb){
        // get the bounds for page limit based on page location
        $lowerBound = (($pageNum-1) * 6);
        $upperBound = $pageNum * 6;
        $query = "SELECT * FROM `product` WHERE sellable = 1 AND discounted = 0 LIMIT :lower, 6";
        $params[":lower"] = $lowerBound;
        // $params[":upper"] = $upperBound;
        return getItems($query,$params, $pdodb);
    }
    
    // Only get discounted items
    function getDiscountedItems($pdodb){
        $query = "SELECT * FROM `product` WHERE discounted = 1 AND sellable = 1 LIMIT 5";
        return getItems($query,null, $pdodb);
    }

    // Get items from the database
    function getItems($query, $params, $pdodb){
        $items = null;
        $result = getData($query, $params, $pdodb);
        $items = mapItems($result);
        return $items;
    }

    // Get one item only
    function getItem($itemNum, $pdodb){
        $query = "SELECT * FROM product WHERE id = ?";
        $params;
        $params[1] = $itemNum;
        return getItems($query, $params, $pdodb );
    }



    // Get the result of an item query and return it as item objects
    function mapItems($items){
        $mappedItems;
        foreach($items as $item => $values){
            $item = new Product();
            foreach($values as $key=>$value){
                $item->$key = $value;
            }
            $mappedItems[] = $item;
        }
        return $mappedItems;
    }
    
    // Get the total count for entries to determine page numbering, etc.
    function countEntries($pdo, $sale){
        $query = "SELECT count(*) FROM product";
        // check for $sale, if unset then just count all entries in product table
        if(isset($sale)){
            if($sale){
                $query = "SELECT count(*) FROM product WHERE discounted = 1 AND sellable = 1";
            }else{
                $query = "SELECT count(*) FROM product WHERE discounted = 0 AND sellable = 1";
            }
        }
        $result = getData($query, null, $pdo);
        $count = $result[0];
        foreach($count as $key=>$value){
            $count = $value; // our getData returns arrays, need to just grab it out of the array
        }
        // echo "<p>Count Entries! $sale , $count </p>";
        return $count;
    }
    
    // Get the category pages
    function getCatPages($pdo){
        $count = countEntries($pdo, false);
        $pageCount = $count / 6;
        $pageCount = ceil($pageCount);
        // echo "<p>Page count $pageCount</p>";
        if($pageCount <= 1){
            $pageCount = 1;
        }
        return $pageCount;
    }

    // Create the HTML for sellable items
    // $pageNum - page number, $sale - catalog for all items or discounted only
    function makeCatalog($pdo,$pageNum, $sale){
        
        //Get the number of pages to make
        $pageCount = getCatPages($pdo);
        
        // echo $count . " " . intval($count) . "<br />";
        $items;
        echo "<div class='row'>";
        if(isset($sale)){
            if($sale){
                // output only for discounted items
                $items = getDiscountedItems($pdo);
                catalogPrintRow($items, $pageNum);
            }else{
                // show sellable non-discounted items
                $items = getSellableItems($pageNum, $pdo);
                catalogPrintRow($items, $pageNum);
            }
        }else{
            // lay out all items
            $items = getAllItems(1,$pdo);
            catalogPrintRow($items, $pageNum);            
        }
        echo "</div>";
        
        // Create the navigation bar for the catalog page
        if(!$sale){
            echo "<div class='row'>";
                echo "<div class='col-md-12'>";
            
                // [<<] [<] [>][>>] in HTML entities
                $oneBack = "&lsqb;&lt;&rsqb;"; // [<]
                $toStart = "&lsqb;&lt;&lt;&rsqb;"; // [<<]
                $oneFwd = "&lsqb;&gt;&rsqb;"; // [>]
                $toEnd = "&lsqb;&gt;&gt;&rsqb;"; // [>>]
            
                if($pageNum == 1){
                    echo "$toStart $oneBack";
                }else{
                    echo "<a href='./index.php?catPage=1'>$toStart</a>";
                    echo "<a href='./index.php?catPage=". ($pageNum - 1) ."'>$oneBack</a> ";
                }
                for($i=0; $i<$pageCount; $i++){
                    $pageLink = $i + 1;
                    if($pageLink == $pageNum){
                        echo $pageLink;
                    }else{
                        echo "<a href='./index.php?catPage=$pageLink'>$pageLink</a>";
                    }
                }
                if($pageNum == $pageCount){
                    echo " $oneFwd $toEnd ";
                }else{
                    echo " <a href='./index.php?catPage=". ($pageNum + 1) ."'>$oneFwd</a>";
                    echo "<a href='./index.php?catPage=$pageCount'>$toEnd</a>";
                    
                }
                echo "</div>";
            echo "</div>";
        }

    }
    

    // Echo out the object html and make sure they are in rows of 3
    function catalogPrintRow($items, $pageNum){
        $index=0;
        foreach($items as $key=>$value){
            $value->toShopHtml($pageNum);
            $index++;
            if($index == 3){
                echo "</div><div class='row'>";
            }
        }
    }

    /*
        Functions for the cart
    */

    // Add and keep quantity of items in cart / create if one doesn't exist
    // and then lower the count
    function addToCart($itemId, $sessionid, $pdo){
        $cart;
        $item = getItem($itemId, $pdo);
        $item = $item[0];
        $item_count = $item->quantity;
        
        // Check if item can be sold
        if($item_count < 1){
            return false;   
        }else{
            // Check if a cart already exists
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                if(array_key_exists($itemId, $cart)){
                    $val = $cart["$itemId"];
                    $val++;
                    $cart["$itemId"]=$val;
                }else{
                    $cart["$itemId"] = 1;
                }
            }else{
                $cart["$itemId"]=1;
            }

            // Decrease the quantity
            $item->quantity = $item_count - 1;
            $item->update($pdo);

            $_SESSION['cart'] = $cart;
            setCartDb($sessionid, $cart, $pdo);
            
            return true;
        }
    }


    function outputCart($sessionid, $cart, $pdo){
        $total = 0;
        $dbcart = getCartDb($sessionid, $pdo);
        foreach($dbcart as $itemId => $quant){
            $item = getItem($itemId, $pdo);
            $item = $item[0];
            $itemTotal = 0;
            if($item->discounted == 1){
                $itemTotal = calcPrice($item->salePrice, $quant);
                $total += $itemTotal;
            }else{
                $itemTotal = calcPrice($item->price, $quant);
                $total += $itemTotal;
            }
            
            echo "<div class='cartItem row'>";
            $item->toCartHtml();
            echo "<div class='col-md-4 itemPrice'>";
            if($item->discounted == 1){
                echo "<p>$quant at $".number_format($item->salePrice, 2)."  each";
            }else{
                echo "<p>$quant at $" . number_format($item->price, 2) . " each";    
            }
            echo "</p>";
            // number_format( float $number [, $decimals = 2 ] );
            echo "<p>$" . number_format($itemTotal, 2) . "</p>";
            echo "</div>";
            
            echo "</div>";
        }
        
        echo "<div class='cartTotal row'>";
        echo "<div class='col-md-8'>";
        echo "<form action='cart.php' method='post'>";
        echo "<button type='submit' name='emptyCart'>Empty Cart</button>";
        echo "</form>";
        echo "</div>";
        echo "<div class='col-md-4'>";
        echo "<p>Your total: $$total";
        echo "</div>";
        echo "</div>";
        
    }
    
    // Get cart from database and return it
    function getCartDb($sessionid, $pdo){
        $query = "SELECT * FROM carts WHERE id = :id";
        $params[":id"] = $sessionid;
        $result = getData($query, $params, $pdo);
        $cart = $result[0]["items"];
        if(isset($cart)){
            $cart = get_object_vars(json_decode($cart));
        }
        return $cart;
    }

    // Insert a cart into the database
    function setCartDb($sessionid, $cart, $pdo){
        $dbCart = getCartDb($sessionid, $pdo);
        $query;
        $params;
        $cartString = json_encode($cart);
        if(isset($dbCart)){
            $query = "UPDATE carts SET items=:cartText WHERE id=:sessionId ";
        }else{
            $query = "INSERT INTO carts(id, items) VALUES (:sessionId, :cartText)";
        }

        $params[":cartText"] = $cartString;
        $params[":sessionId"] = $sessionid;
        
        setData($query, $params, $pdo);   
    }

    function emptyCartDb($sessionid, $pdo){
        $query = "DELETE FROM carts WHERE id=:sessionId";
        $params[":sessionId"] = $sessionid;
        setData($query, $params, $pdo);
    }

    // Take a cart array and turn it into a storable string
    function makeCartString($cart){
        
    }

    // Take a string from the db and turn it into a cart array
    function makeCart($cart){
        
    }

    function calcPrice($price, $quant){
        $price = $price * $quant;
        return $price;
    }

    /*
        Functions for the admin page
    */

    // Take a product and modify its values based on received params and return
    function modifyProduct($product, $attrs){ 
        foreach($attrs as $key=>$value){
            $product->$key = $value;
        }
            
            // Form checkboxes submit as "on" or unset
        if($product->sellable == "on"){
            $product->sellable = 1;
        }else{
            $product->sellable = 0;
        }
        if($product->discounted == "on"){
            $product->discounted = 1;
        }else{
            $product->discounted = 0;
        }
        
        return $product;
    }

    function checkLogin($user, $pass, $pdo){
        $query = "SELECT userName, admin from users WHERE userName = :userName AND pass = SHA1(:pass);";
        $params[":userName"] = $user;
        $params[":pass"] = $pass;
        $result = getData($query, $params, $pdo);
        if(count($result) != 0){
            if($result[0]["userName"] == $user && $result[0]["admin"] == 1 ){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /*
        Output is sanitized to maintain pure data in db
    */
    function sanitizeOutput($input){
        $output = htmlentities($input);
        $output = strip_tags($output);
        
        
        return $output;
    }

    /*
        Input is sanitized for validation
    */
    function sanitizeInput($input){
        $output = trim($input);
        return $output;
    }

    function sanitizeFormInput($form){
        $output;
        foreach($form as $key=>$value){
            $output["$key"] = trim($value);
        }
        return $output;
    }

    // Upload the image, return true if success, false if failed
    function uploadImage($file){
        $dir = "./images/products/";
        $uploadFile = $dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
            // resizeImage($uploadFile); // imageMagick?
            return true;
        } else {
            return false;
        }
    }

    
?>