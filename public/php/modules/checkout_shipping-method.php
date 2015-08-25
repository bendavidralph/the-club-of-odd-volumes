<h3>Confirm Shipping Address:</h3>

<?php 
    $query = "SELECT * FROM customer WHERE id = '{$_SESSION['userID']}' LIMIT 1";
    $results = queryDB($query);

     while($row = mysqli_fetch_assoc($results)){
          
         $fullName = $row["fullName"];
         $phone = $row["phone"];
         $email = $row["email"];
         $line1 = $row["line1"];
         $line2 = $row["line2"];
         $city = $row["city"];
         $state = $row["state"];
         $zip = $row["zip"];
         $country = $row["country"];
         
    }
      
    mysqli_free_result($results);

?>

<strong><?php   echo $fullName; ?></strong>
<br><?php   echo $line1. " " . $line2; ?>
<br><?php   echo $city.", ".$state.", ".$zip; ?>
<br><?php   echo $country; ?>
<br>
<br><?php   echo $phone; ?>
<br><?php   echo $email; ?>
<br><br>
<a href="checkout">Edit shipping address</a>

<hr>

<?php 

    $checked = NULL;

    if($customer["shippingRegion"] == "australia" || $customer["shippingRegion"] == "ausExpress"){
    
    $checked = $customer["shippingRegion"];
        

?>

<h3>Shipping method</h3>

<div class="radio">
  <label>
  <input type="radio" name="shippingMethod"value="australia" <?php   if($checked == 'australia'){ echo "checked"; }?> >
    Standard Shipping 
  </label>
</div>
<div class="radio">
  <label>
 <input type="radio" name="shippingMethod" value="ausExpress" <?php   if($checked == 'ausExpress'){ echo "checked"; }?>>
   Express Post
  </label>
</div>

<hr>

<?php   } // end if ?>

<a href="checkout?page=payment"><input class="btn btn-default" type="button" value="Next: Payment Details"></a>
