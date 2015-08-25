$(document).ready(function(){
    
    
  
 
    
    $(window).scroll(function(){
       
        // How far it has scrolled from top
        windowScoll = $(window).scrollTop();
        
        // Height of Product Wrapper 
        productWrapperHeight = $("#product-details-wrapper").outerHeight()
        
        windowHeight = $(window).height();
        
         headerHeight = $("header").height();
        
        console.log("Window Scroll "+ windowScoll );
        console.log("Product Wrapper "+ productWrapperHeight );
        console.log("Window Height  "+ windowHeight);
        console.log("HeaderHeight  "+ headerHeight);
        
        test = windowHeight + windowScoll;
        test = test - headerHeight;
        
        if(productWrapperHeight <= test){
       
            totalScroll = productWrapperHeight + headerHeight;
            requiredScroll = windowHeight - headerHeight;
            
            headerTop = totalScroll - requiredScroll;
          
            console.log(headerTop);
            
            // Set the Fixed Heights to absolut
            $("#product-shot-wrapper").css("position","absolute");
            
            $("#product-shot-controls").css("position","absolute");
            
            $("#add-to-cart").css("position","absolute");
            $("#add-to-cart").removeClass("col-md-4");
            $("#add-to-cart").addClass("col-md-12");
            
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
            
            
        }
        
      
        
        
    });
    // END OF TEST
    
    
   
    setCSSbyViewport();
    
    $( window ).resize(function(){
      
        setCSSbyViewport();
        
    });
    
    
    $("#next").click(function(){
       
    
        
    });
    
    
    // Find the first colour and select it
    colourSelect = $("#color-selector ul").find(":first-child").attr("class");
    selectColour(colourSelect);
    
    
    
    $("#color-selector ul li").click(function(){
      
        colour = $(this).attr("class");
        
        selectColour(colour);
        
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

        addToCart();
        
    });
    
    
});


function setCSSbyViewport(){
    
//    headerHeight = $("header").height();
//    wrapperHeight = $( window ).height() - headerHeight;
    
    headerHeight = $("header").height();
    windowHeight = $(window).height();
    
    wrapperHeight = windowHeight - headerHeight;

    
    $("#product-shot-wrapper").css("top",headerHeight+"px");
    $("#product-shot-wrapper").css("height",wrapperHeight+"px");
    
    // Set the Product Details to have a min height 
    
     $("#product-details-wrapper").css("min-height",wrapperHeight+"px");
    
    imageWidth = $("#product-shots ul li").outerWidth(true);

    // Count the amount of child elemenets 
    count = $("#product-shots ul li").length;

    imageWidth = imageWidth + 40;
    productShotsWidth = imageWidth * count;
    

    // set  product-shots to the width of containing images
    $("#product-shots").width(productShotsWidth);
    
    
    
 
}

function selectColour(colour){
    
    // Hide Non Selected Colours 
    $(".stock-selector ul li").removeClass("includeInCount");
    $("#color-selector ul li").removeClass("active");
    
     // Focus Colour Selections    
    $(".stock-"+colour).addClass("includeInCount");
    $("#"+colour+"-trigger").addClass("active");
    
    // Re Calculate Price
    calucalteSelectedValue()
    
    
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

function calucalteSelectedValue(){
    
    runningValue = 0;
    
    $("#stock-form").find(".includeInCount").each(function(){
       
        quantity = $(this).find("input[name='trackStockQuant']").val();
        price = $(this).find("input[name='stockPrice']").val();
        
        if(quantity >= 1){
            subtotal = quantity * price;
            runningValue = runningValue + subtotal;
            
        }
        
       $("#price").html(runningValue);
        
        
    });
    
}


 function convertToUnselectedState(item){
    $(item).find(".initialState").show();
    $(item).find(".selectedState").hide();
    
       
     
     
 }


function addToCart(){
    
    // Get all Stock Stock Ids
    
    data = [];
    product_id = $("input[name='product_id']").val();
    
    $("#stock-form").find(".includeInCount").each(function(){
        
        id = $(this).attr("id");
        quantity = $(this).find("input[name='trackStockQuant']").val();
        
        if(quantity >= 1){
         data.push([product_id,id,quantity]);
                
        }

     });
    
    $.post( "php/POST/add-to-cart",{data}, function( data ) {
            
        location.reload();
        
        
    });
    
   
    
    
};

