<?php 
    class Product{
        
        
        private $id, $name, $description, $price, $quantity, $imgName, $salePrice, $discounted, $sellable;
        
        function __construct($id = null, $name = "tbd", $description = "tbd", $price = "tbd", $quantity = "tbd", $imgName = null, $salePrice = "tbd", $discounted = false, $sellable = false){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->imgName = $imgName;
            $this->salePrice = $salePrice;
            $this->discounted = $discounted;
            $this->sellable = $sellable;
        }
           
        // Magic Methods (setter and getter)
        public function __set($property, $value){
            if(property_exists($this,$property)){
                $this->$property = $value;
            }
        }
        
        public function __get($property){
            if(property_exists($this,$property)){
                return sanitizeOutput($this->$property);
            }
        }
        
        // Database Operations
        // Add a new product
        public function insert($pdo){
            $query = "INSERT into product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES (:name, :description, :price, :quantity, :imgName, :salePrice, :discounted, :sellable);";
            $params = $this->packAttributes();
            setData($query,$params,$pdo);
        }
        
        // Update an existing product
        public function update($pdo){
            $query = "UPDATE product SET name = :name, description = :description, price = :price, quantity = :quantity, imgName = :imgName, salePrice = :salePrice, discounted = :discounted, sellable = :sellable WHERE id = :id;";
            $params = $this->packAttributes();
            setData($query,$params,$pdo);
        }
        
        //Delete this product from the db
        public function delete(){
            
        }
        
        // load all of the attributes of this object for query attributes
        private function packAttributes(){
            $attributes;
            if(isset($this->id)){
                $attributes[":id"] = $this->id;
            }
            $attributes[":name"] = $this->name;
            $attributes[":description"] = $this->description;
            $attributes[":price"] = $this->price;
            $attributes[":quantity"] = $this->quantity;
            $attributes[":imgName"] = $this->imgName;
            $attributes[":salePrice"] = $this->salePrice;
            $attributes[":discounted"] = $this->discounted;
            $attributes[":sellable"] = $this->sellable;
            
            return $attributes;
        }
        
        // Output this item to catalog HTML
        function toShopHtml($pageNum){
            echo "<div class='product col-md-4'>";
            echo "<div class='prodHolder'><span class='imgHelper'></span>";
            if($this->imgName != "tbd" ){
                echo "<img class='prodImg' src='./images/products/". $this->imgName ."' alt='". sanitizeOutput($this->name) ."'>"; 
            }
            echo "</div>";
            echo "<p class='prodName'>". sanitizeOutput($this->name) ."</p>";
            echo "<p class='prodDesc'>". sanitizeOutput($this->description) ."</p>";
            if($this->discounted == 1){
                echo "<p class='prodPrice'><span class='discount'>$$this->price</span> $". sanitizeOutput($this->salePrice). " <span class='saleText'>SALE!</span></p>";
            }else{
                echo "<p class='prodPrice'>$". sanitizeOutput($this->price) ."</p>";
            }
            echo "<p class='prodQuant'>" . ($this->quantity < 1?"Sold Out!":"Only ". sanitizeOutput($this->quantity) ." left!") . "</p>";
            echo "<form action='./index.php?catPage=$pageNum' method='post'><input type='hidden' name='cartItem' value='$this->id'><button type='submit' name='cartAdd'" . 
                ($this->quantity < 1?"disabled":"")
                . ">Add to cart</button></form>";
            echo "</div>";
        }
        
        // Output this item to the cart
        function toCartHtml(){
            echo "<div class='col-md-8'>";
            echo "<div class='cartImgHolder'><span class='imgHelper'></span>";
            if($this->imgName != "tbd" ){
                echo "<img class='cartImg' src='./images/products/". $this->imgName ."' alt='". sanitizeOutput($this->name) ."'>"; 
            }
            echo "</div>";
            echo "<p class='prodName'>". sanitizeOutput($this->name). "</p>";
            echo "<p class='prodDesc'>". sanitizeOutput($this->description) ."</p>";
            echo "</div>";
        }
        
        // Print for debug purposes
        function debugPrintOut(){
            $text = "Item ID: " . $this->id . " ,Name: " . $this->name . " ,Description: " . $this->description . " ,Price: " . $this->price . " ,Quantity: " . $this->quantity . " ,ImgName: " . $this->imgName . " ,Sale Price " . $this->salePrice . ", Discounted: " . $this->discounted . ", Sellable: " . $this->sellable . " <br />";
            echo $text;
        }
                
    }
    
?>