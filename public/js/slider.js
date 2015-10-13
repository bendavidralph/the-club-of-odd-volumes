$(document).ready(function(){
    
  
    
  
    setInterval(function(){animateHeroSlider()}, 8000);
    
    
    
    
}); // End Document Ready 



// ############################# ANIMATE HEADING #############################


slideCount = 1;
totalSlides = 3;
function animateHeroSlider(){
    
    
    
    currentSlide = slideCount;
    
    if(currentSlide == totalSlides){
        nextSlide = 1;
    }else{
        nextSlide = slideCount +1;
    }
    
    // If next slide is loaded then animate 
   

        $("#slide-"+currentSlide).hide();
        $("#slide-"+nextSlide).show();

        slideCount = nextSlide;



    
    
}

