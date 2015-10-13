<?php 
    $styleSheets = ["cms"];
    $pageTitle = "Home";
    include ('php/modules/_header.php');
?>


<main>
        
    <h1 class="center">Whoops seems like there was a problem processing your card</h1>
    <h2 class="center">
    <?php
    echo $_GET['text'];
    ?>
    </h2>
    
    <p class="center">Please contact your bank if the issue persists. </p>
    
    <p class="center">Error Reference: <?php echo $_GET['status']; ?></p>
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>