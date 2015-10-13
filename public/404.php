<?php  ob_start("ob_gzhandler");?>
<?php  include '../includes/database.php';

    $artist = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

    $query = "SELECT id FROM artist WHERE userName = '" . $artist . "'";
    $results = queryDB($query);
    
    echo $num_rows = mysqli_num_rows($results);

    if($num_rows == 1){
    while($row = mysqli_fetch_assoc($results)){
        
        
       header('Location: /catalogue.php?artist='.$row['id']);
        
    }}else{
        header('Location: /');
        
    }
      
        

    mysqli_free_result($results);

?>