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
        "Name", 
        "Type (percentage/shipping)",
        "Valid",
        "Value"];

    $columns = [
        "id" => "auto",
        "name" => "text",
        "type" => "text",
        "valid" => "toggle",
        "value" => "text"
    ];

    // Table being queried 
    $table = "discountCodes";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


  
?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

