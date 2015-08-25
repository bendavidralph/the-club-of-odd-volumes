$(document).ready(function(){
    

    $(window).resize(function(){
        setHeroSliderHight();
    });
    
    setHeroSliderHight();
    
    setInterval(function(){animateHeroSlider()}, 8000);
    
    
    
    
}); // End Document Ready 



// ############################# ANIMATE HEADING #############################

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
     if(nextSlide == 4){
        nextSlide = 1;  
     }
    
   console.log(slideCount);
    
    $(".slide"+slideCount).removeClass("scale100");
    $(".slide"+slideCount).addClass("scale200");
    

    $(".slide"+nextSlide).addClass("scale100");
    
 
    // increment  slide number 
    slideCount++;
    
    // test for end and reset 
    if(slideCount == 4){
        slideCount =1;
    }
    

}

