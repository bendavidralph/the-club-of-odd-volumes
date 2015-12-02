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
        "Template ID", 
        "Stock ID"];

    $columns = [
        "id" => "auto",
        "template_id" => "text",
        "stock_id" => "text"
    ];

    // Table being queried 
    $table = "templateStockIndex";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


  
?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

