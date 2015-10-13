<?php


    $file_formats = array("jpg", "png", "gif", "bmp", "jpeg"); // Set File format
    $filepath = "assets/custom-image-uploads";
    $saveToPath = "../../assets/custom-image-uploads/";

//    if ($_POST['submitbtn']=="Submit") {

      $name = $_FILES['imagefile']['name'];
      $size = $_FILES['imagefile']['size'];

       if (strlen($name)) {
           
          $extension = substr($name, strrpos($name, '.')+1);
          $extension = strtolower($extension);
            if (in_array($extension, $file_formats)) { 
              if ($size < (8000 * 8000)) {
                 $imagename = md5(uniqid().time()).".".$extension;
                 $tmp = $_FILES['imagefile']['tmp_name'];
                 if (move_uploaded_file($tmp, $saveToPath . $imagename)) {
                     
                     echo returnImage($filepath,$imagename);
               
                 } else {
                    $arr = array('error' => "Could not move the file.");
                    echo json_encode($arr);
             }
          } else {
                  $arr = array('error' => "Your image size is a little to big.");
                  echo json_encode($arr);
          }
           } else {

              $arr = array('error' => "Invalid file format.");
              echo json_encode($arr);
           }
      } else {

                $arr = array('error' => "Please select image..!");
                echo json_encode($arr);
      }


//    exit();
//    }

?>

<?php

    function returnImage($filepath,$imagename){
     
         //echo '<img class="preview" alt="" src="'.$filepath.'/'. 
        //        $imagename .'" />';
        
        $arr = array('filePath' => $filepath, 'imagename' => $imagename);

        return json_encode($arr);
             
        
    }


?>