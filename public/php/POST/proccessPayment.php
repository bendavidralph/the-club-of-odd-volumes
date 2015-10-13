<?php  session_start(); ?>
<?php  ob_start("ob_gzhandler");?>
<?php
    include '../../../includes/database.php';
    include '../../../includes/project-functions.php';
    include '../../../includes/payment.php';
    include '../../../includes/mandrill-api-php/src/Mandrill.php';
    include '../../customer-email.php';
    include '../../purchase-email.php';
    

    // Get price from order table
    $customerOrder = queryById('customerOrder',$_SESSION['order_id']);
//    $total = $customerOrder['total'];
    $total = 1;

 
     if($_POST["payment_method_nonce"]){
                $nonce = $_POST["payment_method_nonce"];
                $result = executePayment($nonce,$total);
     }

    
    // Succesfull if = 1
    $success = $result->success;

    if($success == 1){
        
//        echo "<pre>";    
//       print_r($result); 
//        echo "<pre>";
        
      saveTransaction($_SESSION['order_id']);
            
 
        sendCustomerEmail($_SESSION['order_id']);
        sendPurchaseEmail($_SESSION['order_id']);


        // Clear the Session
        session_destroy();
        
        // Redirect the user to Thank-you Screen
        header("Location: ../../receipt.php"); 
        

      
    
    }else{

        handleFailure($result);
                
    }

    
    
?>

