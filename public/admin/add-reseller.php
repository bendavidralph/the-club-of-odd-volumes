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
        "Username", 
        "Password"];

    $columns = [
        "id" => "auto",
        "username" => "text",
        "password" => "text"
    ];

    // Table being queried 
    $table = "reseller";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


  
?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

