<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Club of Odd Volumes - Catalogue</title>
    
    <!-- Default Styles -->
    <? include 'php/modules/_styles.php'; ?>
    
    <!-- Page Specific Styles -->
    <link href="css/catalogue.css" rel="stylesheet">
    


</head>

<body>
    
    
    <?php include 'php/modules/_header.php'; ?> 
    
    
    <main class="container">
        
        <!-- Filters -->
        <section id="filters">
        
            <div class="filter">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    POPULAR
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">RANDOM</a></li>
                    <li><a href="#">NEW</a></li>
                  </ul>
                </div> 
            </div><!-- end of filter -->
          
            <div class="filter margin-corection">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    ARTIST
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li><a href="#">CLUB RANGE</a></li>
                    <li><a href="#">CLUB MERCH</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">ALEXIS WINTER</a></li> 
                    <li><a href="#">FURRY LITTLE PEACH</a></li>
                    <li><a href="#">JASMINE DOWLING</a></li>
                    <li><a href="#">MEAT SAUCE</a></li>
                  </ul>
                </div>   
            </div><!-- end of filter -->    
            
            
            <div class="filter margin-corection">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
              </span>
            </div><!-- /input-group -->
            </div> <!-- end of filter -->    

            
        
        
        </section>
        
        
        <!-- Results -->
        <section class="row">
        
              <div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-0">
                <div class="product-wrapper">
                    
                    <div class="available-colors">
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                    </div>
                    
                    <div class="new-flag">NEW</div>
                    
                    <a href="#">
                    <div class="product-image">    
                    <img src="assets/image-placeholders/product.png" class="image-1 img-responsive">
                    <img src="assets/image-placeholders/product-2.png" class="image-2 img-responsive">
                    </div>
                    </a>
                    
                    <p><a href="">EASY COME / EASY GO TEA TOWEL $25</a></p>
                </div>
            </div>      
                  
                  
            <div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-0">
                <div class="product-wrapper">
                    
                    <div class="available-colors">
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                    </div>
                    
                    <div class="new-flag">NEW</div>
                    
                    <a href="#">
                    <div class="product-image">    
                    <img src="assets/image-placeholders/product.png" class="image-1 img-responsive">
                    <img src="assets/image-placeholders/product-2.png" class="image-2 img-responsive">
                    </div>
                    </a>
                    
                    <p><a href="">EASY COME / EASY GO TEA TOWEL $25</a></p>
                </div>
            </div>      
            
               <div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-0">
                <div class="product-wrapper">
                    
                    <div class="available-colors">
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                    </div>
                    
                    <div class="new-flag">NEW</div>
                    
                    <a href="#">
                    <div class="product-image">    
                    <img src="assets/image-placeholders/product.png" class="image-1 img-responsive">
                    <img src="assets/image-placeholders/product-2.png" class="image-2 img-responsive">
                    </div>
                    </a>
                    
                    <p><a href="">EASY COME / EASY GO TEA TOWEL $25</a></p>
                </div>
            </div>      
              
        
        </section>
        
        
    
    </main>
  
    <?php include 'php/modules/_footer.php'; ?>
   
    
    
    
    
<!-- Default Javascript Actions -->
  <? include 'php/modules/_actions.php'; ?>
    
</body>
</html>
