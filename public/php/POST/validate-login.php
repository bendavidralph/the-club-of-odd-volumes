<?php session_start();
    include '../../../includes/database.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $hash_format = "$2y$10$";
    $format_and_salt = $hash_format . "theclubtheclubtheclubt";
    $hash = crypt($password,$format_and_salt);


    // find the user
    $query = "SELECT * FROM reseller WHERE username = '{$email}' AND password = '{$hash}'";
    $result = queryDB($query);
    // find the password 

    if( $result->num_rows > 0) {
      
  
                $_SESSION['user'] = "reseller"; 
                echo 'success';

      
        
      }else{
        
         echo 'error';  
      }

   mysqli_free_result($result);
    


?>