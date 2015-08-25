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
    $scripts = ["product"];
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
                pt.description as description            
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
        
        $productImgURL = "assets/images/product/{$productID}/BIG/";
    }

    // ################# GET STOCK INFORMATION #####################

 $query = "
        SELECT * FROM `stock` as s
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

    $sizeCategory = array_unique($sizeCategory);

?>

       
    
        <div id="product-shot-wrapper" >
        
            <div id="product-shots">
            
                <ul>
                    
                    <?php 
           
                    $imageCount = countFilesInDirectory($productImgURL);
                    $count = 1;
                    while($count <= $imageCount){
                        echo" <li><img src='{$productImgURL}/{$count}.jpg' ></li>";
                        $count++;
                    }

                    ?>
                

                </ul>
            
            </div>
            
            <div id="product-shot-controls">
                <div id="previous" class="control"> < </div><div id="next" class="control"> > </div>    
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

                                        echo "
                                        <li id='{$value['id']}' class='stock-{$value['color']}'>
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

                    <div id="information-triggers">
                        <div id="sizing">SIZING</div>
                        <div id="refunds">RETURNS</div>
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

            <h3>MORE LIKE THIS</h3>


    </section>
    
</section>
        
</main>
  
<?php  include('php/modules/_footer.php'); ?>