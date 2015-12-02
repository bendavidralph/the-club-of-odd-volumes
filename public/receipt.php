<?php
  
    $styleSheets = ["receipt"];
    $pageTitle = "Receipt";
    include ('php/modules/_header.php');


    $order_id = $_GET['orderid'];

?>


<main>
    
        
<h2>PURCHASE COMPLETE</h2>
 <br>
<p>Your order has been recieved.<br>
We really appreciate your business and support, thanks <3 </p>
<br>
<p>Check your inbox for a conformation and feel free to email us if you have any questions. <br>
We will let you know once it is printed and on its way to you.</p>
          
</main>

<!-- Get Order Information -->
<?php
    $order = queryById('customerOrder',$order_id);


?>


<!-- Place Order Into an Array -->
<?php
// Transaction Data
$trans = array('id'=>$order_id, 'affiliation'=>'The Club of Odd Volumes',
               'revenue'=>$order['total'], 'shipping'=>'0', 'tax'=>'0');

// List of Items Purchased.
$query = "SELECT * FROM orderDetails WHERE order_id = " . $order_id;
$results = queryDB($query);

$items;

while($row = mysqli_fetch_assoc($results)){
    
      if($row['productType'] == 'product'){
    
        $product = queryById('product',$row['product_id']);  
        $stock = queryById('stock',$row['stock_id']);    
        
          
        $items[] = array('sku'=> 's'.$row['stock_id'], 'name'=>$product['productName'], 'category'=> $stock['base'], 'price'=>$stock['surcharge'], 'quantity'=>$row['quantity']);
      
      }else{
          
            $stock = queryById('stockCustom',$row['stock_id']);    
            $items[] = array('sku'=> 'c'.$row['stock_id'], 'name'=> 'Custom', 'category'=> $stock['base'], 'price'=>$stock['surcharge'], 'quantity'=>$row['quantity']);
          
          
      }
    
    
}

mysqli_free_result($results);

?>

<!-- Generate GA JS Code -->
<?php
// Function to return the JavaScript representation of a TransactionData object.
function getTransactionJs(&$trans) {
  return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$trans['id']}',
  'affiliation': '{$trans['affiliation']}',
  'revenue': '{$trans['revenue']}',
  'shipping': '{$trans['shipping']}',
  'tax': '{$trans['tax']}'
});
HTML;
}

// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return <<<HTML
ga('ecommerce:addItem', {
  'id': '$transId',
  'name': '{$item['name']}',
  'sku': '{$item['sku']}',
  'category': '{$item['category']}',
  'price': '{$item['price']}',
  'quantity': '{$item['quantity']}'
});
HTML;
}
?>

<!-- Initialise and call the function -->
<script>
ga('require', 'ecommerce');

<?php
echo getTransactionJs($trans);

foreach ($items as &$item) {
  echo getItemJs($trans['id'], $item);
}
?>

ga('ecommerce:send');
</script>

  
<?php   include('php/modules/_footer.php'); ?>



