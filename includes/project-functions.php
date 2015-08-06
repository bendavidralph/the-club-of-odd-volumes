<?php

    function displayProduct($productInfo){

    $id = $productInfo['id'];    
    $productName = strtoupper($productInfo['productName']);
    $productPrice = $productInfo['price'];   
   $artist_id = $productInfo['artist_id'];
        
    
    $product = '<div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-0">
                <div class="product-wrapper">
                    
                    <div class="available-colors">
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                    </div>';
    
    if($productInfo['newFlag']){
    $product = $product. '<div class="new-flag">NEW</div>';
    }
        
    $product = $product. '<a href="product.php?id='.$id.'">
                    <div class="product-image">    
                    <img src="assets/images/product/'.$artist_id.'/'.$id.'/SM/1.jpg" class="image-1 img-responsive">
                    <img src="assets/images/product/'.$artist_id.'/'.$id.'/SM/2.jpg" class="image-2 img-responsive">
                    </div>
                    </a>
                    
                    <p><a href="product.php?id='.$id.'">'.$productName.' $'.$productPrice.'</a></p>
                </div>
        </div>';
        
    return $product;
        
    }


        
?>