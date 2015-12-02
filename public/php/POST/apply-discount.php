<?php session_start(); 

include "../../../includes/database.php";

    $discountCode = cleanText($_POST['discount']);

    // Check Discount Is Valid 
    $query = "SELECT * FROM discountCodes WHERE name = '{$discountCode}' AND valid = 1";
    $results = queryDB($query);

   if( $results->num_rows > 0) {  
   while($row = mysqli_fetch_assoc($results)){
        $_SESSION['discount'] = [];
        $_SESSION['discount']['type'] = $row['type'];
        $_SESSION['discount']['value'] = $row['value'];
        $_SESSION['discount']['name'] = $row['name'];
       
       echo 'success';
        
   }}else{
    
       echo 'fail';
       
   }
      

   mysqli_free_result($results);       

    // Save the details 


    


?>