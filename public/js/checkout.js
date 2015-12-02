$(document).ready(function(){
  
    $("#apply-btn").click(function(){
       
        discountCode = $("#discount-code").val();
        discountCode = $.trim(discountCode);
        
        if(discountCode != ''){
        processDiscount(discountCode); 
        }else{
            alert("Please enter a discount code");   
        }
        
    });
    
    $("#ZeroDollarCheckout").click(function(){
       window.location = "php/POST/proccessPayment";
        
    })
    
    
    $("form").submit(function( event ) {
    
       
        // Validate that a country has been selected
        
        event.preventDefault();

        // Test Country has been selected
        selectedShippingMethod = $("select[name*='shippingRegion']").val();
          
        if(!selectedShippingMethod){
               $("#shippingRegion-error").addClass("has-error");
        }else{
        
                 
        // Test for all mandatory fields  
        validate = validateMandatoryFields(); 
       
         if(validate == 'success'){
         $("#mandatory-field-message").removeClass("slide-in");   
            // Get the valuse of every element in the form
            var fields = $(this).serialize();

            $.post("php/POST/update-customer-info",fields, function( data ) {    
                window.location = "checkout?page=shipping";
            });
         
        }else{
         
             $("#mandatory-field-message").addClass("slide-in");
            
        }
     
   
        }});
    
    $("select[name*='shippingRegion']").change(function(){
       
        countrySelection = $(this).val();
        updateShipping(countrySelection);
        updateCountryField(countrySelection);
        
       
        
    });
    
     $("input[name*='shippingMethod']").change(function(){
       
        countrySelection = $(this).val();
        updateShipping(countrySelection);
        updateCountryField(countrySelection);
        
        // Update Databse 
         $.post("php/POST/update-customer-info",{shippingRegion:countrySelection}, function( data ) {    
               
        });
        
    });
    



});

function validateMandatoryFields(){
    
    validate = 'success';
    
    $(".validate").each(function(){
        
        field  = $(this).val();
        field = field.replace(/ /g,'');
        if(field == ''){
            //stop form submit
            validate = 'fail';
            
            $(this).closest(".form-group").addClass("has-error");
            
        }else{
            $(this).closest(".form-group").removeClass("has-error");
        }
        
        
        
      
    });
    
    return validate;
    
    
    
    
}


function updateShipping(countrySelection){
 
      $.post("php/POST/return-shipping",{country:countrySelection},function(data){
            
           $("#shipping-value").html("$"+parseInt(data)); 
            
            // Add Shipping to Total 
        
           total = $("#subtotal-value").html(); 
           total = total.replace(/\$/g, '');

           total = parseInt(total) + parseInt(data);
          
            $("#total-value").html("$"+total); 
            
            
        });
    
}


function updateCountryField(countrySelection){
   
    // Add Country Label (Hidden or Visible)
        switch(countrySelection) {
            case "australia":
                $("input[name='country']").val("Australia");
                $(".country-label").hide();
                $("input[name='country']").attr("type","hidden");
                break;
            case "newZealand":
                 $("input[name='country']").val("New Zealand");
                 $(".country-label").hide();
                 $("input[name='country']").attr("type","hidden");
                
                break;
            case "us":
                $("input[name='country']").val("United States");
                $(".country-label").hide();
                $("input[name='country']").attr("type","hidden");
                break;
            default:
                $("input[name='country']").val("");
                $(".country-label").show();
                $("input[name='country']").attr("type","text");
                
        }
}


function processDiscount(discountCode){
    
    
        $.post("php/POST/apply-discount",{discount:discountCode},function(data){
            
          data = $.trim(data);
            
        if(data == 'success'){
            window.location.replace("checkout");
        }else{
            alert("Sorry this is not a valid discount code");
        }
            
            
        });
    
    
    
    
}
