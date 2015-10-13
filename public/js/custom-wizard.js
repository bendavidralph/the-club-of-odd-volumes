$(document).ready(function(){
    
    
    
        $('#product-selector').change(function(){
            
            value = $(this).val();
            window.location = "custom-printing-wizard?product="+value;
            
        });
    

    
        // Image Uplaod 
        $('input[type=file]').change(function() {

                id = $(this).attr("id");
                uploadImage(id);
         
                $("body").addClass("dim-for-loading-body");
                $("#loading").fadeIn();
                
        });
    
     // Toggle Template
        $(".toggleTemplate").click(function(){
            
            value = $(this).val();
            window.location = "custom-printing-wizard?product="+productBaseID+"&template="+value;
        
//            value = $(this).val();
//            id = $(this).attr("id");
//            id = id.replace('-input', '');
//            
//            $("#"+id).val(value);
//          
         
        });
    
    
        // Toggle Design On and Off
        $(".toggleDesign").change(function(){
            
            id = $(this).attr("id");
            id = id.replace('-input', '');
            side = id.replace('Design', '');

            if(this.checked) {
                $("#"+id).val("1");
                $("#"+id+"Controls").show();
                
                $("#"+id+"Controls input:radio:first").attr('checked', true);
                element = $("#"+id+"Controls input:radio:first");
                togglePlacement(element);
                
                
            }else{
                $("#"+id).val("NULL");
                // Hide Controls 
                $("#"+id+"Controls").hide();
                //Clear Form
                $("#"+id+"IMG_id").val("NULL");
                $("#"+side+"Placement").val("NULL");
                $("#removeWhite"+side).val("NULL");
                
                imgUploadField = $("#img-upload-"+side+" input");
                imgUploadField.replaceWith(imgUploadField.val('').clone(true));
                
                $("#viewimage-"+side).html("");
                
                $("#"+id+"Controls input:radio").attr('checked', false);
                
            }
            
             // Re-calculate the total to account for second image
            calucalteSelectedValue();
        

        });
        
        // Toggle Placement
        $(".togglePlacement").click(function(){
            
            element = $(this);
            togglePlacement(element);
            
            
        
        });
    
    
        
        
        // Toggle White Background On and Off
        $(".toggleRemoveWhite").change(function(){
            
            id = $(this).attr("id");
            id = id.replace('-input', '');
            if(this.checked) {
                $("#"+id).val("1");
            }else{
                $("#"+id).val("NULL");
 
            }


        });                       
        
    
        
    
        
    
    setCSSbyViewport();
    pageScrolling();
    
    $(window).scroll(function(){
       
      pageScrolling();
        
    });
    // END OF TEST

    $( window ).resize(function(){
      
        setCSSbyViewport();
        
    });
    
    
  
    
    // Find the first colour and select it
    colourSelect = $("#color-selector ul").find(":first-child").attr("class");
    selectColour(colourSelect);
    
    
    
    $("#color-selector ul li").click(function(){
        
         colour = $(this).attr("class");
       
        if (!(colour.indexOf("active") >= 0)){
                selectColour(colour);
        }
      
        
    });
    
    $(".add-stock-item").click(function(){
        
        var item = $(this).parent();
        addStockItem(item); 
    });
    
    $(".increment").click(function(){
        
        var item = $(this).closest("li");
        addStockItem(item); 
    
    });
    
     $(".decrement").click(function(){
        
        var item = $(this).closest("li");
        removeStockItem(item); 
    
    });
    
    $("#add-to-cart-button").click(function(){

       $('#copyrightModal').modal();
    });
     
    $("#confirm-copyright").click(function(){

        addToCart();
        
    });
    
    
    
     /* Left and Right Product Scroll */
    currentAnchar = 1;
    numberOfImages = $("#product-shots ul").children().length;
    
    $('#next').bind('click',function(event){
        
        if(currentAnchar == 4){
            nextAnchar = 1;
        }else{
            nextAnchar = currentAnchar + 1;
        }
        
		var $anchor = $(this);
		scrollValue = $("#anchor"+nextAnchar).offset().left;
        console.log(scrollValue);

		$('#product-shot-wrapper').stop().animate({
			scrollLeft: "+="+scrollValue
		}, 1000);
		event.preventDefault();
        
        currentAnchar = nextAnchar;
        
        
	});
    
    $('#previous').bind('click',function(event){
		
        if(currentAnchar == 1){
            previousAnchar = 4;
        }else{
            previousAnchar = currentAnchar - 1; 
        }
        
        scrollValue = $("#anchor"+previousAnchar).offset().left;
        console.log(scrollValue);

		$('#product-shot-wrapper').stop().animate({
			scrollLeft: "+="+scrollValue
		}, 1000);
		event.preventDefault();
        
        currentAnchar = previousAnchar;
        
	});
    
    
    
    
    
});
    
      
    



function updateIMG(side,section,value){
        
        if(section == "position"){
            position = value;
        }
    
        if(section == "colour"){
            colour = value;
        }   

        var URL = "assets/images/custom/"+type+"/"+colour+"/"+side+"/"+position+".jpg";
    
        $("#"+side+"-wrapper img").attr("src",URL);
    
    
}



// ############# IMAGE UPLOAD FUNCTIONS ##############

// Send the Image to the server,detect errors, save file, return id
  function uploadImage(id){

            $("#img-upload-"+id).ajaxForm({
            success: function(response) {
                
//                $("#viewimage-"+id).html('');
//                $("#viewimage-"+id).html('<img src="assets/images/loading/loading.gif" />');
//                
                var obj = jQuery.parseJSON(response);
                
                console.log(obj.error);
                
                if(obj.error){
                  alert(obj.error);  
                }else{
                
                   
                    displayIMG(obj,id);
               
                     $("#"+id+"DesignIMG_id").val(obj.imagename);
                    
                }}}).submit();
      
           
 
}
 
// Add the image to the page
function displayIMG(imgURL,id){
        
            var img = new Image();
            $(img).attr('src', "assets/custom-image-uploads/"+imgURL.imagename);
                
                    
            $(img).load( function() {
                
                height = img.height;
                width = img.width;
                
                if(width >= height){
             
                    $(img).addClass("landscape");
                }else{
                    $(img).addClass("portrait");
                    
                }
                
                
                // Place In the Wrapper Tag
                $("#viewimage-"+id).html(img);

                    $("body").removeClass("dim-for-loading-body");
                $("#loading").fadeOut();
                
            }).error( function() {
                alert("Your Image was not succesfully loaded");
            });
            
                  
        }

function togglePlacement(element){
    
            value = element.val();
            id = element.attr("id");
            id = id.replace('-input', '');
            
            $("#"+id).val(value);
          
            // Toggle front image on and off
            // updateIMG("front","position",value);
            
            // Set the Mask
            // find the placment option

                template = $("#template").val();
                maskID = id.replace('Placement', '');
                option = $("#"+maskID+"Placement").val();
                product = $("#product_id").val();
                maskID = id.replace('Placement', '');
    
                if(template >1){
                    template = 2;
                }else{
                    template = '';
                }
    
            $("#"+maskID+"-image-mask").removeClass();
            $("#"+maskID+"-image-mask").addClass("product_"+product+"_"+maskID+"do"+option+template);
            
           
}

//function setCSSbyViewport(){
//    
////    headerHeight = $("header").height();
////    wrapperHeight = $( window ).height() - headerHeight;
//    
//    headerHeight = $("header").height();
//    windowHeight = $(window).height();
//    
//    wrapperHeight = windowHeight - headerHeight;
//
//    
//    $("#product-shot-wrapper").css("top",headerHeight+"px");
//    $("#product-shot-wrapper").css("height",wrapperHeight+"px");
//    
//    // Set the Product Details to have a min height 
//    
//     $("#product-details-wrapper").css("min-height",wrapperHeight+"px");
//    
//    imageWidth = $("#product-shots ul li").outerWidth(true);
//
//    // Count the amount of child elemenets 
//    count = $("#product-shots ul li").length;
//
//    imageWidth = imageWidth + 40;
//    productShotsWidth = imageWidth * count;
//    
//
//    // set  product-shots to the width of containing images
//    $("#product-shots").width(productShotsWidth);
//    
//    
//    
// 
//}

function selectColour(colour){
    
    // Hide Non Selected Colours 
    $(".stock-selector ul li").removeClass("includeInCount");
    $("#color-selector ul li").removeClass("active");
    
    // Update the Product Image 
    $("#front-IMG").attr("src","assets/images/custom/"+productBaseID+"/"+colour+"/front/noprint.jpg")
    $("#back-IMG").attr("src","assets/images/custom/"+productBaseID+"/"+colour+"/back/noprint.jpg")
    
     // Focus Colour Selections    
    $(".stock-"+colour).addClass("includeInCount");
    $("#"+colour+"-trigger").addClass("active");

    
    
    // Re Calculate Price
    calucalteSelectedValue()
    
    
}
//
//function addStockItem(item){
//    
//    id = item.attr("id");
//    currentValue = $(".trackStockQuant"+id).val();
//    newValue = parseInt(currentValue) + 1;
//    $(".trackStockQuant"+id).val(newValue);
//    $("#quantity-selected"+id).html(newValue);
//    
//    // Re Calculate Cart
//    calucalteSelectedValue();
//    
//    if(newValue == 1){
//        convertToSelectedState(item); 
//    }
//    
//}
//
//function removeStockItem(item){
//    
//    id = item.attr("id");
//    currentValue = $(".trackStockQuant"+id).val();
//    newValue = parseInt(currentValue) - 1;
//    $(".trackStockQuant"+id).val(newValue);
//    $("#quantity-selected"+id).html(newValue);
//    
//    // Re Calculate Cart
//    calucalteSelectedValue();
//    
//    if(newValue == 0){
//        convertToUnselectedState(item); 
//    }
//    
//   
//    cartValue = $("#price").html();
//    if(parseInt(cartValue) == 0){
//        
//        $( "#add-to-cart" ).fadeOut();
// 
//    }
//    
//}
//
//
//function convertToSelectedState(item){
//    
//
//    $(item).find(".initialState").hide();
//    $(item).find(".selectedState").show();
//    
//    
//    cartValue = $("#price").html();
//    
//    if(parseInt(cartValue) >= 1){
//    
//        $( "#add-to-cart" ).fadeIn();
// 
//    }
//      
//
//}
//

function calucalteSelectedValue(){
    
    runningValue = 0;
    runningQuantity = 0;
    
    
    
    $("#stock-form").find(".includeInCount").each(function(){
       
        quantity = $(this).find("input[name='trackStockQuant']").val();
        price = $(this).find("input[name='stockPrice']").val();
        
        if(quantity >= 1){
            subtotal =  parseInt(quantity) * price;
            runningValue = runningValue + subtotal;
            runningQuantity = runningQuantity +  parseInt(quantity)
        }
        
        
      
        
      
        
    });
    
    doublePrint = 0;

    // Add Double Print Surchage
    if(($("#frontDesign").val() == 1) && (($("#backDesign").val() == 1))){

        doublePrint = runningQuantity * 5;
            
    }else{
        doublePrint = 0;
       
    }
    
    $("#doublePrint").val(doublePrint);
    
    runningValue = runningValue + doublePrint;
    
     $("#price").html(runningValue);
    
      if(runningValue < 1){
       $( "#add-to-cart" ).hide();
    }else{
            $( "#add-to-cart" ).fadeIn();
    }
    
    
}



function addToCart(){
    
    // Get all Stock Stock Ids
    
    data = [];
    customProduct = [];
    product_id = $("input[name='product_id']").val();
    
    if($("input[name='addon']").is(":checked")){
       addon = "true";
    }
    else{
       addon = "false";
    }
    
    customProduct.push(["product_id",$("#product_id").val()]);
    customProduct.push(["template",$("#template").val()]);
    customProduct.push(["frontDesign",$("#frontDesign").val()]);
    customProduct.push(["frontDesignIMG_id",$("#frontDesignIMG_id").val()]);
    customProduct.push(["frontPlacement",$("#frontPlacement").val()]);
    customProduct.push(["removeWhitefront",$("#removeWhitefront").val()]);
    customProduct.push(["backDesign",$("#backDesign").val()]);
    customProduct.push(["backDesignIMG_id",$("#backDesignIMG_id").val()]);
    customProduct.push(["backPlacement",$("#backPlacement").val()]);
    customProduct.push(["removeWhiteback",$("#removeWhiteback").val()]);
    customProduct.push(["doublePrint",$("#doublePrint").val()]);
    customProduct.push(["addon",addon]);
    
    data.push(customProduct);
    
    
    
    
    $("#stock-form").find(".includeInCount").each(function(){
        
        id = $(this).attr("id");
        quantity = $(this).find("input[name='trackStockQuant']").val();
        
        if(quantity >= 1){
         data.push([product_id,id,quantity]);
                
        }
        

     });
    
   if(($("#frontDesign").val() == 1) && ($("#frontDesignIMG_id").val() == "NULL")){
            errorFrontDesign = "fail";   
            $("#errorFrontDesign").show();
   }else{
            errorFrontDesign = "pass"; 
       $("#errorFrontDesign").hide();
   }
    
    if(($("#backDesign").val() == 1) && ($("#backDesignIMG_id").val() == "NULL")){
            errorBackDesign = "fail"; 
        $("#errorBackDesign").show();
   }else{
            errorBackDesign = "pass";  
       $("#errorBackDesign").hide();
   }
    
    if(($("#backDesign").val() != 1) && ($("#frontDesign").val() != 1)){
            errorNoDesigns = "fail"; 
        $("#errorNoDesigns").show();
    }else{
            errorNoDesigns = "pass"; 
        $("#errorNoDesigns").hide();
   }
    
    if((errorFrontDesign == "pass") && (errorBackDesign == "pass") && (errorNoDesigns == "pass") ){
        
    
    
    $.post( "php/POST/custom-add-to-cart",{"data":data}, function( data ) {
        
//      $("#results").html("<pre>"+data+"</pre>");    
        
     location.reload();
        
        
    });
    
   }
    
    
};

