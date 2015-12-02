<?php session_start();

    if(isset($_SESSION['user']) && $_SESSION['user'] == 'reseller'){
        
        unset($_SESSION['user']);
        
    }

    header( 'Location: index.php?logout=true' ) ;

?>