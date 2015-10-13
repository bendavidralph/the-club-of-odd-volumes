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
                    "Label", 
                    "Category",
                    "Base Price",
                    "Description",
                    "Visable",
                    "Addon"];
    $columns = [
        "id" => "auto",
        "label" => "text",
        "category_id" => "select",
        "basePrice" => "text",
        "description" => "text",
        "visable" => "toggle",
        "addon" => "toggle"
    ];

    

    // Table being queried 
    $table = "productTemplate";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";

     // get all product templates 
    $list['category_id'] = queryDBIndexByID("label","categories");
    

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

