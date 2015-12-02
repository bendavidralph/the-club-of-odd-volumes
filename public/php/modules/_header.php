<?php  session_start(); ?>
<?php  ob_start("ob_gzhandler");?>
<?php  include ('../includes/database.php'); ?>
<?php  include ('../includes/project-functions.php'); ?>
<!DOCTYPE html>
<html>

<head>
    
    <!-- Begin Inspectlet Embed Code -->
    <script type="text/javascript" id="inspectletjs">
    window.__insp = window.__insp || [];
    __insp.push(['wid', 1183890671]);
    (function() {
    function ldinsp(){var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
    document.readyState != "complete" ? (window.attachEvent ? window.attachEvent('onload', ldinsp) : window.addEventListener('load', ldinsp, false)) : ldinsp();

    })();
    </script>
    <!-- End Inspectlet Embed Code -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Club of Odd Volumes - <?php  echo $pageTitle ?></title>
    

<link rel="stylesheet" type="text/css" href="assets/fonts/MyFontsWebfontsKit/MyFontsWebfontsKit.css">
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
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-35008170-1', 'auto');
      ga('send', 'pageview');

    </script>

</head>  
    
<body>
    
<header class="container-fluid">
        
        <div id="branding" class="row">
            <div id="logo"><a href="index.php">THE CLUB OF ODD VOLUMES</a></div>
            <div id="cart-close-trigger"><img src="assets/images/icons/close.png"></div>
            <div id="cart-trigger">CART <?php  echo cartTotal(); ?></div>
        </div>
        
        <nav id="header" class="row">
            
            <div id="categories-menu-trigger">
                <p>SHOP</p>
                <div class="hamburger"></div>
            </div>
            
            <ul>
                
                <?php 
                    if(!(isset($_GET['category']))){$active = "active";}else{$active = "";}
                ?>
                
                <li class="<?php  echo $active ?>"><a href="catalogue.php?<?php echo generateFilterURL('category')?>">ALL</a></li>
                <li class="divider">///</li>
                <!-- Load Product Categoires from the Databse -->
                <?php  

                $query = "SELECT * FROM categories";
                $categories = queryDB($query);

                mysqli_num_rows($categories);
                $count = 1;
                while($row = mysqli_fetch_assoc($categories)){
                        
                    
                    // Test if selected category 
                    if(isset($_GET['category']) && $_GET['category'] == $row["id"]){
                        $active = "active";   
                    }else{
                        $active = ""; 
                    }
                    
                    echo '<li class="'.$active.'"><a href="catalogue.php?category='.$row["id"].generateFilterURL('category').'">'.$row["label"].'</a></li>';
                    
                    // Test if not last Category
                    if(!($count == 8)){
                        echo '<li class="divider">/</li>';   
                    }
                    
                    $count++;

                }
                ?>
                <li class="divider">///</li>
                <li><a href="custom-printing.php">CUSTOM PRINTING</a></li>
                
                <?php

                if(isset($_SESSION['user']) && $_SESSION['user'] == 'reseller'){
                ?>
                <li class="divider">///</li>
                <li><a href="logout.php">LOGOUT</a></li>
                <?php
                }

                ?>
                
            </ul>
        </nav>

    
    
    
        
    </header>
    
    <aside id="cart-wrapper">
        
      
    </aside>
    
    <div id="fadeout"> </div>    