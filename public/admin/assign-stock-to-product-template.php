
<?php 
    $styleSheets = ["index"];
    $pageTitle = "Site Admin";
    include ('php/modules/_header.php');
?>

<?php 

    // Set Page Variables 
    
    // Create an array with the Column Names
    $columnTitles = [
        "id", 
        "Template", 
        "Stock Item"
    ];

    $columns = [
        "id" => "auto",
        "template_id" => "select",
        "stock_id" => "select"
    ];

    // Table being queried 
    $table = "templateStockIndex";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";

    // get all product templates 
    $list['template_id'] = queryDBIndexByID("label","productTemplate");
    $list['stock_id'] = queryDBIndexByID("base","stock");
 

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

