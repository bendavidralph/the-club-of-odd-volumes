<?php 
    $styleSheets = ["custom-wizard"];
    $pageTitle = "Home";
    $scripts = ["jquery.form"];
    include ('php/modules/_header.php');
?>




<main class="container">

   
    <form id="img-upload-front" method="post" enctype="multipart/form-data" action='php/POST/upload-image'>
        Upload your image 
        <input type="file" name="imagefile" id="front"/>
    </form>
    
     <form id="img-upload-back" method="post" enctype="multipart/form-data" action='php/POST/upload-image'>
        Upload your image 
        <input type="file" name="imagefile" id="back"/>
    </form>
    
    
<!-- The uploaded image will display here -->
    
<div id='viewimage-front'>FRONT</div>
<div id='viewimage-back'>BACK</div>


</main>


  
<?php   include('php/modules/_footer.php'); ?>


<script type="text/javascript" >
    
$(document).ready(function() {
      
        $('input[type=file]').change(function() {

                id = $(this).attr("id");
                uploadImage(id);
           
        });

});
    
        function uploadImage(id){

            $("#img-upload-"+id).ajaxForm({
            success: function(response) {
                
                var obj = jQuery.parseJSON(response);
                
                console.log(obj.error);
                
                if(obj.error){
                  alert(obj.error);  
                }else{
                
                    $("#viewimage-"+id).html('');
                    $("#viewimage-"+id).html('<img src="assets/images/loading/loading.gif" />');
                    displayIMG(obj,id);
               
                }
                
         }
         }).submit();
            
            
        }
   
        function displayIMG(imgURL,id){
        
            var img = new Image();
            $(img).attr('src', "assets/custom-image-uploads/"+imgURL.imagename);
                
                    
            $(img).load( function() {
                
                // Compare the Height and Width
                alert("height: " + img.height);
                
                // Place In the Wrapper Tag
                $("#viewimage-"+id).html(img);

            }).error( function() {
                alert("DANGER!... DANGER!...");
            });
            
                  
        }

    
</script>