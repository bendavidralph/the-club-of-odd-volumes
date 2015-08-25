<?php   include ('../../../../includes/database.php'); ?>

<?php 

    
    $id = $_POST['id'];
    deleteRow($_GET['table'],$id);
    echo "success";
?>