$(document).ready(function(){
    
    
    $("#search-trigger").click(function(){
        
                 submitSearch();
    
    });
    
    $(document).keypress(function(e) {
    if(e.which == 13) {
        if($("#search-value").is(":focus")){
        submitSearch();
    }
    }
    });
    
    $("#search-value").change(function(){
       
        submitSearch();
        
    });
    
    
    
});

function submitSearch(){
 
    var searchPhrase = $("#search-value").val();
    window.location = "catalogue.php?search="+searchPhrase;  
    
}