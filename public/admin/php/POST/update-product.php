<?php   include ('../../../../includes/database.php'); ?>

<?php 

    // Correct for checkboxes
    foreach($_POST as $key => $value){
        
        if($value == "false"){
            $_POST[$key] = "";
        }else if($value == "true"){
              $_POST[$key] = '1';
        }
        
    }

    print_r($_POST);

    $id = $_POST['id'];
    $table = $_GET['table'];
    $updateValues = $_POST;
    update_DB($table,$updateValues,$id);

    

?>