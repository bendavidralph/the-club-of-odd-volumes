$(document).ready(function(){
 
    $("form").submit(function( event ) {
        
         $("#login-message").removeClass("slide-in");

        event.preventDefault();

        var fields = $(this).serialize();

                $.post("php/POST/validate-login",fields, function( data ) {    

                        data  = $.trim(data);
                    
                        if(data == "success"){
                            window.location.replace("index.php?login=success"); 
                        }else{
                            $("#login-message").addClass("slide-in");
                        }
                    
                });
        
        });
    
    
});