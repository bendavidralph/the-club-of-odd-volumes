$(document).ready(function(){
   

   
     $("form").submit(function( event ) {
    

        event.preventDefault();
        $("#success-message").removeClass("slide-in"); 
         
        // Retrieve the image names from the iframes 
        image1 = $("#image-upload-iframe-1").contents().find("#image-name").val();
        image2 = $("#image-upload-iframe-2").contents().find("#image-name").val();
        image3 = $("#image-upload-iframe-3").contents().find("#image-name").val();

        $("#image-id-1").val(image1);
          $("#image-id-2").val(image2); 
          $("#image-id-3").val(image3); 
         
        // Test for all mandatory fields  
        validate = validateMandatoryFields(); 
       
         
        if($('#copyright').is(':checked')){
           
             $("#copyright-field-message").removeClass("slide-in"); 

            // Get the valuse of every element in the form     
            if(validate == 'success'){
                $("#mandatory-field-message").removeClass("slide-in"); 
                
                var fields = $(this).serialize({ checkboxesAsBools: true });

                $.post("php/POST/form-submit",fields, function( data ) {    
                        $("#success-message").addClass("slide-in"); 
                        $('form')[0].reset();
//                        $("#result").html(data);
                });

            }else{
                $("#mandatory-field-message").addClass("slide-in");   
            }

        }else{
             $("#copyright-field-message").addClass("slide-in"); 
        }

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


  

// Return checkboxes even when not checked
(function($){
    
     $.fn.serialize = function (options) {
         return $.param(this.serializeArray(options));
     };
 
     $.fn.serializeArray = function (options) {
         var o = $.extend({
         checkboxesAsBools: false
     }, options || {});
 
     var rselectTextarea = /select|textarea/i;
     var rinput = /text|hidden|password|search/i;
 
     return this.map(function () {
         return this.elements ? $.makeArray(this.elements) : this;
     })
     .filter(function () {
         return this.name && !this.disabled &&
             (this.checked
             || (o.checkboxesAsBools && this.type === 'checkbox')
             || rselectTextarea.test(this.nodeName)
             || rinput.test(this.type));
         })
         .map(function (i, elem) {
             var val = $(this).val();
             return val == null ?
             null :
             $.isArray(val) ?
             $.map(val, function (val, i) {
                 return { name: elem.name, value: val };
             }) :
             {
                 name: elem.name,
                 value: (o.checkboxesAsBools && this.type === 'checkbox') ? //moar ternaries!
                        (this.checked ? 'true' : 'false') :
                        val
             };
         }).get();
     };
 
})(jQuery);