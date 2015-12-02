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
        "Base", 
        "Weight", 
        "Size Category", 
        "Size", 
        "Color", 
        "Price",
        "Reseller Price",
        "InStock",
        "Description"
    ];

    $columns = [
        "id" => "auto",
        "base" => "text",
        "weight" => "text",
        "sizeCategory" => "text",
        "size" => "text",
        "color" => "text",
        "surcharge" => "text",
        "resellerRate" => "text",
        "inStock" => "toggle",
        "description" => "text"
    ];

    // Table being queried 
    $table = "stockCustom";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


 

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

