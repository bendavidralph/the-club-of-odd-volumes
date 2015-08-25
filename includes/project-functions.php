<?php  

    function displayProduct($productInfo){

    $id = $productInfo['id'];    
    $productName = strtoupper($productInfo['productName']);
    $productPrice = $productInfo['price'];   
    $artist_id = $productInfo['artist_id'];
    $template_id = $productInfo['template_id'];
     
    $colours = getProductColours($template_id);
    
    $product = '<div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-0">
                <div class="product-wrapper">
                    
                <div class="available-colors">'.$colours.'</div>';
    
    if($productInfo['newFlag']){
    $product = $product. '<div class="new-flag">NEW</div>';
    }
        
    $product = $product. '<a href="product.php?id='.$id.'">
                    <div class="product-image">    
                    <img src="assets/images/product/'.$id.'/SM/1.jpg" class="image-1 img-responsive">
                    <img src="assets/images/product/'.$id.'/SM/2.jpg" class="image-2 img-responsive">
                    </div>
                    </a>
                    
                    <p><a href="product.php?id='.$id.'">'.$productName.' $'.$productPrice.'</a></p>
                </div>
        </div>';
        
    return $product;
        
    }


    
    function countFilesInDirectory($productImgURL,$extension = ".jpg"){
     
          if (glob($productImgURL . "*".$extension) != false)
            {
             $filecount = count(glob($productImgURL . "*.jpg"));
             return $filecount;
            }
        else
            {
             return 0;
            }

        
    }

function getProductColours($id){
    
        $colourHTML = "";
        $colourList =[];
    
     $query  = "SELECT s.color 
                FROM stock AS s
                INNER JOIN templateStockIndex as tsi
                ON s.id = tsi.stock_id
                WHERE tsi.template_id = {$id}";
    
       $result = queryDB($query);
        
            while($row = mysqli_fetch_assoc($result)){
                $colourList[] = $row['color'];
            }
    
       
        mysqli_free_result($result);
         
        $colourList = array_unique($colourList);
        
//        echo "<br>";
//        print_r($colourList);
//        echo "<br>";
    
        foreach($colourList as $value){
            $colourHTML  = $colourHTML ."<div class='color {$value}'></div>";
        }

           
        return $colourHTML;
    
}

// PRODUCT FILTERS
function generateFilterURL($for){

    // $for = categories, Artists, Sort or Search 
    $filters = collectAndProccessFilters();
    
    switch ($for) {
        case "category":
            $URL = $filters['artistURL'].$filters['sortURL'].$filters['searchURL'];
        break;
        case "artist":
            $URL = $filters['sortURL'].$filters['categoryURL'].$filters['searchURL'];
        break;
        case "sort":
            $URL = $filters['artistURL'].$filters['categoryURL'].$filters['searchURL'];
        break;
        case "search":
           // Nothing yet
        break;
        case "page":
            $URL = $filters['artistURL'].$filters['sortURL'].$filters['categoryURL'].$filters['searchURL'];    
        break;    
            
    }
            
    return $URL;        
    

}


function collectAndProccessFilters(){
    
    // FIND SELECTED CATEGORY
     if(isset($_GET['category'])){
            $selected['category'] = "AND pt.category_id = {$_GET['category']}";   
            $selected['categoryURL'] = "&category={$_GET['category']}";
     }else{
             $selected['category'] = "";
             $selected['categoryURL'] = "";
     }

    // FIND SORT ORDER
    if(isset($_GET['sort'])){
    if($_GET['sort'] == 'new'){
        $selected['sort'] = "ORDER BY p.newFlag DESC, p.displayPriority";   
        $selected['sortURL'] = "&sort={$_GET['sort']}";
    }}else{
        $selected['sort'] = "ORDER BY p.displayPriority, p.newFlag DESC";  
        $selected['sortURL'] = "";
    }

    // FIND SELECTED ARTIST
    if(isset($_GET['artist'])){
       $selected['artist'] = "AND p.artist_id = {$_GET['artist']}";
       $selected['artistURL'] = "&artist={$_GET['artist']}";
    }else{
       $selected['artist'] = "";
       $selected['artistURL'] = "";
    }
    
    
    // FIND SEARCH 
   
    
    if(isset($_GET['search']) && !(trim($_GET['search']) == '')){
        
        $phrase = explode(" ", $_GET['search']);
        $keywords = "";
        
        foreach($phrase as $key => $value){
            $keywords = $keywords . "{$value}*";
        }
        
       $selected['search'] = "AND MATCH(productName, tags) AGAINST ('{$keywords}' IN BOOLEAN MODE)";
        $selected['searchQuery'] = $_GET['search'];
        $selected['searchURL'] = "&search={$_GET['search']}";
        
    
    }else{
        $selected['search'] = "";    
        $selected['searchQuery'] = "";
        $selected['searchURL'] = "";
    }

    return $selected;

}


    // CART

    function cartTotal(){
        // Function is Depricated
       return calculateCartQuant();
    }


    function calculateCartQuant(){
     
        $count = 0;
        if(isset($_SESSION['cart'])){
         
            // For Each Product 
            foreach($_SESSION["cart"]["products"] as $key => $value){
             
                // For Each Stock Item
                foreach($value as $quant){
                      $count = $count + $quant; 
                }
              
            }
            
            return $count;
        }else{
         
            return 0; 
            
        }
        
        
    }


    function calculateCartValue($counrty = "notSelected"){
     
        $total['shipping'] = 0;
        $total['product'] = 0;
        $total['weight'] = 0;
        
         if(isset($_SESSION['cart'])){
         
            // For Each Product 
            foreach($_SESSION["cart"]["products"] as $key => $value){
             
                $product =  queryById('product',$key); 

                //For Each Stock Item 
                foreach($value as $stock_id => $quant){
                    
                    $stock =  queryById('stock',$stock_id); 
                    
                    // Calculate Price x Quantitity 
                    $runningTotal = $stock["surcharge"] + $product["surcharge"];
                    $runningTotal = $runningTotal * $quant;
                    
                    // Add Price to Total
                    $total['product'] = $total['product'] + $runningTotal;
                    
                    // Calculate Weight 
                    $runningWeightTotal = $stock['weight'] * $quant;
                    $total['weight'] = $total['weight'] + $runningWeightTotal;
                    
                }
                    
              
            }
             
             if($counrty == "notSelected"){
                 
                 $total['shippingWarning'] = "TBD";
                 
             }else{
             // Look up weight for total Cart
             $weightQuery = "SELECT {$counrty} FROM shippingPrice WHERE minWeight <= {$total['weight']} AND maxWeight >= {$total['weight']} LIMIT 1";
             $weightResult = queryDB($weightQuery);

                    while($row = mysqli_fetch_assoc($weightResult)){

                      $total['shipping'] = $row[$counrty];
                    }

             mysqli_free_result($weightResult);
             
             }
             
             
            return $total;
             
        }else{
         
            return $total;
            
        }
        
        
        
    }

   

function queryById($table,$id){
    
      $stockQuery = "SELECT * FROM {$table} WHERE id = '{$id}' LIMIT 1";
                    $stockResult = queryDB($stockQuery);

                    while($row = mysqli_fetch_assoc($stockResult)){

                        return $row;
                    }

      mysqli_free_result($stockResult);
    
    
}

?>