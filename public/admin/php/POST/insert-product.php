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
     
}


insert_DB($_GET['table'],$_POST);
    echo "success";
?>