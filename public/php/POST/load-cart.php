<?php   session_start(); ?>
<?php   include "../../../includes/project-functions.php"; ?>
<?php   include "../../../includes/database.php";?>

<?php 


            $quant = calculateCartQuant();
            
    
            if(!$quant >= 1){
    
                echo "<div id='empty-cart'>
                    There are no items in the cart
                    <br><a href='catalogue.php'> Get Shopping! </a>
                </div>";   
           
            }else{
                
                // Set Count to Count Total Cost
                $totalCost = 0;
                
                if(isset($_SESSION["cart"]["products"])){
                    
                    
                    foreach($_SESSION["cart"]["products"] as $productID => $value){
                        
                      
                         // test for addons
                            if(isset($value['addon']) && ($value['addon'] == "true")){
                               $addon = 10;
                            }else{
                              $addon = 0;
                            }

                        displayCartItem($productID,$value,"product",$addon);

                    } // End Product ForEach 
                }
                
                if(isset($_SESSION["cart"]["customProducts"])){ 
                     foreach($_SESSION["cart"]["customProducts"] as $productID => $value){
                        
                          // test for addons
                            if(isset($value['addon']) && ($value['addon'] == "true")){
                               $addon = 10;
                            }else{
                              $addon = 0;
                            }
                         
                        displayCartItem($productID,$value,"custom",$addon);

                    } // End Product ForEach 
                }
            
                
                
            } // End Else


        ?>

<?php 

    

    if($quant >= 1){
        $totalCost = calculateCartValue(); 
        
        if($totalCost['customDiscount'] > 0){
            echo "<div id='cartBulkDiscount'>Custom Bulk Discount \${$totalCost['customDiscount']}</div>";   
        }
        
        
        echo "<div id='cart'>


                </div>

                <div id='total-wrapper'>
                    <div id='total-label'>TOTAL</div>
                    <div id='total-amt'>\${$totalCost['product']}</div>
                </div>

                <div id='checkout-button'><a href='checkout.php'>CHECKOUT</a></div>

        ";

    }
    
?>
   