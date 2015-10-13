<?php 
    $styleSheets = ["custom-printing"];
    $pageTitle = "Custom Printing";
    include ('php/modules/_header.php');
?>


<main>
        
    
    <div class="container-fluid">    
    
        <section class="row">
            <div id="banner" class="col-xs-12">
                <img src="assets/images/custom/banners/banner1.jpg" class="img-responsive">
        </div>
        </section>
        
    </div>    
    
    <div class="container">
    
        <h2>CHOOSE BELOW TO GET STARTED</h2>
        
        <section class="row">
            
        <?php    
            
            echo displayCustomProduct("TSHIRT","TSHIRT","1");
            echo displayCustomProduct("CUSHION","CUSHION","9");
            echo displayCustomProduct("TOTE","TOTE","11");
            echo displayCustomProduct("PILLOWCASE","PILLOWCASE","12");
            echo displayCustomProduct("JUMPER","JUMPER","5");
            echo displayCustomProduct("BABY","BABY","2");
            echo displayCustomProduct("KIDS JUMPER","KIDSJUMPER","6");
            echo displayCustomProduct("TEA TOWEL","TEATOWEL","10");
            echo displayCustomProduct("KIDS TEE","KIDSTEE","7");


        ?>    
        </section>
    
        <section id="banners" class="row">
            
            <div class="col-xs-12 col-sm-6">
                <a href="custom-printing-bulk-pricing.php">
                <img src="assets/images/custom/banners/bulk-pricing.jpg" class="img-responsive">
                </a>
            </div>
            
             <div class="col-xs-12 col-sm-6">
                 <a href="file-set-up-tips.php">
                <img src="assets/images/custom/banners/file-set-up-tips.jpg" class="img-responsive">
            </a>
                     </div>
        
        </section>
    
    </div>
    
    
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>


<?php

function displayCustomProduct($productName,$IMG,$ID){
    
?>

   <div class="col-xs-6 col-sm-4">
            
       <div class="product-wrapper">
            
                <div class="product-image"> 
                            <a href="custom-printing-wizard?product=<?php echo $ID; ?>">
                                <img src="assets/images/custom/templates/<?php echo $IMG ?>.jpg" class="image-1 img-responsive">
                                <img src="assets/images/custom/templates/<?php echo $IMG ?>1.jpg" class="image-2 img-responsive">
                            </a>
                </div>
         
                        
         </div>
    </div>
            

<?php
    
    
}



?>