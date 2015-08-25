<?php  session_start(); ?>
<?php  ob_start("ob_gzhandler");?>
<?php
    include '../../../includes/database.php';
    include '../../../includes/project-functions.php';
    include '../../../includes/payment.php';

    // Get price from order table
    $customerOrder = queryById('customerOrder',$_SESSION['order_id']);
    $total = $customerOrder['total'];

 
     if($_POST["payment_method_nonce"]){
                $nonce = $_POST["payment_method_nonce"];
                 $result = executePayment($nonce,$total);
     }

    
    // Succesfull if = 1
    $success = $result->success;

    if($success == 1){
        
        saveTransaction($_SESSION['order_id']);
            
        // sendRedeiptEmail($customer_id);
        
                // Clear the Session
        session_destroy();
        
        // Redirect the user to Thank-you Screen
        header("Location: ../../receipt.php"); 
        

      
    
    }else{

        handleFailure($result);
                
    }

    
    
?>

