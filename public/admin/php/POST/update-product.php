<?php   include ('../../../../includes/database.php'); ?>

<?php 

    // Correct for checkboxes
    foreach($_POST as $key => $value){
        
          
        if($value == "false"){
            $_POST[$key] = "NULL";
        }
        
        if($value == "true"){
            $_POST[$key] = '1';
        }
        
        if (ctype_space($value) || $value == '') {
            $_POST[$key] = "NULL";
        }
     
        if($key == 'password'){
         
             $_POST[$key] = generatePassword($value);
            
        }
        
    }

    print_r($_POST);

    $id = $_POST['id'];
    $table = $_GET['table'];
    $updateValues = $_POST;
    update_DB($table,$updateValues,$id);

    

?>

<?php

 function generatePassword($password){
        
        $hash_format = "$2y$10$";
        $format_and_salt = $hash_format . "theclubtheclubtheclubt";
        $hash = crypt($password,$format_and_salt);

        return $hash;
        
    }



?>