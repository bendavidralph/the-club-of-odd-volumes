<?php   session_start(); ?>

<?php 

$count = 0;


foreach($_POST["data"] as $key => $value){
    
    $product_id = $value[0];
    $stock_id = $value[1];
    $quant = $value[2];
    
    $_SESSION["cart"]["products"][$product_id][$stock_id] = $_SESSION["cart"][$product_id][$stock_id] + $quant;
    
    $count = $count +  $quant; 
     


}

$_SESSION['cart']["quant"] = $_SESSION['cart']["quant"] + $count;


?>