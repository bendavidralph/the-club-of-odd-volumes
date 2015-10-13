<?php   session_start(); ?>

<?php 

$count = 0;

//echo "<pre>";
//print_r($_POST["data"]);
//echo "</pre>";

foreach($_POST["data"] as $key => $value){
    
    $product_id = $value[0];
    $stock_id = $value[1];
    $quant = $value[2];
    $addon = $value[3];
    
    $_SESSION["cart"]["products"][$product_id][$stock_id] = $_SESSION["cart"][$product_id][$stock_id] + $quant;
    
    if($addon == "true"){
        $_SESSION["cart"]["products"][$product_id]["addon"] = "true";
    }else{
        $_SESSION["cart"]["products"][$product_id]["addon"] = "false";
    }
    
    $count = $count +  $quant; 
     


}

$_SESSION['cart']["quant"] = $_SESSION['cart']["quant"] + $count;


?>