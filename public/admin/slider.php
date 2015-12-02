<?php 
    $styleSheets = ["index"];
    $pageTitle = "Site Admin";
    include ('php/modules/_header.php');
?>

<?php 

    // Set Page Variables 
    
    // Create an array with the Column Names
    $columnTitles = ["ID", "Slide Number", "URL", "Open in New Window?"];
    $columns = [
        "id" => "auto",
        "slideNumber" => "text",
        "url" => "text",
        "openNewWindow" => "toggle"
    ];

    // Table being queried 
    $table = "sliderLinks";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";
    

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

