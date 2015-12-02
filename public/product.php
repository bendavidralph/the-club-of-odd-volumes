<?php 
    // Test that a product id has been set
    if(isset($_GET['id']) && $_GET['id'] > 0){
            $id = $_GET['id'];    
    }else{
            header('Location: catalogue.php');      
    }


    // ################# HEADER INCLUDE #####################
    
    $styleSheets = ["product"];
    $pageTitle = "Product";
    $scripts = ["product-page-template-functions","product"];
    include ('php/modules/_header.php');
?>

<?php 
    // ################# GET PRODUCT INFORMATION #####################
    $query = "
        SELECT  p.id as id, 
                p.productName as productName, 
                p.productTemplate_id as productTemplate_id,
                p.surcharge as surcharge, 
                p.artist_id as artist_id,
                pt.basePrice as basePrice, 
                pt.description as description,   
                p.design_id as design_id,
                pt.category_id as category_id,
                pt.addon as addon
        FROM product AS p
        INNER JOIN productTemplate AS pt
        ON p.productTemplate_id = pt.id
        WHERE p.id = '".$id."'
        LIMIT 1
        ";
    
    $productResult = queryDB($query);
    
    while($row = mysqli_fetch_assoc($productResult)){
     
        $productID = $row["id"];
        $productName = $row["productName"];
        $productBasePrice = $row["surcharge"] + $row["basePrice"]; 
        $description = $row["description"];
        $template_id = $row['productTemplate_id'];
        $artist_id = $row["artist_id"];
        $design_id = $row["design_id"];
        $category_id = $row["category_id"];
        $addon = $row["addon"];
        
        $productImgURL = "assets/images/product/{$productID}/BIG/";
    }

    // ################# GET STOCK INFORMATION #####################

 $query = "
        SELECT 
        s.id as id,
        s.sizeCategory as sizeCategory,
        s.size as size,
        s.color as color,
        s.surcharge as surcharge
        FROM `stock` as s
        INNER JOIN templateStockIndex as tsi
        ON s.id = tsi.stock_id
        WHERE tsi.template_id = ".$template_id."
        AND inStock IS NOT NULL
        ";
    
    $productResult = queryDB($query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($productResult)){
        
        $sizeCategory[] = $row["sizeCategory"];
        $stock[$count]["sizeCategory"] = $row["sizeCategory"];
        $stock[$count]["size"] = $row["size"];
        $stock[$count]["color"] = $row["color"];
        $stock[$count]["surcharge"] = $row["surcharge"];
        $stock[$count]["id"] = $row["id"];

        $color[$row["color"]] = $row["surcharge"];
        
        $count ++;
        
        
    }
            
    
 

?>


<main>
  
<?php 
   // remove the duplicates
    displaySizingPopUp($category_id);
    $sizeCategory = array_unique($sizeCategory);

?>

       <!-- Returns -->

        <div class="modal fade returns" tabindex="-1" role="dialog" aria-labelledby="This is a label">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <section class="row">
                  <img src="assets/images/sizing/returns.jpg" class="img-responsive"   >
                </section>
            </div>
          </div>
        </div>
        </div>
    
        <div id="product-shot-controls">
                <div id="previous" class="control"> < </div><div id="next" class="control">></div>    
        </div>
    
        <div id="product-shot-wrapper" >
        
            <div id="product-shots">
            
                <ul>
                    
                    <?php 
           
                    $imageCount = countFilesInDirectory($productImgURL);
                    $count = 1;
                    while($count <= $imageCount){
                        echo" <li id='anchor{$count}'><img src='{$productImgURL}/{$count}.jpg' class='product-IMG'></li>";
                        $count++;
                    }

                    ?>
                

                </ul>
            
            </div>
            
        
        
        </div>
    
        <section class="fluid-container">    
        <section class="row"> 
            
        <div id="product-details-wrapper" class="col-md-4 col-md-offset-8">
            
            <div id="product-info-panel">

                    <h1><?php  echo $productName;?></h1>

                    <?php
                        
                        $artistName = queryById('artist',$artist_id);
                        echo "<h5><a href='catalogue?artist={$artist_id}'>Designed by " . $artistName['artistName']."</a></h5>";


                    ?>
                
                    <div id="description">
                    <?php  echo $description ?>
                    </div>


                    <h3>COLOUR</h3>
                    <div id="color-selector">

                        <ul>
                        <?php 
                        foreach($color as $key => $value){
                            echo "<li id='{$key}-trigger' class='{$key}'>\${$value}</li>";
                        }
                        ?>

                        </ul>

                    </div>

                
                    <?php

                    if((isset($addon)) && ($addon >= 1)){
                    ?> 
                
                    
                    <div id="addon">
                    <h3>EXTRAS</h3>
                         <div class="checkbox">
                            <label>
                              <input name="addon" id="addon" type="checkbox"> Include cushion insert (+ $<?php echo $addon; ?>);
                            </label>
                          </div>
                        
                    </div>
                        
                    <?php 
                    }

                    ?>


                    <?php 
                     // split the size categories 
                    ?>
                    <form id="stock-form" name="stock">
                    <input type="hidden" name="product_id" value="<?php  echo $productID ?>">
                        
                        
                    <?php
                        // Find out how many size categories there are 
                        $sizeCategoryCount =  count($sizeCategory);

                        
                        foreach ( $sizeCategory as $cat){
                            
                        // If there is more that one Size category display the category name
                        if($sizeCategoryCount > 1){    
                        echo '<h3>'.strtoupper($cat).'</h3>';
                        }else{
                         echo '<h3>QUANTITY</h3>';   
                        }
                        echo '<div class="stock-selector"><ul>';
                                foreach ($stock as $value){
                                    if($value["sizeCategory"] == $cat){ 

                                        echo "<li id='{$value['id']}' class='stock-{$value['color']}'>
                                            <div class='add-stock-item initialState'>+</div>
                                            <div id='quantity-selected{$value['id']}' class='quantity-selected selectedState'></div>
                                            <div class='stock-item-contorls' >
                                                <div class='decrement selectedState'>-</div>
                                                <div class='stock-item-label'>{$value['size']}</div>
                                                <div class='increment selectedState'>+</div>
                                            </div>
                                        <input type='hidden' name='trackStockQuant' class='trackStockQuant{$value['id']}' value='0'> 
                                        <input type='hidden' name='stockPrice'  class='stockPrice{$value['id']}' value='{$value["surcharge"]}'> 
                                        </li>";

                                    }
                                }

                        echo '</ul></div>';

                        } // end size cat 

                    ?>
                    </form>

                    <div id="information-triggers" >
                            <div id="sizing" class="col-xs-5" data-toggle="modal" data-target=".sizing">SIZING</div>
                            <div id="refunds" class="col-xs-5" data-toggle="modal" data-target=".returns">RETURNS</div>
                    </div>

                   
                     <div class="result"></div>

                    </div><!-- end product info panel -->
            
                <section class="row">
                    <div id="add-to-cart"  class="col-md-4">
                     <div id="add-to-cart-button" >ADD TO CART</div> 
                        <span class="price-symbol">$</span><div id="price"></div>
                    </div>    
                </section>
   
            
        </div>
        
</section>

    
    <section id="you-may-also-like" class="col-md-12">

            <h2>MORE LIKE THIS</h2>
        
    </section>
        
    <section class="row">
    <div id="you-may-also-like-product-wrapper" class="col-md-8 col-md-push-2">
            
<?php      

            // Get all related products by design 
            
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
                        AND p.design_id = {$design_id}
                        AND p.id != $productID
                        ORDER BY RAND()
                        LIMIT 6";


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
                 
            $numberOfResults = mysqli_num_rows($productResult);

            mysqli_free_result($productResult);    

            // Count the results fill the rest with products from artist 

            

            if($numberOfResults < 6){
                
            $limit = 6 - $numberOfResults;
                 
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
                        AND p.design_id != {$design_id}
                        AND p.artist_id = {$artist_id}
                        ORDER BY RAND()
                        LIMIT {$limit}";


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
                 
            $numberOfResults = mysqli_num_rows($productResult);

  
                
                
            }
            

        
?>  
        </div>
    </section>
    
</section>
        
</main>
  
<?php  include('php/modules/_footer.php'); ?>