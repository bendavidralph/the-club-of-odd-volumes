<?php 
    $styleSheets = ["index","slider"];
    $pageTitle = "Home";
    $scripts = ["slider","search"];
    include ('php/modules/_header.php');

    // Instagram
    require '../includes/instagram/src/Instagram.php';
    use MetzWeb\Instagram\Instagram;
    $instagram = new Instagram('9ee2e14b99ad4b0fa41ff25ec60e03af');
    $result = $instagram->getUserMedia("210983064",6);   

?>


<main>
        
    <div class="container-fluid">    
    
        <section class="row">
        
            <div id="hero-slider" class="col-xs-12">
                <div id="slide-1" class="slide" style="display: block;"><a href="catalogue"><img src="assets/images/home-banner/1.jpg" id="img-1" class="img-responsive"></a></div>
                <div id="slide-2" class="slide"><a href="catalogue?&artist=16"><img src="assets/images/home-banner/2.jpg" id="img-2" class="img-responsive"></a></div>
                <div id="slide-3" class="slide"><a href="catalogue?category=7"><img src="assets/images/home-banner/3.jpg" id="img-3" class="img-responsive"></a></div>
            </div>
        
        </section>
        
        <section id="search-wrapper" class="row">
            <div  class="col-xs-10 col-xs-offset-1">
            
                <label for="search" id="search-label"></label>    
                <input type="text" id="search-value" placeholder="SEARCH ARTIST / DESIGN"/>
        
            </div>
        </section>
        
        <section class="row">
        <a href="custom-printing.php">
            <div id="banner-1" class="col-xs-12">
                <img src="assets/images/home-banner/home-banner-1.png" class="img-responsive">
            </div>    
        </a>
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
        </div> <!-- end container -->
    
        <hr>
        
        <div class="container-fluid">
        <section class="row">
            
            <h2 class="col-xs-12"><a href="artists.php">FEATURED ARTISTS</a></h2>

            <?php 
                $query = "SELECT id FROM artist WHERE visible = 1 AND active = 1 ORDER BY RAND() LIMIT 4";
                $artistResult = queryDB($query);

                 while($row = mysqli_fetch_assoc($artistResult)){
            ?>  
            
            <div class="col-xs-6 col-sm-6 col-md-3">
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
            
            <?php

            foreach ($result->data as $media) {
                
                $link = $media->link;
                
                $content = "<div class='col-xs-4 col-sm-4 col-md-2'><a href='{$link}' target='_blank'>";
                // output media
                if ($media->type === 'video') {
                    // video
                    $poster = $media->images->low_resolution->url;
                    $source = $media->videos->standard_resolution->url;
                    $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                } else {
                    // image
                    $image = $media->images->low_resolution->url;
                    $content .= "<img class='img-responsive' src=\"{$image}\"/>";
                }
               
                echo $content . '</a></div>';
            }

?>
           
        
        </section>
        
        
    </div><!-- end of container -->
    
    
     
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>