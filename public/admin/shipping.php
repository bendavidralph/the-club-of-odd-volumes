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
        "Min Weight", 
        "Max Weight", 
        "Australia Normal", 
        "Australia Express", 
        "New Zealand", 
        "US?", 
        "Europe", 
        "Rest of the Wolrd"];

    $columns = [
        "id" => "auto",
        "minWeight" => "text",
        "maxWeight" => "text",
        "australia" => "text",
        "ausExpress" => "text",
        "newZealand" => "text",
        "us" => "text",
        "europe" => "text",
        "restOfTheWorld" => "text"
    ];

    // Table being queried 
    $table = "shippingPrice";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


   
?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

