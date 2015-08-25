<?php 
    $styleSheets = ["index","slider"];
    $pageTitle = "Home";
    $scripts = ["slider","search"];
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
        
        <section id="search-wrapper" class="row">
            <div  class="col-xs-10 col-xs-offset-1">
            
                <label for="search" id="search-label"></label>    
                <input type="text" id="search-value" placeholder="SEARCH ARTIST / DESIGN"/>
        
            </div>
        </section>
        
        <section class="row">
        
            <div id="banner-1" class="col-xs-12">
                
            </div>    
        
        </section>
    </div> <!-- end fluid container -->
        
    <div class="container">
        
        <section class="row">
        
            <h2  class="col-xs-12">NEW THIS WEEK</h1>
            
        </section>
        
        <section class="row">
            
          <?php      
            
            $query = "SELECT 
                        p.id as id,
                        p.productName as productName,
                        p.surcharge as surcharge,
                        pt.basePrice as basePrice, 
                        p.newFlag as newFlag, 
                        p.artist_id as artist_id,
                        pt.id as template_id
                        FROM product as p
                        INNER JOIN productTemplate as pt
                        ON p.productTemplate_id = pt.id
                        WHERE 
                        p.visible = 1 
                        AND pt.visable = 1
                        AND tags LIKE '%feature%'
                        ORDER BY RAND()
                        LIMIT 3";


            $productResult = queryDB($query);

            while($row = mysqli_fetch_assoc($productResult)){

                $product['id'] = $row['id'];     
                $product['productName'] = $row['productName'];
                $product['price'] = $row['surcharge']+$row['basePrice'];
                $product['newFlag'] = $row['newFlag'];
                $product['artist_id'] = $row['artist_id'];
                 $product['template_id'] = $row['template_id'];
              
                    echo displayProduct($product);

                
            }
                      
            mysqli_free_result($productResult);    
        
         ?>       
          
            
        </section>
        
        <hr>
    
        <section class="row">
            
            <h2 class="col-xs-12"><a href="artists.php">FEATURED ARTISTS</a></h2>

            <?php 
                $query = "SELECT id FROM artist WHERE visible = 1 AND active = 1 ORDER BY RAND() LIMIT 4";
                $artistResult = queryDB($query);

                 while($row = mysqli_fetch_assoc($artistResult)){
            ?>  
            
            <div class="col-xs-6 col-sm-3">
                <div class="artist-wrapper"><a href="catalogue?artist=<?php   echo $row['id']; ?>"><img src="assets/images/artist/<?php   echo $row['id']; ?>.jpg"  class="img-responsive"></a></div>
            </div>

              
            <?php 
                 }
                      

                   mysqli_free_result($artistResult);


            ?>

        

        </section>   

        
        <hr>
        
        <section id="instagram-wrapper" class="row">
        
            <h2 class="col-xs-12"><a href="https://instagram.com/theclubofoddvolumes" target="_blank">@theclubofoddvolumes</a> </h2>
            
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram1.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram2.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram3.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram4.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram5.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram6.png" class="img-responsive"></a></div>

        
        
        </section>
        
        
    </div><!-- end of container -->
    
    
     
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>