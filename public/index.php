<?
    $styleSheets = ["index"];
    $pageTitle = "Home";
    include ('php/modules/_header.php');
?>


<main>
        
    <div class="container-fluid">    
    
        <section class="row">
        
            <div id="hero-slider" class="col-xs-12">
                <div class="slide slide1 scale100"></div>
                <div class="slide slide2"></div>
                <div class="slide slide3"></div>
                 <div class="slide slide4"></div>
            </div>
        
        </section>
        
        <section id="search-wrapper" class="row">
            <div  class="col-xs-10 col-xs-offset-1">
            
                <label for="search" id="search-label"></label>    
                <input type="text" id="search" placeholder="SEARCH ARTIST / DESIGN"/>
        
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
            
          <?    
            $productsToDisplay = [1,2,3];

            foreach ($productsToDisplay as $value){
                echo displayProduct(1);
            }
        
        ?>       
          
            
        </section>
        
        <hr>
    
        <section class="row">
            
            <h2 class="col-xs-12">FEATURED ARTISTS</h2>
            

            <div class="col-xs-6 col-sm-3">
                <div class="artist-wrapper"><a href="#"><img src="assets/image-placeholders/artist-1.jpg"  class="img-responsive"></a></div>
            </div>

            <div class="col-xs-6 col-sm-3">
                <div class="artist-wrapper"><a href="#"><img src="assets/image-placeholders/artist-2.jpg"  class="img-responsive"></a></div>
            </div>

            <div class="col-xs-6 col-sm-3">
                <div class="artist-wrapper"><a href="#"><img src="assets/image-placeholders/artist-3.jpg"  class="img-responsive"></a></div>
            </div>

             <div class="col-xs-6 col-sm-3">
                 <div class="artist-wrapper"><a href="#"><img src="assets/image-placeholders/artist-4.jpg"  class="img-responsive"></a></div>
            </div>

        </section>   

        
        <hr>
        
        <section id="instagram-wrapper" class="row">
        
            <h2 class="col-xs-12">@theclubofoddvolumes</h2>
            
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram1.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram2.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram3.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram4.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram5.png" class="img-responsive"></a></div>
            <div class="col-xs-6 col-sm-4 col-md-2"><a href="#"><img src="assets/image-placeholders/instagram6.png" class="img-responsive"></a></div>

        
        
        </section>
        
    </div><!-- end of container -->
    
    
     
        
</main>
  
<? include('php/modules/_footer.php'); ?>