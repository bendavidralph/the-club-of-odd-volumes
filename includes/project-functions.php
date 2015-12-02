<?php  

    function displayProduct($productInfo){

    $id = $productInfo['id'];    
    $productName = strtoupper($productInfo['productName']);
    $productPrice = $productInfo['price'];   
    $artist_id = $productInfo['artist_id'];
    $template_id = $productInfo['template_id'];
     
    $colours = getProductColours($template_id);
    
    $product = '<div class="col-xs-6  col-sm-4 heightFix">
                <div class="product-wrapper">';
    
    if($productInfo['newFlag']){
    $product = $product. '<div class="new-flag">NEW</div>';
    }
        
    $product = $product . '<div class="available-colors">'.$colours.'</div>';
    
    
        
    $product = $product. '<a href="product.php?id='.$id.'">
                    <div class="product-image">    
                    <img src="https://theclubofoddvolumes.com/assets/images/product/'.$id.'/SM/1.jpg" class="image-1 img-responsive">
                    <img src="https://theclubofoddvolumes.com/assets/images/product/'.$id.'/SM/2.jpg" class="image-2 img-responsive">
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
            if(isset($_SESSION["cart"]["products"])){
            foreach($_SESSION["cart"]["products"] as $key => $value){
             
                // For Each Stock Item
                foreach($value as $quant){
                      $count = $count + $quant; 
                }
              
            }
            }
            
            if(isset($_SESSION["cart"]["customProducts"])){
            foreach($_SESSION["cart"]["customProducts"] as $key => $value){
             
                // For Each Stock Item
                foreach($value as $quant){
                      $count = $count + $quant; 
                }
              
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
        $total['customProduct'] = 0;
        $total['customQuant'] = 0;
        $total['customDiscount'] = 0;
        $total['discount'] = 0;
        
        
        if(isset($_SESSION['cart'])){
         
            // For Each Product 
            if(isset($_SESSION["cart"]["products"])){
            foreach($_SESSION["cart"]["products"] as $key => $value){
             
                $product =  queryById('product',$key); 
                
                // test for addons
                if(isset($value['addon']) && ($value['addon'] == "true")){
                    $addon = 10;
                }else{
                    $addon = 0;
                }

                //For Each Stock Item 
                foreach($value as $stock_id => $quant){
                    
                    if(!($stock_id == "addon")){
                    
                    $stock =  queryById('stock',$stock_id); 
                        
                    if(isset($_SESSION['discount']) && $_SESSION['discount']['type'] == 'percentage'){  
                        $discountValue = $_SESSION['discount']['value'];
                    }else{
                         $discountValue = 0;   
                    }
                    
                    // Calculate Price x Quantitity 
                    $runningTotal = $stock["surcharge"] + $product["surcharge"] + $addon;
                    $runningTotal = $runningTotal * $quant;
                    
                    // If there is a discount calculate it    
                    $runningDiscount =   $runningTotal * $discountValue;
                    $total['discount'] = $total['discount'] + $runningDiscount; 
                    
                    // Add Price to Total
                    $total['product'] = $total['product'] + $runningTotal;
                    
                        
                    // Calculate Weight 
                    $runningWeightTotal = $stock['weight'] * $quant;
                    $total['weight'] = $total['weight'] + $runningWeightTotal;
                    
                    }}
                    
              
            } // End Product 
                
     
                
            }
            
            
            // For Each Custom Product 
            if(isset($_SESSION["cart"]["customProducts"])){
            foreach($_SESSION["cart"]["customProducts"] as $key => $value){
          
                $product =  queryById('customProduct',$key); 

                 // test for addons
                if(isset($value['addon']) && ($value['addon'] == "true")){
                    $addon = 10;
                }else{
                    $addon = 0;
                }

                //For Each Stock Item 
                foreach($value as $stock_id => $quant){

                    if(!($stock_id == "addon")){    
                    $stock =  queryById('stockCustom',$stock_id); 

                        // Calculate Price x Quantitity 
                        if(isset($_SESSION['user']) && $_SESSION['user'] == 'reseller'){
                            $runningTotal = $stock["resellerRate"] + $addon;
                        }else{
                            $runningTotal = $stock["surcharge"] + $addon;
                        }
                        
                    
                   
                    $runningTotal = $runningTotal * $quant;
                    
                    // Add Quant to Running Quant Counter
                    $total['customQuant'] = $total['customQuant'] + $quant;
                     
                    // Add Price to Total
                    $total['customProduct'] = $total['customProduct'] + $runningTotal;
                    
                    // Calculate Weight 
                    $runningWeightTotal = $stock['weight'] * $quant;
                    $total['weight'] = $total['weight'] + $runningWeightTotal;
                    
                    }}
                    
                $total['customProduct'] = $total['customProduct'] + $product["doublePrint"];

                
                
            } // End Custom Product 
                
            // Calculate Discount
            $total['customDiscount'] = calculateCustomDiscount($total['customProduct'],$total['customQuant']);
            $total['product'] = $total['product'] + ($total['customProduct'] -  $total['customDiscount']);
                
            }
            
            
            if(isset($_SESSION['discount']) && $_SESSION['discount']['type'] == 'shipping'){  
                        $total['shipping'] = $_SESSION['discount']['value'];
            }else{
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
                    
            }
             
             
            $purchasePrice = $total['product'] + $total['shipping'];
            // Deduct Voucher 
            if(isset($_SESSION['discount']) && $_SESSION['discount']['type'] == 'voucher'){
                    
                if($purchasePrice <= $_SESSION['discount']['value']){
                    $total['discount'] = $purchasePrice;
                    $_SESSION['discount']['voucherApplied'] = $purchasePrice;
                }else{
                    $total['discount'] = $_SESSION['discount']['value'];
                    $_SESSION['discount']['voucherApplied'] =$_SESSION['discount']['value'];
                    
                }
                 
                
                    
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


function displaySizingPopUp($category_id){
    
    
    if($category_id == 1){
        $sizeModal = "tee";
    }
    
    switch ($category_id) {
    case 1:
        $sizeModal = "tee";
        break;
    case 2:
        $sizeModal = "jumper";
        break;
    case 3:
        $sizeModal = "baby";
        break;
    case 4:
        $sizeModal = "tote";
        break;
    case 5:
        $sizeModal = "homeware";
        break;
    case 6:
        $sizeModal = "homeware";
        break; 
    case 7:
        $sizeModal = "homeware";
        break; 
    case 8:
        $sizeModal = "homeware";
        break; 

}
    

?>  
  <div class="modal fade sizing" tabindex="-1" role="dialog" aria-labelledby="This is a label">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sizing</h4>
      </div>
      <div class="modal-body">
        <section class="row">
          <img src="assets/images/sizing/<?php echo $sizeModal; ?>.jpg" class="img-responsive"   >
        </section>
    </div>
  </div>
</div>
</div>

<?php
                                          
}

?>


<?php

    function displayProductInfoInCart($imgURL,$productName){
?>        
        
    <div class="container-fluid cart-product-result">
    <section class="row">

    <div class="col-xs-6">    
    <img class="img-responsive" src="assets/<?php echo $imgURL; ?>">
    </div>   

    <div class="cart-product-info col-xs-6"> 
    <h4><?php   echo $productName; ?></h4>    
        
<?php        
    }

?>

<?php 

   function displayCartItem($productID,$value,$type,$addon = 0){
    
                    if($type == "custom"){
                        
                            // Get the design information
                            $productQuery = "SELECT frontDesign, frontDesignIMG_id, backDesign, backDesignIMG_id, doublePrint, discount FROM customProduct WHERE id = '{$productID}' LIMIT 1";
                            $productResult = queryDB($productQuery);


                    while($row = mysqli_fetch_assoc($productResult)){

                                
                                $productName = "Custom Product";
                                $doublePrint = $row["doublePrint"];
                                $discount = $row["discount"];
                                
                                if($row["frontDesign"] == 1){
                                    $productIMG = $row["frontDesignIMG_id"];
                                }else{
                                    $productIMG = $row["backDesignIMG_id"];
                                }
                                
                                
                                
                                $imgURL = "custom-image-uploads/{$productIMG}";
                                
                                displayProductInfoInCart($imgURL,$productName);
                                
                               $stockTableName = "stockCustom";

                            } // End Product While
                        
                    }else{
                            // Get the design information
                            $productQuery = "SELECT productName, surcharge, artist_id FROM product WHERE id = '{$productID}' LIMIT 1";
                            $productResult = queryDB($productQuery);


                            while($row = mysqli_fetch_assoc($productResult)){

                                $artist_id = $row['artist_id'];
                                $productName = $row["productName"];
                                $productSurcharge = $row["surcharge"];
                                $imgURL = "images/product/{$productID}/SM/1.jpg";
                                displayProductInfoInCart($imgURL,$productName);
                                
                                $stockTableName = "stock";

                            } // End Product While
                    }
       
                 
                    
                    $productTotalCost = 0;
                    $runningQuant = 0;
                    foreach($value as $key => $value){
                     
                        // Get the Stock Information 
                        
                          $stockQuery = "SELECT * FROM {$stockTableName} WHERE id = '{$key}' LIMIT 1";
                          $stockResult = queryDB($stockQuery);
                    
                         while($row = mysqli_fetch_assoc($stockResult)){
                             
                        if(isset($_SESSION['user']) && ($_SESSION['user'] == 'reseller') && $type == "custom"){
                            $row["surcharge"] = $row["resellerRate"];
                        }
                         
                        if(isset($productSurcharge)){
                            $subTotal = $row["surcharge"] + $productSurcharge + $addon; 
                        }else{
                            $subTotal = $row["surcharge"] + $addon;
                        }
                          
                        
                        echo "<p>"; 
                        echo $value . " x " . 
                        $row["description"] . " - ".
                        "$".$subTotal;
                            
                        if($addon >= 1){
                            echo " including insert";   
                        } 
                             
                        echo "</p>";    
                         
                       
                             
                        // Set Running $quant for Product 
                        $runningQuant = $runningQuant + $value;
                      
                        $subTotal = $subTotal * $value;
                         
                        $productTotalCost = $productTotalCost + $subTotal;
                         
                        
                         
                         
                     } // End Stock While
                        
                        
                    } // End Stock ForEach
       
                    if(isset($doublePrint) && $doublePrint > 1){
                       echo "<p class='addOn'>{$runningQuant} x double prints ($5 each) <br><strong>Total \${$doublePrint}</strong></p>";
                
                        $productTotalCost = $productTotalCost + $doublePrint;
                        
                    }
        
                    
                   
                 
?>

                    
                        
        
                        </div>
                        <div class="remove-product"><a href="php/POST/remove-from-cart.php?id=<?php echo $productID ?>&type=<?php echo $type ?>">REMOVE</a></div>
                        <div class="cart-product-subtotal">$<?php   echo $productTotalCost; ?></div>
                        </section>
                    </div>
                        
                    
<?php  
       
   }


    function calculateCustomDiscount($total,$quant){
    
     if(isset($_SESSION['user']) && ($_SESSION['user'] == 'reseller')){
           
     }else{    
        

    if($quant < 5 ){
         $discount = 0;
         
    }else if($quant >= 5 && $quant <= 19){
         
        $discount = $total *.1;
        $discount = round($discount, 2);
        
        
     }else if($quant >= 20 && $quant <= 49){
    
        $discount = $total *.2;
        $discount = round($discount, 2);
        
     }else if($quant >= 50){
 
        $discount = $total *.35;
        $discount = round($discount, 2);
      
     }

      return $discount;  
        
    }}
        
?>


