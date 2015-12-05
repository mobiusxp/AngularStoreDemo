<?php
    $pageName = "Admin Panel";
    include ('./header.php');
    $allItems = getAllItems(null, $dbh);
    $toEdit = null;
    $errorVars = null;
    $statusMsg = null;

    // Set a variable to kill edit mode if they leave the page after a select
    $_SESSION['previous'] = basename($_SERVER['PHP_SELF']); 

    // Check if admin has authenticated
    if(isset($_SESSION['adminLogin'])){
        
    }else{
        echo "<h1>Unauthorized Access to admin panel</h1>";
        echo "<h2>Please <a href='index.php'>return to the store</a> or <a href='admin.php'>login</a></h2>";
        die();
    }
       
    // validate the input
    if(isset($_POST['selectEditSubmit'])){
        $validatedGet = validateProdSelect($_POST['selectEdit'], count($allItems), true);
        if(isset($validatedGet)){
            if($validatedGet != "newItem"){
            $_SESSION['editing'] = true;
            $toEdit = getItem($validatedGet, $dbh);
            $toEdit = $toEdit[0];
            $_SESSION['toEdit'] = $toEdit;
            }else{
                unset($_SESSION['editing']);
            }
        }else{
            $errorVars['selection'] = "You have picked an invalid item";
            unset($_SESSION['editing']);
        }
    }
    
    // On form submission
    if(isset($_POST['editSubmit'])){
        // If an item is being edited, use the product's update method, if not, create and use insert
        if(isset($_SESSION['editing']) && $_SESSION['editing']){
            $cleanedInput = sanitizeFormInput($_POST);
            $errorVars = validateAdminForm($cleanedInput, $_FILES["imgUpload"], $dbh);
                        
            $toEdit = $_SESSION['toEdit']; // Get the stored Product
            // Attempt to upload the image
            if(!isset($errorVars['formSubmit']) && isset($_FILES["imgUpload"]) && $_FILES["imgUpload"]["size"] > 0){
                if(uploadImage($_FILES["imgUpload"])){
                    $image = basename($_FILES["imgUpload"]["name"]);
                    $toEdit->imgName = $image;
                }else{
                    $errorVars['formSubmit']['upload'] = "Upload failed";
                }
            }
            
            // If validation passes, make the modifications to object and then update the database
            if(!(isset($errorVars['formSubmit']))){
                $toEdit = modifyProduct($toEdit, $cleanedInput);
                $toEdit->update($dbh);
                $statusMsg = "Successfully updated product: " . $toEdit->name;
                // End the editing mode
                unset($_SESSION['editing']); // Unset the session variable;
                unset($_SESSION['toEdit']);
                unset($toEdit); // Prevent the item from showing up on form again
            }
        }else{
            // Add a new item by creating a product and then adding to db
            $cleanedInput = $_POST;
            $errorVars = validateAdminForm($cleanedInput,$_FILES["imgUpload"], $dbh);
            $toEdit = new Product();
            
            // Attempt to upload the image
            if(!isset($errorVars['formSubmit']) && isset($_FILES["imgUpload"]) && $_FILES["imgUpload"]["size"] > 0){
                if(uploadImage($_FILES["imgUpload"])){
                    $image = basename($_FILES["imgUpload"]["name"]);
                    $toEdit->imgName = $image;
                }else{
                    $errorVars['formSubmit']['upload'] = "Upload failed";
                }
            }
            
            $toEdit = modifyProduct($toEdit, $cleanedInput);
            if(!(isset($errorVars['formSubmit']))){
                $toEdit->insert($dbh);
                $statusMsg = "Successfully added product: " . $toEdit->name;          
            }else{
                // We need to unset ONLY editing but keep the toEdit so that the submission to the form is a new product but the form displays the user's work without wiping it clean
                unset($_SESSION['editing']);
            }
        }
        
    }else{

    }

    
?>

<h2>Admin Panel <?php echo " - User: " . $_SESSION['adminLogin'] . "</h2>"; ?>

<h3>Add / Edit Item</h3>

<div id="status">
<?php 
    if(isset($errorVars['selection'])){
        echo "<p>" . $errorVars['selection']. "</p>";
    }
    if(isset($errorVars['formSubmit'])){
        echo "<h4>Errors found in submission:</h4>";
        echo "<ul>";
        foreach($errorVars['formSubmit'] as $error){
            echo "<li> $error </li>";
        }
        echo "</ul>";
    }
    if(isset($_SESSION['complete'])){
        echo "<p>Editing Completed</p>";
    }
    if(isset($statusMsg)){
        echo "<p>$statusMsg</p>";
    }

?>
</div>

<form id="selectEdit" action="admin_panel.php" method="post">
    <h4>Select a product:</h4>
    <select name="selectEdit">
        <option value="newItem">-- New Item --</option>
        <?php
            foreach($allItems as $key=>$value){
                echo "<option value='$value->id'". (($value->id == $toEdit->id)? 'selected=\'selected\'':" ") .">$value->name</option>";
            }
        ?>
    </select>
    <button type="submit" name="selectEditSubmit">Submit</button>
</form>

<?php 
    if(isset($_SESSION['editing']) && isset($toEdit)){ 
        echo "<h3> Editing Product: $toEdit->name </h3>";
    }else{
        // unset($_SESSION['editing']);
        echo "<h3>Add New Item</h3>";
    } 
?>
<h4>Item Details</h4>
<form id="infoEdit" action="admin_panel.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Item Name</label>
        <input class="form-control" type="text" id="name" name="name" value="<?php if(isset($toEdit)){echo $toEdit->name;}?>" />
    </div>
    
    <div class="form-group">
        <label for="description">Item Description</label>
        <input class="form-control" type="text" id="description" name="description" value="<?php if(isset($toEdit)){echo $toEdit->description;}?>" />
    </div>
    
    <div class="form-group">
        <label for="price">Price</label>
        <div class="input-group">
            <div class="input-group-addon">$</div>
            <input class="form-control" type="text" id="price" name="price" value="<?php if(isset($toEdit)){echo $toEdit->price;}?>" />
        </div>
    </div>
    
    <div class="form-group">
        <label for="saleprice">Discounted Price</label>
        <div class="input-group">
            <div class="input-group-addon">$</div>
            <input class="form-control" type="text" id="saleprice" name="salePrice" value="<?php if(isset($toEdit)){echo $toEdit->salePrice;}?>" />
        </div>
    </div>
    
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input class="form-control" type="text" id="quantity" name="quantity" value="<?php if(isset($toEdit)){echo $toEdit->quantity;}?>" />
    </div>
    
    <div class="form-group">
        <label for="imgUpload">Image</label>
        <input type="file" id="imgUpload" name="imgUpload">
    </div>
    
    <div class="checkbox">
        <label>
            <input type="checkbox" name="sellable" <?php if(isset($toEdit)){if($toEdit->sellable == 1){echo "checked";}} ?> > For Sale 
        </label>
        
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="discounted" <?php if(isset($toEdit)){if($toEdit->discounted == 1){echo "checked";}} ?> > Discounted 
        </label>
    </div>
    
    <button type="submit" class="btn btn-default" name="editSubmit">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>
    
</form>
    
<div class="settingsPanel">
    <!--
    <form action='./index.php?catPage=$pageNum' method='post'><input type='hidden' name='adminSetting'><input type='submit' name='></form>
    -->
</div>

<?php include ('./footer.php'); ?>