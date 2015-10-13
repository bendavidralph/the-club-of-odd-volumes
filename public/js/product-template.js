$(document).ready(function(){
    
    //setCSSbyViewport();
    pageScrolling();
    
    $(window).scroll(function(){
       
      pageScrolling();
        
    });
    // END OF TEST

    $( window ).resize(function(){
      
     //   setCSSbyViewport();
        
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

function selectColour(colour){
    
    // Hide Non Selected Colours 
    $(".stock-selector ul li").removeClass("includeInCount");
    $("#color-selector ul li").removeClass("active");
    
     // Focus Colour Selections    
    $(".stock-"+colour).addClass("includeInCount");
    $("#"+colour+"-trigger").addClass("active");
    
    // Re Calculate Price
    calucalteSelectedValue();
    
    
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
    
   
    
    $.post( "php/POST/add-to-cart",{"data":data}, function( data ) {
            
        location.reload();
     //   $("#results").html(data);
        
        
    });
    
   
    
    
};

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
        
      
      if(runningValue < 1){
       $( "#add-to-cart" ).hide();
    }else{
            $( "#add-to-cart" ).fadeIn();
    }
        
        
    });
    
}
