function setCSSbyViewport(){
   
//    headerHeight = $("header").height();
//    wrapperHeight = $( window ).height() - headerHeight;
    
    headerHeight = $("header").height();
    windowHeight = $(window).height();
    
    wrapperHeight = windowHeight - headerHeight;
    
    
    
    if($("body").width()  >= 992){
        
         $("#product-shot-wrapper").css("top",headerHeight+"px");
        $(".product-IMG").css("height",wrapperHeight+"px");
        $("#product-shot-wrapper").css("height",wrapperHeight+"px");

        // Set the Product Details to have a min height 

        $("#product-details-wrapper").css("min-height",wrapperHeight+"px");

       productShotControls = (wrapperHeight + headerHeight) - 61;
        $("#product-shot-controls").css("top",productShotControls+"px");
        
    }else{
       
        
        $("#product-shot-wrapper").css("top",headerHeight+"px");
        
        wrapperHeight = wrapperHeight - 100;
        $(".product-IMG").css("height",wrapperHeight+"px");
        $("#product-shot-wrapper").css("height",wrapperHeight+"px");

        // Set the Product Details to have a min height 

        $("#product-details-wrapper").css("overflow","show");
        $("#product-details-wrapper").css("height","auto");

        
        productShotHeight = $("#product-shot-wrapper").height();
        productShotControls = (productShotHeight + headerHeight) - 61;
        $("#product-shot-controls").css("top",productShotControls+"px");

        
    }
    
    
    
 
}


function addStockItem(item){
    
    id = item.attr("id");
    currentValue = $(".trackStockQuant"+id).val();
    newValue = parseInt(currentValue) + 1;
    $(".trackStockQuant"+id).val(newValue);
    $("#quantity-selected"+id).html(newValue);
    
    // Re Calculate Cart
    calucalteSelectedValue();
    
    if(newValue == 1){
        convertToSelectedState(item); 
    }
    
}

function removeStockItem(item){
    
    id = item.attr("id");
    currentValue = $(".trackStockQuant"+id).val();
    newValue = parseInt(currentValue) - 1;
    $(".trackStockQuant"+id).val(newValue);
    $("#quantity-selected"+id).html(newValue);
    
    // Re Calculate Cart
    calucalteSelectedValue();
    
    if(newValue == 0){
        convertToUnselectedState(item); 
    }
    
   
    cartValue = $("#price").html();
    if(parseInt(cartValue) == 0){
        
        $( "#add-to-cart" ).fadeOut();
 
    }
    
}


function convertToSelectedState(item){
    

    $(item).find(".initialState").hide();
    $(item).find(".selectedState").show();
    
    
    cartValue = $("#price").html();
    
    if(parseInt(cartValue) >= 1){
    
        $( "#add-to-cart" ).fadeIn();
 
    }
      

}




 function convertToUnselectedState(item){
    $(item).find(".initialState").show();
    $(item).find(".selectedState").hide();
    
       
     
     
 }



function pageScrolling(){
   // How far it has scrolled from top
        
        windowScoll = $(window).scrollTop();
        
        // Height of Product Wrapper 
        productWrapperHeight = $("#product-details-wrapper").outerHeight()
        
        windowHeight = $(window).height();
        
         headerHeight = $("header").height();
        
        test = windowHeight + windowScoll;
        test = test - headerHeight;
     
        // ********************************
        if($("body").width() >= 992){
    
        if(productWrapperHeight <= test){
                
                totalScroll = productWrapperHeight + headerHeight;
                requiredScroll = windowHeight - headerHeight;

                headerTop = totalScroll - requiredScroll;



                // Set the Fixed Heights to absolut
                $("#product-shot-wrapper").css("position","absolute");
                $("#product-shot-controls").css("position","absolute");

                $("#add-to-cart").css("position","absolute");
                $("#add-to-cart").removeClass("col-md-4");
                $("#add-to-cart").addClass("add-to-cart-full-width");

                $("#product-shot-wrapper").css("top",headerTop+"px");
                $("#product-shot-wrapper").css("left","0px");



            }else{

                $("#product-shot-wrapper").css("position","fixed");
                $("#product-shot-wrapper").css("top",headerHeight+"px");
                $("#product-shot-wrapper").css("left","0px");
                $("#product-shot-controls").css("position","fixed");

                $("#add-to-cart").css("position","fixed");
                $("#add-to-cart").addClass("col-md-4");
                $("#add-to-cart").removeClass("col-md-12");
                $("#add-to-cart").removeClass("add-to-cart-full-width");

            }
        }else{
                $("#product-shot-wrapper").css("position","relative");
                $("#product-shot-wrapper").css("top","0px");
                $("#product-shot-wrapper").css("left","0px");
            
                $("#product-shot-controls").css("position","absolute");

                $("#add-to-cart").css("position","fixed");
                $("#add-to-cart").removeClass("col-md-4");
                $("#add-to-cart").addClass("add-to-cart-full-width");

               

        }
        // ***********************    
        
      
           
}



 

    
