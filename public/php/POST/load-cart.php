<?php   session_start(); ?>
<?php   include "../../../includes/project-functions.php"; ?>
<?php   include "../../../includes/database.php";?>

<?php 


            $quant = cartTotal();
            
    
            if(!$quant >= 1){
    
                echo "<div id='empty-cart'>
                    There are no items in the cart
                    <br><a href='catalogue.php'> Get Shopping! </a>
                </div>";   
           
            }else{
                
                // Set Count to Count Total Cost
                $totalCost = 0;
                
                foreach($_SESSION["cart"]["products"] as $productID => $value){
                 
                    // Get the design information
                    $productQuery = "SELECT productName, surcharge, artist_id FROM product WHERE id = '{$productID}' LIMIT 1";
                    $productResult = queryDB($productQuery);
                    
                     while($row = mysqli_fetch_assoc($productResult)){
                         
                    $artist_id = $row['artist_id'];
                    $productName = $row["productName"];
                    $productSurcharge = $row["surcharge"];

            ?>  
                    
                    <div class="container-fluid cart-product-result">
                    <section class="row">
                    
                    <div class="col-xs-6">    
                    <img class="img-responsive" src="assets/images/product/<?php echo $artist_id; ?>/<?php   echo $productID; ?>/SM/1.jpg">
                    </div>   
                        
                    <div class="cart-product-info col-xs-6"> 
                    <h4><?php   echo $productName; ?></h4> 

                    

            <?php                   

                         
                     } // End Product While
                    
                    $productTotalCost = 0;
                    foreach($value as $key => $value){
                     
                        // Get the Stock Information 
                         $stockQuery = "SELECT * FROM stock WHERE id = '{$key}' LIMIT 1";
                         $stockResult = queryDB($stockQuery);
                    
                     while($row = mysqli_fetch_assoc($stockResult)){
                         
                         $subTotal = $row["surcharge"] + $productSurcharge;
                        
                        echo "<p>". 
                        $value . " x " . 
                        $row["size"] . " " . 
                        $row["sizeCategory"] . " / " .
                        $row["color"] . " / ".
                        $row["base"] . " - ".
                        "$".$subTotal."</p>";    
                         
                      
                        $subTotal = $subTotal * $value;
                         
                        $productTotalCost = $productTotalCost + $subTotal;
                         
                        
                         
                         
                     } // End Stock While
                        
                        
                    } // End Stock ForEach
                    $totalCost = $totalCost + $productTotalCost;
                    
?>

                    
                        </div>
                        <div class="remove-product"><a href="php/POST/remove-from-cart.php?id=<?php echo $productID ?>">REMOVE</a></div>
                        <div class="cart-product-subtotal">$<?php   echo $productTotalCost; ?></div>
                        </section>
                    </div>
                        
                    
<?php                      
                } // End Product ForEach 
                
            
                
                
            } // End Else


        ?>

<?php 

    if($quant >= 1){

        echo "
          <div id='cart'>


                </div>

                <div id='total-wrapper'>
                    <div id='total-label'>TOTAL</div>
                    <div id='total-amt'>\${$totalCost}</div>
                </div>

                <div id='checkout-button'><a href='checkout.php'>CHECKOUT</a></div>

        ";

    }
    
?>
   