<?php 
//
//    include ('../includes/project-functions.php');
//    include ('../includes/database.php');
?>


<?php

function sendPurchaseEmail($order_id){

    $message = '<style>
        
        table{
            
            width:100%;
            border-collapse: collapse;
        }
        
        td{
            border:1px solid #666666;
            
        }
    
    </style>';

    $message .=  '<section style="width:90%">';

    $order = queryById('customerOrder',$order_id);

    $message .= '<h1>Order</h1>';
    
    
    $message .= '<table class="table">';
    $message .= "<tr>";
        $message .= "<td><strong>Shipping ID: </strong>".'</td>';

        $message .= "<td><strong>Order Status:</strong> " .'</td>';
        $message .= "<td><strong>Total:</strong>" .'</td>';
    $message .= "</tr>";
    $message .= "<tr>";
        $message .= "<td>" . $order['shipping_id'] .'</td>';

        $message .= "<td>" . $order['orderStatus'].'</td>';
        $message .= "<td> $" . $order['total'].'</td>';
    $message .= "</tr>";
    $message .= '</table>';

    
   // Set Custom Variables 
   $customer = queryById('customer',$order['user_id']);

   $message .= '<h1>Customer</h1>';  

    
    
    $message .= '<table class="table">';
    $message .= "<tr>";
         $message .= "<td><strong>Full Name </strong>".'</td>';
         $message .= "<td><strong>Email </strong>".'</td>';
         $message .= "<td><strong>Phone </strong>".'</td>';
         $message .= "<td><strong>Line 1 </strong>".'</td>';
         $message .= "<td><strong>Line 2 </strong>".'</td>';
         $message .= "<td><strong>City </strong>".'</td>';
         $message .= "<td><strong>State </strong>".'</td>';
         $message .= "<td><strong>Zip </strong>".'</td>';
         $message .= "<td><strong>County </strong>".'</td>';
         $message .= "<td><strong>Shipping Region </strong>".'</td>';
     
    $message .= "</tr>";
    $message .= "<tr>";
        $message .= "<td>" . $customer['fullName'] .'</td>';
        $message .= "<td>" . $customer['email'] .'</td>';
        $message .= "<td>" . $customer['phone'] .'</td>';
        $message .= "<td>" . $customer['line1'] .'</td>';
        $message .= "<td>" . $customer['line2'] .'</td>';
        $message .= "<td>" . $customer['city'] .'</td>';
        $message .= "<td>" . $customer['state'] .'</td>';
        $message .= "<td>" . $customer['zip'] .'</td>';
        $message .= "<td>" . $customer['country'] .'</td>';
        $message .= "<td>" . $customer['shippingRegion'] .'</td>'; 
    $message .= "</tr>";
    $message .= '</table>';

 $message .= '<h1>Details</h1>';

    // Set order details 
     $message .= '<table class="table">';
     $message .= "<tr>";
            $message .= "<td><strong>Product Image</strong>".'</td>';
            $message .= "<td><strong>Product Name </strong>".'</td>';
            $message .= "<td><strong>Quantity</strong>".'</td>';
            $message .= "<td><strong>Description </strong>".'</td>';
            $message .= "<td><strong>Addon </strong>".'</td>';

     
    $message .= "</tr>";
    $message .= "<tr>";
        $query = "SELECT * FROM orderDetails WHERE order_id = " . $order_id;
        $results = queryDB($query);
        while($row = mysqli_fetch_assoc($results)){
            
                
                if($row['productType'] == 'product'){

           
                    $message .= "<tr>";
                     $message .= "<td><img src='http://theclubofoddvolumes.com/assets/images/product/{$row['product_id']}/SM/1.jpg' width='100px'></strong>".'</td>';

                    $product = queryById('product',$row['product_id']);
                    $message .= "<td>{$product['productName']}".'</td>';

                    $message .= "<td>{$row['quantity']}".'</td>';

                    $description = queryById('stock',$row['stock_id']);
                    $message .= "<td>{$description['description']}".'</td>';

                    if($row['addon'] >= 1){
                        $message .=   "<td>Inlcude Cushion Insert</td>"; 
                    }

                    $message .= "</tr>";

                }else{
                    
                    $customProductInfo = getCustomProductInfo($row['product_id']);
                    
                    $message .= "<tr><td>";
                    
                    if($customProductInfo['image1']){
                        $message .= "<a href='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image1']}'><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image1']}' width='100px'></a>";
                    }
                    
                     if($customProductInfo['image2']){
                        $message .= "<a href='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image2']}'><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/{$customProductInfo['image2']}' width='100px'></a>";
                    }
                    
                    $message .= "</td><td>";

                    
                    $message .= "{$customProductInfo['front']}";
                    $message .= "{$customProductInfo['back']}";
                    
                    $message .= '</td>';

                    $message .= "<td>{$row['quantity']}".'</td>';

                    $description = queryById('stockCustom',$row['stock_id']);
                    $message .= "<td>{$description['description']}".'</td>';

                    if($row['addon'] >= 1){
                        $message .=   "<td>Inlcude Cushion Insert</td>"; 
                    }

                    $message .="</tr>";
                }
      
            
            
        }

    $message .= "</tr>";
    $message .= '<table>';
    mysqli_free_result($results);
    
    $message .= '</section>';
    
    $to = "shop@theclubofoddvolumes.com";
    sendreceipt($message,$to,"Sarah");
    
    
}
?>


<?php

    function getCustomProductInfo($id){
     
        $query = "SELECT * FROM customProduct WHERE id = " . $id;
        $results = queryDB($query);
        while($row = mysqli_fetch_assoc($results)){
            
            $product['image1'] = $row['frontDesignIMG_id'];
            $product['image2'] = $row['backDesignIMG_id'];
          
            
            if($row['template'] == 1){
                    $product['template'] = "Template 1 - Front and back";
            }else{
                 $product['template'] = "Template 2 - Top and Bottom";   
            }
            
            if($row['removeWhiteFront'] == 1){
                $row['removeWhiteFront'] = "yes";
            }else{
                $row['removeWhiteFront'] = "no";
            }
            
            if($row['removeWhiteBack'] == 1){
                $row['removeWhiteBack'] = "yes";
            }else{
                $row['removeWhiteBack'] = "no";
            }
            
            if(isset($row['frontDesign'])){
                $product['front'] = "
                Image top/front
                <ul>
                    <li>{$product['template']}</li>
                    <li>Placement = {$row['frontPlacement']}</li>
                    <li>Remove White =  {$row['removeWhiteFront']}</li>
                </ul>
                ";
            }else{
              $product['front'] = "";   
            }
            
             if(isset($row['backDesign'])){
                $product['back'] = "
                Image bottom/back
                <ul>
                     <li>Template = {$row['template']}</li>
                    <li>Placement = {$row['backPlacement']}</li>
                    <li>Remove White =  {$row['removeWhiteBack']}</li>
                </ul>
                ";
            }else{
              $product['back'] = "";   
            }
            
            
        }
        
        return $product;
        
        mysqli_free_result($results);
        
    }


?>

