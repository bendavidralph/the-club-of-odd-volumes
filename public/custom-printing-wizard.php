<?php 
    $styleSheets = ["custom-wizard","custom-mask-styles","product"];
    $pageTitle = "Home";
    $scripts = ["jquery.form","custom-wizard"];
    include ('php/modules/_header.php');
    include ('php/modules/custom-printing.php');
?>

 
<?php

    // ################# GET STOCK INFORMATION #####################

 $query = "
        SELECT * FROM `stock` as s
        INNER JOIN templateStockIndex as tsi
        ON s.id = tsi.stock_id
        WHERE tsi.template_id = 3
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

    $sizeCategory = array_unique($sizeCategory);

?>



<main>
    
    <?php

    if(isset($_GET['product'])){
        $productToLoad = $_GET['product'];
    }else{
        $productToLoad = 1;
    }

    if(isset($_GET['template'])){
        $productTemplate = $_GET['template'];
    }else{
        $productTemplate = 1;
    }


    $query = "SELECT * FROM customProductConf WHERE id = {$productToLoad} AND template_id = {$productTemplate}";
    $results = queryDB($query);

    
    while($row = mysqli_fetch_assoc($results)){
        
         $conf_id = $row['id'];
         $name = $row['name'];
        
         $template_id = $row['template_id']; 
        
        if($row['templateName']){
           
            $templateName = $row['templateName'];
        }
        

        if($row['frontDesign']){
            $frontDesign = 1;
            $frontDesignOption_1 = $row['frontDesignOption_1'];
            $frontDesignOption_2 = $row['frontDesignOption_2'];
            
        }
        
        if($row['backDesign']){
           
         $backDesign = 1;
         $backDesignOption_1 = $row['backDesignOption_1'];
         $backDesignOption_2 = $row['backDesignOption_2'];   
            
        }
        

        
          
    }
      

    mysqli_free_result($results);


    
    
    ?>

<!-- ##############   IMAGES   #################### -->
    <div id="product-shot-wrapper" >
        
            <div id="product-shots">
            
            <ul>
                    
                <?php

                    // if Template 1
                    if($template_id == 1){ 

                    addImagePreviewTemplate1("front",$conf_id);

                        if(isset($backDesign)){
                        addImagePreviewTemplate1("back",$conf_id);
                        }else{
                        addImagePreviewTemplate1("back",$conf_id,"false");
                        }

                    }else{

                        addImagePreviewTemplate2("front",$conf_id,$template_id);
                        addImagePreviewTemplate2("back",$conf_id,$template_id,"false");


                    }

               ?>
        
  
            </ul>
            
            </div>
            
            <div id="product-shot-controls">
                <div id="previous" class="control"> < </div><div id="next" class="control"> > </div>    
            </div>
        
    </div>
    
<!-- ##############   END   #################### -->
        
        
        
        
<section class="fluid-container">    
    <section class="row"> 
        
    <div id="product-details-wrapper" class="col-md-4 col-md-offset-8">

    <div id="product-info-panel">



        <!-- Product -->
        <select id="product-selector" class="form-control">
        <?php

            $products = queryDBIndexByID("name","customProductConf");

            foreach($products as $id => $value){

                if($id == $productToLoad){ $selected ="selected"; 
                }else{ $selected = "";}

                echo " <option value='{$id}'{$selected}>{$value}</option>";

            }


        ?>
        </select>

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




        <!-- Template -->
        <?php

        if(isset($templateName)){
            addTemplateToggle($productTemplate);
        }

        ?>
        <hr>
        <!-- ############## FRONT ############# -->

        <?php if($frontDesign == 1){

            addDesignToggle("front");
            addImageUpload("front");

            addDesignPlacement("front",$frontDesignOption_1,$frontDesignOption_2);

            addRemoveWhite("front");

        }

 

        if(isset($backDesign)){

            addDesignToggle("back");

            addImageUpload("back");

            addDesignPlacement("back",$backDesignOption_1,$backDesignOption_2);

            addRemoveWhite("back");

        }

        ?>



<form id="stock-form" name="stock">
<?php $product_id = uniqid(); ?>    
<input type="text" name="product_id" value="<?php echo $product_id; ?>">


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
                            <input type='text' name='trackStockQuant' class='trackStockQuant{$value['id']}' value='0'> 
                            <input type='text' name='stockPrice'  class='stockPrice{$value['id']}' value='{$value["surcharge"]}'> 
                            </li>";

                        }
                    }

            echo '</ul></div>';

            } // end size cat 

 ?>


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
</section>                        
                        
                        
    
    <!-- ############## FORM ############# -->      
    

    
        <input type="text" id="product_id" name="product_id" value="<?php echo $productToLoad; ?>">
        <input type="text" id="template" name="template" value="NULL">
        
        <input type="text" id="frontDesign" name="frontDesign" value="NULL">
        <input type="text" id="frontDesignIMG_id" name="frontDesignIMG_id" value="">
        <input type="text" id="frontPlacement" name="frontPlacement" value="">
        <input type="text" id="removeWhitefront" name="removeWhiteFront" value="NULL">
        
        <input type="text" id="backDesign"  name="backDesign" value="NULL">
        <input type="text" id="backDesignIMG_id" name="backDesignIMG_id" value="">
        <input type="text" id="backPlacement" name="backPlacement" value="">
        <input type="text" id="removeWhiteback" name="removeWhiteBack" value="NULL">
        
      
        
    
</form>
    
  
    <div id="results"></div>
    
</main>
  
<?php   include('php/modules/_footer.php'); ?>