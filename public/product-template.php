<?php 
    $styleSheets = ["product-template"];
    $pageTitle = "product-template";
    include ('php/modules/_header.php');
?>


<main>
        
    <div id="product-container">
        
        <div id="product-nav-controls">
        
        </div>
    
        <section class="row" >
        
            
            <div id="product-preview-wrapper" class="col-md-8">

                <ul>
                    <li><img src="assets/images/product/90/BIG/1.jpg" ></li>
                    <li><img src="assets/images/product/90/BIG/2.jpg" ></li>
                    <li><img src="assets/images/product/90/BIG/1.jpg" ></li>
                
                </ul>
            
            </div>
            
            <div id="product-controls-wrapper" class="col-md-4">
            
                    <div id="product-controls">
                
                
                    </div>
            
                    <div id="add-to-cart" class="col-md-4">
                        this should appear above everything else 
                    </div>
                
            </div>
        
        
        </section>
    
        
    
    </div>
    
    
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>