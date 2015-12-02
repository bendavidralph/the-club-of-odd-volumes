<?php   include ('../../../../includes/database.php'); ?>

<?php 

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


insert_DB($_GET['table'],$_POST);
    echo "success";
?>

<?php

    function generatePassword($password){
        
        $hash_format = "$2y$10$";
        $format_and_salt = $hash_format . "theclubtheclubtheclubt";
        $hash = crypt($password,$format_and_salt);

        return $hash;
        
    }


?>