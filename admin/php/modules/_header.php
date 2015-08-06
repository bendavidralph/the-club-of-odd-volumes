<? include ('../includes/database.php'); ?>
<? include ('../includes/project-functions.php'); ?>

<!doctype html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Club of Odd Volumes - <? echo $pageTitle ?></title>
    

<link rel="stylesheet" type="text/css" href="assets/fonts/MyFontsWebfontsKit/MyFontsWebfontsKit.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-guide.css" rel="stylesheet">
    <!-- Polyfill -->
    <script src="bootstrap/respond.js"></script>
    
    <!-- Page Specific Styles -->
    <?
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
            <div id="cart-trigger">CART 0</div>
        </div>
        
        <nav class="row">
            
            <div id="categories-menu-trigger">
                <p>CATEGORIES</p>
                <div class="hamburger"></div>
            </div>
            
            <ul>
                <li><a href="catalogue.php">ALL</a></li>
                <li class="divider">///</li>
                <!-- Load Product Categoires from the Databse -->
                <? 

                $query = "SELECT * FROM categories";
                $categories = queryDB($query);

                while($row = mysqli_fetch_assoc($categories)){

                    echo '<li><a href="catalogue.php?category='.$row["id"].'">'.$row["label"].'</a></li>'.
                    '<li class="divider">/</li>';

                }
                ?>
                <li class="divider">///</li>
                <li><a href="catalogue.php">CUSTOM PRINTING</a></li>
            </ul>
        </nav>

    
    
    
        
    </header>
    
    <aside id="cart-wrapper">
        
        <div id="cart">
        
            <div class="cart-product-result"></div>
            <div class="cart-product-result"></div>
            <div class="cart-product-result"></div>
            <div class="cart-product-result"></div>
            <div class="cart-product-result"></div>
        
        </div>
        
        <div id="total-wrapper">
            <div id="total-label">TOTAL</div>
            <div id="total-amt">$185</div>
        </div>
        
        <div id="checkout-button"><a href="checkout.php">CHECKOUT</a></div>
   
    </aside>
    
    <div id="fadeout"> </div>    