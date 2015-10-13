<?php   session_start(); 

    include "../../../includes/database.php";

?>

<?php 

    $count = 0;
    
    
    $customProductInfo = $_POST["data"][0];

    print_r($customProductInfo);
    
    unset($_POST["data"][0]);

    // Add Product info into an associative array
    foreach($customProductInfo as $key => $value){
     
            $addProduct[$value[0]] =  $value[1];
          
    }

    $product_id = insert_DB('customProduct',$addProduct);


    foreach($_POST["data"] as $key => $value){
        
        
        $product_id = $product_id;
        $stock_id = $value[1];
        $quant = $value[2];
        $addon = $addProduct['addon'];

        $_SESSION["cart"]["customProducts"][$product_id][$stock_id] = $_SESSION["cart"][$product_id][$stock_id] + $quant;

        if($addon == "true"){
        $_SESSION["cart"]["customProducts"][$product_id]["addon"] = "true";
        }else{
            $_SESSION["cart"]["customProducts"][$product_id]["addon"] = "false";
        }
        
        $count = $count +  $quant; 



    }

    $_SESSION['cart']["quant"] = $_SESSION['cart']["quant"] + $count;
    


?>