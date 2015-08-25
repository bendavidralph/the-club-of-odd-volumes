<?php  session_start(); ?>
<?php  ob_start("ob_gzhandler");?>
<?php  include ('../includes/database.php'); ?>
<?php  include ('../includes/project-functions.php'); ?>
<!DOCTYPE html>
<html>

<head>
    
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
    
    

</head>  
    
<body>
    
<header class="container-fluid">
        
        <div id="branding" class="row">
            <div id="logo"><a href="index.php">THE CLUB OF ODD VOLUMES</a></div>
            <div id="cart-close-trigger"><img src="assets/images/icons/close.png"></div>
            <div id="cart-trigger">CART <?php  echo cartTotal(); ?></div>
        </div>
        
        <nav class="row">
            
            <div id="categories-menu-trigger">
                <p>CATEGORIES</p>
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
            </ul>
        </nav>

    
    
    
        
    </header>
    
    <aside id="cart-wrapper"  >
        
      
    </aside>
    
    <div id="fadeout"> </div>    