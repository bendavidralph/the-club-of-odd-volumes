<?php

 //Not required with Composer


function sendreceipt($html,$toEmail,$toName){
    try {
    $mandrill = new Mandrill('GJyvYpd7RDiY_WN-ZSB29g');
    $message = array(
        'html' => $html,
        'subject' => 'The Club of Odd Volumes - Thank you for your order',
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

    $order = queryById("customerOrder",$order_id);
    $customer = queryById("customer",$order['user_id']);

    
    $query = "SELECT * FROM orderDetails WHERE order_id = {$order['id']}";
    $orderResults = queryDB($query);
    
    //$to = $customer['email'];
    $to = $customer["email"];
    



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

    
    
     while($row = mysqli_fetch_assoc($orderResults)){
     
         
            $message .= getProductInformation($row["product_id"],$row['stock_id']);
         
     }
      

    
mysqli_free_result($orderResults);
    


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
    
  
    sendreceipt($message,$to,$customer["fullName"]);
    

}
 

?>

<?php

    function getProductInformation($id,$stock_id){
     
                    $productQuery = "SELECT productName, surcharge, artist_id FROM product WHERE id = '{$id}' LIMIT 1";
                    $productResult = queryDB($productQuery);
                    
                     while($productRow = mysqli_fetch_assoc($productResult)){
                         
                    $artist_id = $productRow['artist_id'];
                    $productName = $productRow["productName"];
                    $productSurcharge = $productRow["surcharge"];


                    
                    $productReturn ="<div class='product'>";
                  
                    $productReturn .="<img src='http://theclubofoddvolumes.com/assets/images/product/".$id."/SM/1.jpg'>";
                     
                    $productReturn .="<h4>".$productName."</h4>"; 
                    $productReturn .="<p>".getStockInformation($stock_id)."</p>";
                    $productReturn .="</div>";
               

            } // End Product While
            
            return $productReturn;
        
        
    }


    function getStockInformation($id){
     
                    $stockQuery = "SELECT description FROM stock WHERE id = '{$id}' LIMIT 1";
                    $stockResult = queryDB($stockQuery);
                    
                    while($row = mysqli_fetch_assoc($stockResult)){
                     
                        return $row['description'];
                        
                    }                    
                  
        
        
    }


?>