$(document).ready(function(){
    
    $(".insert").submit(function( event ) {
       
        event.preventDefault();
        
        // Get the valuse of every element in the form
        var fields = $(this).serialize({ checkboxesAsBools: true });
        
        $.post( "php/POST/insert-product?table="+table,fields, function( data ) {    
            location.reload();  
            
//            $("#results").html(data);
            
        });
         
            
    });
    
    $(".delete").click(function() {
        
           
        removeID  = $(this).closest("form");
        removeID = removeID.attr("id");
       
        deleteRow(removeID);
            
    });
    
    
    $(".update").find("input, select").change(function(){
    
       // Get the valuse of every element in the form
        var fields = $(this).closest("form").serialize({ checkboxesAsBools: true });
       
        $.post( "php/POST/update-product?table="+table,fields, function( data ) {          
          
           $("#results").html(data);
            //location.reload();   
        });
        
        // Re-load the page    
    
         event.preventDefault();
    
    
    });
    
    
    
});

function deleteRow(removeID) {
    var r = confirm("Are you sure you want to delete this row?");
    if (r == true) {
     

        $.post( "php/POST/delete-product?table="+table,{id:removeID}, function( data ) {    
             
            //$("#results").html(data);
             location.reload();   
        });
         
    }
}



(function ($) {
 
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