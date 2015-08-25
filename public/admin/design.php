
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
        "label", 
        "artist_id"];

    $columns = [
        "id" => "auto",
        "label" => "text",
        "artist_id" => "select"
    ];

    // Table being queried 
    $table = "design";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";


     // get all product templates 
    $list['artist_id'] = queryDBIndexByID("artistName","artist");
    

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

