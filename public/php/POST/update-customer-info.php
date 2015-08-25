<?php   session_start(); ?>
<?php   include ('../../../includes/database.php'); ?>

<?php 

foreach($_POST as $key => $value){

    $insertValues[$key] = $value;

}

if(isset($_SESSION['userID']) && ($_SESSION['userID'] >= 1)){
    
    update_DB('customer',$insertValues,$_SESSION['userID']);
    
}else{

    $_SESSION["userID"] = insert_DB('customer',$insertValues);

}

?>