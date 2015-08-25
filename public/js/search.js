$(document).ready(function(){
    
    
    $("#search-trigger").click(function(){
        
                 submitSearch() ;
    
    });
    
    $(document).keypress(function(e) {
    if(e.which == 13) {
        submitSearch();
    }
    });
    
    
    
});

function submitSearch(){
 
    var searchPhrase = $("#search-value").val();
    window.location = "catalogue.php?search="+searchPhrase;  
    
}