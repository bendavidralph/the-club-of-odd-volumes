<?php   session_start();
ob_start("ob_gzhandler");

    $id = $_GET["id"];
    // count the items 
    $count  = 0;
    foreach($_SESSION["cart"]["products"][$id] as $value){
        
       
           $count = (int) $count + (int) $value;
  
       
        
        
    }

    $_SESSION['cart']["quant"] = $_SESSION['cart']["quant"] - $count;
    unset($_SESSION["cart"]["products"][$_GET["id"]]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
       


?>