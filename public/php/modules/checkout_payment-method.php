<?php 

    // INSERT ORDER INTO DATABASE
    $order['id'] = 'NULL';
    $order['user_id'] = $_SESSION['userID'];
    $customer  = queryById('customer',$_SESSION['userID']);
    $order['shipping_id'] = $customer['shippingRegion'];
    
    $order['discount_id'] = 2; // Needs to be set later
    
    $order['dateStamp'] = date('l jS \of F Y h:i:s A');
    $order['orderStatus'] = 'incomplete';
    
    $total = calculateCartValue($order['shipping_id']);
    $order['total'] = $total['product'] + $total['shipping'];

   $order_id = insert_DB('customerOrder',$order);
        
   $_SESSION['order_id'] = $order_id;
   
   // INSERT ORDER INTO DATABASE
    foreach($_SESSION['cart']['products'] as $product_id => $value){
        
        foreach($value as $stock_id => $quantity){
         
            $orderDetails['id'] = 'NULL';
            $orderDetails['order_id'] = $order_id;
            $orderDetails['product_id'] = $product_id;
            $orderDetails['stock_id'] = $stock_id;
            $orderDetails['quantity'] = $quantity ;
            
            insert_DB('orderDetails',$orderDetails);
            
        }
        
        
    }


?>

<h3>Payment method</h3>
All transactions are secure and encrypted. Credit card information is never stored.

<br><br>

<form id="checkout" method="post" action="php/POST/proccessPayment">
  <div id="payment-form"></div>
    <br>
  <input class="btn btn-default" type="submit" value="Pay $<?php   echo $order['total']; ?>">   
    
</form>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>

    var clientToken = "<?php   echo createClientToken(); ?>";

braintree.setup(clientToken, "dropin", {
  container: "payment-form"
});
    
</script>