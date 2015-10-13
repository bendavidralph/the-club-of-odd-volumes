<?php
    function addImagePreviewTemplate1($side,$conf_id,$upload = "true"){
        
        
       

            echo "<li id='anchor1'><div class='upload-image-wrapper'>";

            if($upload == "true"){        
               echo "<div id='{$side}-image-mask'> "; 
               echo "<div id='viewimage-{$side}' class='viewimage'></div>";
                    echo "</div>";
            }

            echo "<img id='{$side}-IMG' src='assets/images/custom/{$conf_id}/white/{$side}/noprint.jpg' class='product-IMG'>";
            echo "</div></li>";

            // Send the Conf Id to Javascript for image swap
            echo "<script>var productBaseID = {$conf_id};</script>";
    

    
    }


    function addImagePreviewTemplate2($side,$conf_id,$template_id,$upload = "true"){
 
          echo "<li id='anchor2'><div class='upload-image-wrapper'>";

                if($upload == "true"){
                    echo "<div id='front-image-mask'> "; 
                    echo "<div id='viewimage-front'></div>";
                    echo "</div>";

                    echo "<div id='back-image-mask'> "; 
                    echo "<div id='viewimage-back'></div>";
                    echo "</div>";
                }


             echo "<img id='{$side}-IMG' src='assets/images/custom/{$conf_id}/white/{$side}/noprint.jpg' class='product-IMG'>";
            echo "</div></li>";
    
        // Send the Conf Id to Javascript for image swap
                echo "<script>var productBaseID = {$conf_id};</script>";
    

    
    }

?>


<?php

    function addTemplateToggle($productTemplate){
    $option1Checked = "";
    $option2Checked = "";    
    if($productTemplate == 1){ $option1Checked = "checked";}else{
        $option2Checked = "checked";
    }
        
?>
    <div class="radio">
      <label>
        <input type="radio" name="template-input" id="template-input" class="toggleTemplate" value="1" <?php echo $option1Checked; ?> >
            LARGE SINGLE CENTRE PRINT
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="template-input" id="template-input" class="toggleTemplate" value="2" <?php echo $option2Checked; ?>>
        LARGE DOUBLE PRINT
      </label>
    </div>

<?php
        
    }


?>

<?php

function addDesignToggle($side,$template_id){
    if($template_id == 1 && $side == "front"){
        $lable = "front";   
    }else if($template_id == 1 && $side == "back"){
         $lable = "back";   
    }else if($template_id == 2 && $side == "front"){
        $lable = "TOP";   
    }else if($template_id == 2 && $side == "back"){
         $lable = "BOTTOM";   
    }
?>
 <div class="checkbox">
    <label>
      <input type="checkbox" id="<?php echo $side; ?>Design-input" class="toggleDesign"> ADD <?php echo strtoupper ($lable); ?> IMAGE
    </label>
</div>
<?php

        
}


?>


<?php

function addImageUpload($side){
 
?>
       
        <form id="img-upload-<?php echo $side; ?>" method="post" enctype="multipart/form-data" action='php/POST/upload-image'>
        <input type="file" name="imagefile" id="<?php echo $side; ?>" class="upload-trigger"/>
        </form>
        
    
<?php
    
}

?>

<?php
    function addDesignPlacement($side,$option1Text,$option2Text){
    
        // Test if there is more than 1 option
        // Do no display is less than 1
        echo '<div class="image-placemement-wrapper">Placement:';
        if($option2Text){
?>
    
    <div class="radio">
      <label>
        <input type="radio" name="<?php echo $side; ?>Placement-input" id="<?php echo $side; ?>Placement-input" class="togglePlacement" value="1" >
            <?php echo ucwords($option1Text) ?>
      </label>
    </div>

    <div class="radio">
      <label>
        <input type="radio" name="<?php echo $side; ?>Placement-input" id="<?php echo $side; ?>Placement-input" class="togglePlacement" value="2">
            <?php echo ucwords($option2Text) ?>
      </label>
    </div>
    

<?php    
    }else{
       ?>
    <div class="radio" >
      <label>
        <input type="radio" name="<?php echo $side; ?>Placement-input" id="<?php echo $side; ?>Placement-input" class="togglePlacement" value="1" >
            <?php echo $option1Text ?>
      </label>
    </div>


<?php      
        }
        
    echo '</div>';    
    }

?>


<?php

    function addRemoveWhite($side){
?>
 
    <div class="checkbox">
    <label>
      <input type="checkbox" id="removeWhite<?php echo $side ?>-input" class="toggleRemoveWhite"> Remove White Background
    </label>
    <p class="note">This is for dark garments only (<a data-toggle="modal" data-target="#myModal">more information</a>).</p> 
        
        
        
    </div>

<?php
        
    }

?>


