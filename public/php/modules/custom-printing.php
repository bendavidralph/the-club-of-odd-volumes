<?php
    function addImagePreviewTemplate1($side,$conf_id,$upload = "true"){
        
        
       

            echo "<li><div class='upload-image-wrapper'>";

            if($upload == "true"){        
               echo "<div id='{$side}-image-mask'> "; 
               echo "<div id='viewimage-{$side}' class='viewimage'></div>";
                    echo "</div>";
            }

            echo "<img src='assets/images/custom/{$conf_id}/white/{$side}/noprint.jpg' class='img-responsive'>";
            echo "</div></li>";

 
    

    
    }


    function addImagePreviewTemplate2($side,$conf_id,$template_id,$upload = "true"){
 
          echo "<li><div class='upload-image-wrapper'>";

                if($upload == "true"){
                    echo "<div id='front-image-mask'> "; 
                    echo "<div id='viewimage-front'></div>";
                    echo "</div>";

                    echo "<div id='back-image-mask'> "; 
                    echo "<div id='viewimage-back'></div>";
                    echo "</div>";
                }


            echo "<img src='assets/images/custom/{$conf_id}/white/{$template_id}/{$side}/noprint.jpg' class='img-responsive'>";
            echo "</div></li>";
    

    
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
            PLACEMENT OPTION 1
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="template-input" id="template-input" class="toggleTemplate" value="2" <?php echo $option2Checked; ?>>
          PLACEMENT OPTION 2
      </label>
    </div>

<?php
        
    }


?>

<?php

function addDesignToggle($side){
        
?>
 <div class="checkbox">
    <label>
      <input type="checkbox" id="<?php echo $side; ?>Design-input" class="toggleDesign"> ADD <?php echo $side; ?> DESGN
    </label>
    </div>
<?php

        
}


?>


<?php

function addImageUpload($side){
 
?>
       
        <form id="img-upload-<?php echo $side; ?>" method="post" enctype="multipart/form-data" action='php/POST/upload-image'>
        Upload your image 
        <input type="file" name="imagefile" id="<?php echo $side; ?>"/>
        </form>
        
    
<?php
    
}

?>

<?php
    function addDesignPlacement($side,$option1Text,$option2Text){
    
        // Test if there is more than 1 option
        // Do no display is less than 1
        if($option2Text){
?>
    <div class="radio">
      <label>
        <input type="radio" name="<?php echo $side; ?>Placement-input" id="<?php echo $side; ?>Placement-input" class="togglePlacement" value="1" checked>
            <?php echo $option1Text ?>
      </label>
    </div>

    <div class="radio">
      <label>
        <input type="radio" name="<?php echo $side; ?>Placement-input" id="<?php echo $side; ?>Placement-input" class="togglePlacement" value="2">
            <?php echo $option2Text ?>
      </label>
    </div>
    

<?php    
    }
    }

?>


<?php

    function addRemoveWhite($side){
?>
 
    <div class="checkbox">
    <label>
      <input type="checkbox" id="removeWhite<?php echo $side ?>-input" class="toggleRemoveWhite"> Remove White Background
    </label>
    </div>

<?php
        
    }

?>


