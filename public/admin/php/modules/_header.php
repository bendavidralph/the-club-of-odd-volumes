<?php   include ('../../includes/database.php'); ?>
<?php   include ('../../includes/admin-functions.php'); ?>

<!doctype html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Club of Odd Volumes - <?php   echo $pageTitle ?></title>
    

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-guide.css" rel="stylesheet">
    <!-- Polyfill -->
    <script src="bootstrap/respond.js"></script>
    
    <!-- Page Specific Styles -->
    <?php 
        foreach ($styleSheets as $value){

            echo    "<link href='css/{$value}.css' rel='stylesheet'>";

        }
    ?>
    
    

</head>  
    
<body>
    
<header class="container-fluid">
        
    <h3>The Club of Odd Volumes - <?php   echo $pageTitle ?> </h3>
    
    <a id="login-trigger" class="yellow-button" href="#">Login</a>
        
</header>
    
 