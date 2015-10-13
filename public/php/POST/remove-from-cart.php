<?php   session_start();
ob_start("ob_gzhandler");

    $id = $_GET["id"];
    $type = $_GET["type"];

    if($type == "custom"){
        $removeType = "customProducts"; 
    }else{
       $removeType = "products"; 
    }

    // count the items 
    $count  = 0;
    foreach($_SESSION["cart"][$removeType][$id] as $value){
        
       
           $count = (int) $count + (int) $value;
  
       
        
        
    }

    $_SESSION['cart']["quant"] = $_SESSION['cart']["quant"] - $count;

    unset($_SESSION["cart"][$removeType][$_GET["id"]]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
       


?>