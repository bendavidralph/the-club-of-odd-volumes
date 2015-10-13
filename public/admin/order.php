<?php 
    $styleSheets = ["index"];
    $pageTitle = "Site Admin";
    include ('php/modules/_header.php');
 include ('../../includes/project-functions.php');
?>


<?php 

   


    $columnTitles = [];
    $columns = [];
    // Table being queried 
    $table = "";
    // Pass Variable to Javascript
    // "<script>var table='{$table}'</script>";
    


   
?>



<?php //   include('php/modules/_table.php'); ?>

<?php

      // Set Order Variables 
    $order_id = $_GET['order_id'];
    $order = queryById('customerOrder',$order_id);

    echo '<h1>Order</h1>';
    
    
    echo '<table class="table">';
    echo "<tr>";
        echo "<td><strong>Shipping ID: </strong>".'</td>';

        echo "<td><strong>Order Status:</strong> " .'</td>';
        echo "<td><strong>Total:</strong>" .'</td>';
    echo "</tr>";
    echo "<tr>";
        echo "<td>" . $order['shipping_id'] .'</td>';

        echo "<td>" . $order['orderStatus'].'</td>';
        echo "<td> $" . $order['total'].'</td>';
    echo "</tr>";
    echo '</table>';

    
   // Set Custom Variables 
    $customer = queryById('customer',$order['user_id']);

   echo '<h1>Customer</h1>';  

    
    
    echo '<table class="table">';
    echo "<tr>";
         echo "<td><strong>Full Name </strong>".'</td>';
         echo "<td><strong>Email </strong>".'</td>';
         echo "<td><strong>Phone </strong>".'</td>';
         echo "<td><strong>Line 1 </strong>".'</td>';
         echo "<td><strong>Line 2 </strong>".'</td>';
         echo "<td><strong>City </strong>".'</td>';
         echo "<td><strong>State </strong>".'</td>';
         echo "<td><strong>Zip </strong>".'</td>';
         echo "<td><strong>County </strong>".'</td>';
         echo "<td><strong>Shipping Region </strong>".'</td>';
     
    echo "</tr>";
    echo "<tr>";
        echo "<td>" . $customer['fullName'] .'</td>';
        echo "<td>" . $customer['email'] .'</td>';
        echo "<td>" . $customer['phone'] .'</td>';
        echo "<td>" . $customer['line1'] .'</td>';
        echo "<td>" . $customer['line2'] .'</td>';
        echo "<td>" . $customer['city'] .'</td>';
        echo "<td>" . $customer['state'] .'</td>';
        echo "<td>" . $customer['zip'] .'</td>';
        echo "<td>" . $customer['country'] .'</td>';
        echo "<td>" . $customer['shippingRegion'] .'</td>'; 
    echo "</tr>";
    echo '</table>';

 echo '<h1>Details</h1>';

    // Set order details 
     echo '<table class="table">';
     echo "<tr>";
         echo "<td><strong>Product Image</strong>".'</td>';
         echo "<td><strong>Product Name </strong>".'</td>';
            echo "<td><strong>Quantity</strong>".'</td>';
         echo "<td><strong>Description </strong>".'</td>';

     
    echo "</tr>";
    echo "<tr>";
        $query = "SELECT * FROM orderDetails WHERE order_id = " . $order_id;
        $results = queryDB($query);
        while($row = mysqli_fetch_assoc($results)){

           
                echo "<tr>";
                 echo "<td><strong><img src='../assets/images/product/{$row['product_id']}/SM/1.jpg' width='100px'></strong>".'</td>';
                
                $product = queryById('product',$row['product_id']);
                echo "<td><strong>{$product['productName']}</strong>".'</td>';
            
                echo "<td><strong>{$row['quantity']}</strong>".'</td>';
            
                $description = queryById('stock',$row['stock_id']);
                echo "<td><strong>{$description['description']} </strong>".'</td>';
                echo "</tr>";

      
            
            
        }

    echo "</tr>";
    echo '<table>';
       mysqli_free_result($results);
    
    
?>


<?php   include('php/modules/_footer.php'); ?>

