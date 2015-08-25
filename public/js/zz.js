$(document).ready(function(){
   
    
    
    selectColour("White");
    
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
    
}


function convertToSelectedState(item){
    

    $(item).find(".initialState").hide();
    $(item).find(".selectedState").show();
   

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
        
       $("#price").html("$"+runningValue);
        
        
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

