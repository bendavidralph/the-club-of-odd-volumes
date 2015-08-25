<?php 
    $styleSheets = ["custom-printing","slider",];
    $pageTitle = "Custom Printing";
    $scripts = ["slider"];
    include ('php/modules/_header.php');
?>


<main>
        
    
    <div class="container-fluid">    
    
        <section class="row">
        
            <div id="hero-slider" class="col-xs-12">
                <div class="slide slide1 scale100"></div>
                <div class="slide slide2"></div>
                <div class="slide slide3"></div>
            </div>
        
        </section>
        
    </div>    
    
    <div class="container">
    
        <h2>CHOOSE BELOW TO GET STARTED</h2>
        
        <section class="row">
            
        <?php    
            
            echo displayCustomProduct("TSHIRT","TSHIRT","$16","1");
            echo displayCustomProduct("CUSHION","CUSHION","$19","9");
            echo displayCustomProduct("TOTE","TOTE","$22","11");
            echo "</section><section class='row'>";
            echo displayCustomProduct("PILLOWCASE","PILLOWCASE","$22","12");
            echo displayCustomProduct("JUMPER","JUMPER","$39","5");
            echo displayCustomProduct("BABY","BABY","$14","2");
            echo "</section><section class='row'>";
            echo displayCustomProduct("KIDS JUMPER","KIDSJUMPER","$26","6");
            echo displayCustomProduct("TEA TOWEL","TEATOWEL","$14","10");
            echo displayCustomProduct("KIDS TEE","KIDSTEE","$14","7");


        ?>    
        </section>
    
    
    </div>
    
    
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>


<?php

function displayCustomProduct($productName,$IMG,$price,$ID){
    
?>

   <div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-0">
                <div class="product-wrapper">
                    
                    <div class="available-colors">
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                    </div>
    
           
           
            <a href="custom-printing-wizard?product=<?php echo $ID ?>">
                            <div class="product-image">    
                            <img src="assets/images/custom/templates/<?php echo $IMG ?>.jpg" class="image-1 img-responsive">
                            <img src="assets/images/custom/templates/<?php echo $IMG ?>.jpg" class="image-2 img-responsive">
                            </div>
            </a>

                            <p><a href="product.php">DESIGN YOUR OWN <?php echo $productName; ?> <strong><?php echo "FROM ". $price ?></strong></a></p>
                        </div>
    </div>
            

<?php
    
    
}





?>