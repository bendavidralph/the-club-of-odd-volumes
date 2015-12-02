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
    $total = $customerOrder['total'];

    if($total > 0){
 
         if($_POST["payment_method_nonce"]){
                    $nonce = $_POST["payment_method_nonce"];
                    $result = executePayment($nonce,$total);
         }
    
    
    
    // Succesfull if = 1
    $success = $result->success;
    
    }else{
        $success = 1;
    }
    
    if($success == 1){
        
        

        saveTransaction($_SESSION['order_id']);
        sendCustomerEmail($_SESSION['order_id']);
        sendPurchaseEmail($_SESSION['order_id']);
        
        if(isset($_SESSION['discount'])){
            
            if($_SESSION['discount']['type'] == "voucher"){
              
                $voucherApplied = $_SESSION['discount']['voucherApplied'];
                
                // Deduct Value 
                $qry = "UPDATE discountCodes SET value = (value - '{$voucherApplied}') WHERE name = '{$_SESSION['discount']['name']}';";
                $db = createDBConnection();
                $result = mysqli_query($db,$qry);
                if(!$result){
                echo mysqli_error($db). "<br>";
                die("Databse query failed");
            
        }
        
        mysqli_close($db);
            }
            
        }
        


        // Clear the Session
        session_destroy();
        
        // Redirect the user to Thank-you Screen
       header("Location: ../../receipt.php?orderid={$_SESSION['order_id']}"); 
//        

      
    
    }else{

        handleFailure($result);
                
    }

    
    
?>

