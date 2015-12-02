<?php 
    $styleSheets = ["cms"];
    $pageTitle = "Home";
    include ('php/modules/_header.php');
?>


<main>
        
    <h1 class="center">Whoops seems like there was a problem processing your card</h1>
    <h2 class="center">
    <?php

    if($_GET['text'] == ""){
        echo "Please note that we only accept VISA, MASTER CARD and Paypal.";
    }else{
        echo $_GET['text'];
    }
        ?>
    </h2>
    
    <p class="center">Please contact your bank if the issue persists. </p>
    
    
    <?php

    if($_GET['status'] != ''){
        echo '<p class="center">Error Reference: ';
        echo $_GET['status']; 
        echo '</p>';
    }
        ?>
    
    <p class="center"><a href="" onclick="goBack()">Try again</a></p>
    
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>