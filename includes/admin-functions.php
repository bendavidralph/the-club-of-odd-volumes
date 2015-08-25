<?php  

function createTextBoxElement($type,$name = "",$value = ""){
     return  "<span class='td'><input type='{$type}' name='{$name}' class='' value='{$value}'/></span>";
}

 function createSelectElement($list,$name = "",$selected = NULL){
      
    $rv = "<span class='td'><select name='{$name}' class=''>";
    
    foreach($list as $key => $value){
          
        if($key == $selected){
            $rv = $rv. "<option value='{$key}' selected='selected'>".$value."</option>";   
        }else{
            $rv = $rv . "<option value='{$key}'>".$value."</option>";   
        }
    }
    $rv = $rv . "</select></span>";
     
    return $rv; 
                    
}


function createCheckBoxElement($test,$name=""){
     $rv = '<span class="td">';
                if($test){
                    $rv = $rv . "<input name='{$name}' type='checkbox' value='' checked>";
                }else{
                    $rv = $rv . "<input name='{$name}' type='checkbox' value=''>";
                }
     $rv = $rv . '</span>';
    return $rv;
    
}



        
?>