$(document).ready(function(){
 
    $("#cart-trigger").click(function(){showCart();}); 
    $("#fadeout").click(function(){hideCart();});
    
    $(".hamburger").click(function(){toggleMobileCategories();});
  
    
    adjustMainTag();
    
    $(window).resize(function(){
        
        adjustMainTag();
        setHeroSliderHight();
    });
    
    setHeroSliderHight();
    
    setInterval(function(){animateHeroSlider()}, 8000);
    
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



// INDEX NEEDS TO BE MOVED IN TO OWN FILE 

function setHeroSliderHight(){
 
    // Hight of view port 
    var windowHeight = $( window ).height();
    // Hight of header 
    var headerHeight = $("header").height();
    var searchHeight = $("#search-wrapper").height();
    
    // minus height of search 
    heroSliderHeight = windowHeight - headerHeight;
    heroSliderHeight = heroSliderHeight - searchHeight;
    
    $("#hero-slider").height(heroSliderHeight);
    
}

slideCount = 1;
function animateHeroSlider(){
    
    // NEXT SLIDE
    nextSlide = slideCount+1;
    // test for end and reset
     if(nextSlide == 5){
        nextSlide = 1;  
     }
    
   console.log(slideCount);
    
    $(".slide"+slideCount).removeClass("scale100");
    $(".slide"+slideCount).addClass("scale200");
    

    $(".slide"+nextSlide).addClass("scale100");
    
 
    // increment  slide number 
    slideCount++;
    
    // test for end and reset 
    if(slideCount == 5){
        slideCount =1;
    }
    

}

