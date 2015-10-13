<?php 
    $styleSheets = ["index"];
    $pageTitle = "Site Admin";
    include ('php/modules/_header.php');
?>

<?php 

    // Set Page Variables 
    
    // Create an array with the Column Names
    $columnTitles = ["ID", "Artist Name", "User Name", "Facebook Username", "Instagram Username", "Email Address", "Visible", "Active","location", "Pinned"];
    $columns = [
        "id" => "auto",
        "artistName" => "text",
        "userName" => "text",
        "facebookUsername" => "text",
        "instagramUsername" => "text",
        "email" => "text",
        "visible" => "toggle",
        "active" => "toggle",
        "location" => "text",
        "pinned" => "toggle"
        
    ];

    // Table being queried 
    $table = "artist";
    // Pass Variable to Javascript
    echo "<script>var table='{$table}'</script>";
    

?>


<?php    include('php/modules/_table.php'); ?>
<?php   include('php/modules/_footer.php'); ?>

