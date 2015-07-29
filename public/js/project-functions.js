$(document).ready(function(){
 
    $("#cart-trigger").click(function(){showCart();}); 
    $("#fadeout").click(function(){hideCart();});
    
    $(".hamburger").click(function(){toggleMobileCategories();});
  
    
    adjustMainTag();
    
    $(window).resize(function(){
        
        adjustMainTag();
        
    });
    
});

function showCart(){
 
    $("#fadeout").fadeIn();
    $("#cart-wrapper").fadeIn();
    $("#cart-close-trigger").fadeIn();
    $("#cart-close-trigger").click(function(){hideCart();}); 
    
}

function hideCart(){
 
    $("#fadeout").fadeOut();
    $("#cart-wrapper").fadeOut();
    $("#cart-close-trigger").fadeOut();
    
}


function toggleMobileCategories(){
    
    $("nav ul").slideToggle();
}

function adjustMainTag(){
    
    heightOfHeader = $("header").height();
    $("main").css('padding-top',heightOfHeader+'px');
    
}