<?php   session_start(); ?>
<?php   include "../../../includes/project-functions.php"; ?>
<?php   include "../../../includes/database.php";?>

<?php 
    $selectedCountry =  $_POST['country'];
    
    $result = calculateCartValue($_POST['country']);

    echo $result['shipping'];
?>