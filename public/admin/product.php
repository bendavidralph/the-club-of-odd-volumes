<?php 
    $styleSheets = ["index"];
    $pageTitle = "Site Admin";
    include ('php/modules/_header.php');
?>

<?php 

    // Set Page Variables 
    
    // Create an array with the Column Names
    $columnTitles = [
        "ID", 
        "Product Name", 
        "Product Template", 
        "Artist", 
        "Design", 
        "New Flag", 
        "Visible?", 
        "Surcharge", 
        "Display Priority",
        "Tags"];

    $columns = [
        "id" => "auto",
        "productName" => "text",
        "productTemplate_id" => "select",
        "artist_id" => "select",
        "design_id" => "select",
        "newFlag" => "toggle",
        "visible" => "toggle",
        "surcharge" => "text",
        "displayPriority" => "text",
        "tags" => "text"
    ];

    // Table being queried 
    $table = "product";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


     // get all product templates 
    $list['productTemplate_id'] = queryDBIndexByID("label","productTemplate");
    
    // get all artist 
    $list['artist_id'] = queryDBIndexByID("artistName","artist");
  
    // get all designs 
    $list['design_id'] = queryDBIndexByID("label","design");
    

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

