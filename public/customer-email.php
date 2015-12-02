
<?php

function sendreceipt($html,$toEmail,$toName, $subject = 'The Club of Odd Volumes - Thank you for your order'){
    try {
    $mandrill = new Mandrill('GJyvYpd7RDiY_WN-ZSB29g');
    $message = array(
        'html' => $html,
        'subject' => $subject,
        'from_email' => 'shop@theclubofoddvolumes.com',
        'from_name' => 'The Club of Odd Volumes',
        'to' => array(
            array(
                'email' => $toEmail,
                'name' => $toName,
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'shop@theclubofoddvolumes.com'),
        'important' => false,
        'track_opens' => true,
        'track_clicks' => true,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
//        'bcc_address' => 'shop@theclubofoddvolumes.com',
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'tags' => array('receipt'),
        );
    $async = false;
    $ip_pool = 'Main Pool';
    $result = $mandrill->messages->send($message, $async, $ip_pool);
    print_r($result);
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}
}
  


function sendCustomerEmail($order_id){

   
    $order = queryById('customerOrder',$order_id);

   // Set Custom Variables 
   $customer = queryById('customer',$order['user_id']);

   $to = $customer["email"];

    //###############################################################################################
    $message = "<h1>THANK YOU ".strtoupper($customer["fullName"])."!</h1>";
    
    $message .= "<h1>YOUR ORDER HAS BEEN RECEIVED </h1>";

    $message .="<p>We will start printing and it should be in the post within the next few days. 
    <br>People like you are the ones that keep us going. Your support means a lot!</p>";

    $message .="<p>Order Number: #".$order_id."</p>";
    
    $message .="<div id='address'>";

    $message .="<strong>Shipping to:</strong>";
    $message .="<br>".$customer["fullName"];
    $message .="<br>".$customer["line1"]." ".$customer["line2"]." ".$customer["city"];
    $message .="<br>".$customer["state"]." ".$customer["zip"];
    $message .="<br>".$customer["country"];

    $message .="</div>";

    $message .="<div id='product-wrapper'>";
    
// ##############################################################################
    

    
    
        $query = "SELECT * FROM orderDetails WHERE order_id = " . $order_id;
        $results = queryDB($query);
        while($row = mysqli_fetch_assoc($results)){
            
                $message .= "<div class='product'>";
                if($row['productType'] == 'product'){

 
                     $message .= "<img src='http://theclubofoddvolumes.com/assets/images/product/{$row['product_id']}/SM/1.jpg' width='100px'></strong>";

                    $product = queryById('product',$row['product_id']);
                    
                    $message .= "<h4>".$product['productName']."</h4>";

                    $message .= $row['quantity'] . " x ";
                    

                    $description = queryById('stock',$row['stock_id']);
                    $message .= ucwords($description['description']);

                    if($row['addon'] >= 1){
                        $message .=   "<p style='font-size:9px;'>Including Cushion Insert</p>"; 
                    }


                }else{
                    
                    $customProductInfo = getCustomProductInfoCustomer($row['product_id']);

                    
                    if($customProductInfo['image1']){
                        $message .= "<a href='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image1']}'><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image1']}' width='100px'></a>";
                    }else{
                        $message .= "<a href='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image2']}'><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image2']}' width='100px'></a>";
                    }
                 
                    $message .= "<h4>CUSTOM</h4>";
                    
                    $message .= $row['quantity'] . " x ";

                    $description = queryById('stockCustom',$row['stock_id']);
                    
                    $message .= ucwords($description['description']);

                   if($row['addon'] >= 1){
                        $message .=   "<p style='font-size:9px;'>Including Cushion Insert</p>"; 
                    }

                  
                }
            
                $message .="</div>";
      
            
            
        }



    mysqli_free_result($results);
    
    
// ###############################################################################
    
    
$message .="<hr>";
$message .="<div id='total'><strong>TOTAL</strong> $".$order['total']."</div>";
$message .="<hr></div>";


$message .="<p>Need help? Please contact us at <a href='mailto:shop@theclubofoddvolumes.com'>shop@theclubofoddvolumes.com</a></p>";

$message .="<p>Please print this page for your records. We do not include invoices inside parcels.
10% GST INCLUDED IN THE RRP for Australian customers.</p>";

$message .="<style>

    body{
        text-align:center;  
        width:600px;
        margin:20px auto;
        padding:0 0 30px 0;
        font-family:arial;
    }
    
    h1{
        font-size:30px;
        
    }
    
    h4{
        margin:2px;   
    }
    
    #address{
        border:1px solid #000000;
        margin:30px;
        padding:30px;
    }
    
    .product{
        display:inline-block;
        width:30%;  
        margin:40px 20px;
    }
    
    img{
        width:100%;   
    }
    
    .product p{
        margin:0;   
    }

    hr{
     
        margin:50px 0;
        
    }
    
</style>";
    

    //###############################################################################################

    sendreceipt($message,$to,"Sarah");
 //   echo $message;
    
}
?>


<?php

    function getCustomProductInfoCustomer($id){
     
        $query = "SELECT * FROM customProduct WHERE id = " . $id;
        $results = queryDB($query);
        while($row = mysqli_fetch_assoc($results)){
            
            $product['image1'] = $row['frontDesignIMG_id'];
            $product['image2'] = $row['backDesignIMG_id'];
            
           
            
            
        }
        
        return $product;
        
        mysqli_free_result($results);
        
    }


?>

