<?php 
    $styleSheets = ["custom-wizard","custom-mask-styles","product"];
    $pageTitle = "Custom Printing Wizard";
    $scripts = ["jquery.form","product-page-template-functions","custom-wizard"];
    include ('php/modules/_header.php');
    include ('php/modules/custom-printing.php');
?>

 <div id="loading"></div>

<?php

    // ################# GET PRODUCT INFORMATION #####################
    

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
         $productTemplate_id = $row["productTemplate_id"];
         $template_id = $row['template_id']; 
        
        $addon = $row["addon"];
        
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




    // ################# GET STOCK INFORMATION #####################


if(isset($_SESSION['user']) && ($_SESSION['user'] == 'reseller')){
       
    $query = "
        SELECT 
        s.id as id,
        s.sizeCategory as sizeCategory,
        s.size as size,
        s.color as color,
        s.resellerRate as surcharge
        FROM `stockCustom` as s
        INNER JOIN templateStockIndex as tsi
        ON s.id = tsi.stock_id
        WHERE tsi.template_id = ".$productTemplate_id."
        AND inStock IS NOT NULL
        ";
    
}else{
     
    $query = "
        SELECT 
        s.id as id,
        s.sizeCategory as sizeCategory,
        s.size as size,
        s.color as color,
        s.surcharge as surcharge
        FROM `stockCustom` as s
        INNER JOIN templateStockIndex as tsi
        ON s.id = tsi.stock_id
        WHERE tsi.template_id = ".$productTemplate_id."
        AND inStock IS NOT NULL
        ";
}




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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove White Background</h4>
      </div>
      <div class="modal-body">
        This is for dark garments only.
        If your mock-up to the left is showing 
        a white background around your 
        design, we can remove this (on most 
        designs) and print with a transparent 
        background. We will email through 
        a preview for you to approve. 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Got It!</button>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="copyrightModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Copyright</h4>
      </div>
      <div class="modal-body">
<h2>We presume you own the artwork we upload. </h2>
         
<strong>Please agree to the following:</strong>
<br><br>
You hold the commercial rights to reproduce the deisgn
<br><br>
If the legal owner cotacts The Club of Odd Volumes, they will be re-directed to you
<br><br>
You understand illegal use of content is a serious offence and leads to penalties plus its just not cool to rip someone off!
      </div>
      <div class="modal-footer">
        <button type="button" id="confirm-copyright" class="btn btn-default" data-dismiss="modal">I AGREE</button>
        
      </div>
    </div>
  </div>
</div>

<?php 
   // remove the duplicates
    
    $category_id = queryById("productTemplate",$productTemplate_id);

    displaySizingPopUp($category_id['category_id']);
    $sizeCategory = array_unique($sizeCategory);

?>
  <!-- Returns -->

        <div class="modal fade discount" tabindex="-1" role="dialog" aria-labelledby="This is a label">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bulk Discount</h4>
              </div>
              <div class="modal-body">
                <section class="row">
                  <img src="assets/images/bulk-pricing/bulk-pricing.jpg" class="img-responsive"   >
                </section>
            </div>
          </div>
        </div>
        </div>

<main>
    
    <?php

    

   

    
    
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
                <div id="previous" class="control"> < </div><div id="next" class="control">></div>    
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
            arsort($products);

            foreach($products as $id => $value){

                if($id == $productToLoad){ $selected ="selected"; 
                }else{ $selected = "";}

                echo " <option value='{$id}'{$selected}>{$value}</option>";

            }


        ?>
        </select>

       <h3>CHOOSE COLOUR</h3>
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
        <!-- Template -->
        <?php

        if(isset($templateName)){
            addTemplateToggle($productTemplate);
        }

        ?>
        <!-- ############## FRONT ############# -->
        <br>
        <h3>ADD IMAGES</h3>
        <p>One image included / second image $5 extra (per item)</p>
        <div class="designInput">    
            <?php if($frontDesign == 1){
                
                addDesignToggle("front",$template_id);

                echo "<div id='frontDesignControls' class='designControls'>";
                    addImageUpload("front");
                    addDesignPlacement("front",$frontDesignOption_1,$frontDesignOption_2);
                    addRemoveWhite("front");
                echo "</div>";

            }
            ?>
        </div>
       
        
        <?php

        if(isset($backDesign)){
            echo '<div class="designInput">';
            addDesignToggle("back",$template_id);

            echo "<div id='backDesignControls' class='designControls'>";
            addImageUpload("back");
            addDesignPlacement("back",$backDesignOption_1,$backDesignOption_2);
            addRemoveWhite("back");
            echo "</div></div>";
            
        }

        ?>

        <div id="file-set-up">
        <strong>Please note:</strong><br> Mock up shown on a medium sized item. Max print size 40 x 43cm. 
        <br><a href="file-set-up-tips.php" target="_blank">For more information checkout 'file set up tips'</a>
        </div>  

<form id="stock-form" name="stock">
<?php $product_id = uniqid(); ?>    
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">


 <?php
            // Find out how many size categories there are 
            $sizeCategoryCount =  count($sizeCategory);


            foreach ( $sizeCategory as $cat){

            // If there is more that one Size category display the category name
            if($sizeCategoryCount > 1){    
            echo '<h3>'.strtoupper($cat).'</h3>';
            }else{
             echo '<h3>SELECT QUANTITY</h3>';   
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

    
                     
    
                   

                  
                    <div id="information-triggers" >
                            <div id="sizing" class="col-xs-5" data-toggle="modal" data-target=".sizing">SIZING</div>
                            <div id="refunds" class="col-xs-5" data-toggle="modal" data-target=".discount">BULK DISCOUNT</div>
                    </div>

                    <div id="here-to-help" class="col-xs-12">
                    We are here to help. If you are having trouble please email <a href="mailto:shop@theclubofoddvolumes.com">shop@theclubofoddvolumes.com </a>   
                    </div>    
    
                         <div class="result" ></div>

                        </div><!-- end product info panel -->

                    <section class="row">
                    <div id="add-to-cart"  class="col-md-4">
                        
                        <div id="errorFrontDesign" class="alert alert-danger" role="alert">Please upload an image for your first design</div>
                        <div id="errorBackDesign" class="alert alert-danger" role="alert">Please upload an image for your second design</div>
                        <div id="errorNoDesigns" class="alert alert-danger" role="alert">You must include at least 1 image</div>
                        
                 
                    <div id="add-to-cart-button" >ADD TO CART</div> 
                        <span class="price-symbol">$</span><div id="price"></div>
                    </div>  
                   
                    </section>
       
        

            </div>

    </section>
</section>                        
                        
                        
    
    <!-- ############## FORM ############# -->      
    

    
        <input type="hidden" id="product_id" name="product_id" value="<?php echo $productToLoad; ?>">
        <input type="hidden" id="template" name="template" value="<?php echo $productTemplate ?>">
        
        <input type="hidden" id="frontDesign" name="frontDesign" value="NULL">
        <input type="hidden" id="frontDesignIMG_id" name="frontDesignIMG_id" value="NULL">
        <input type="hidden" id="frontPlacement" name="frontPlacement" value="">
        <input type="hidden" id="removeWhitefront" name="removeWhiteFront" value="NULL">
        
        <input type="hidden" id="backDesign"  name="backDesign" value="NULL">
        <input type="hidden" id="backDesignIMG_id" name="backDesignIMG_id" value="NULL">
        <input type="hidden" id="backPlacement" name="backPlacement" value="">
        <input type="hidden" id="removeWhiteback" name="removeWhiteBack" value="NULL">
        
        <input type="hidden" id="doublePrint" name="doublePrint" value="0">

        
    
</form>
    
<!--
  
    <div id="results"></div>
-->
    
</main>
  
<?php   include('php/modules/_footer.php'); ?>