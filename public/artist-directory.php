<?php 
    $styleSheets = ["cms"];
    $pageTitle = "Home";
    include ('php/modules/_header.php');
?>


<main class="container">
        

    <h1>CURRENT ARTISTS</h1>
    
    <section class="row" >
        
    <?php
        $count = 4;
        $query = "SELECT * FROM artist WHERE visible = 1 AND active = 1 ORDER BY RAND()";
        $result = queryDB($query);
        
        while($row = mysqli_fetch_assoc($result)){
            
            
        
    ?>
    
        <div id="<?php echo $row["id"]; ?>" class="col-md-3 col-sm-4 artist-wrapper"> 
            <a href="catalogue?artist=<?php echo $row["id"]; ?>"><img src="assets/images/artist/<?php echo $row["id"]; ?>.jpg" class="img-responsive"></a>
            
            <div class="artist-details">
                <h4><a href="catalogue?artist=<?php echo $row["id"]; ?>"><?php echo $row['artistName']; ?></a></h4>
                <h5><?php echo $row['location']; ?></h5>
            
            
                <div class="social-wrapper">

    <?php
            $socialCount = 0;
                
            if($row['email']){ 
                $socialCount++;
                echo "<div class='social mail-icon'><a href='mailto:{$row['email']}' target='_black'><img src='assets/images/icons/email.png'></a></div>";
            }
            
            if($row['instagramUsername']){
                $socialCount++;  
                echo "<div class='social instagram-icon'><a href='https://instagram.com/{$row['instagramUsername']}' target='_black'><img src='assets/images/icons/instagram.png'></a></div>";
            }
            
            if(($row['facebookUsername']) && ($socialCount < 2)){ 
                echo "<div class='social facebook-icon'><a href='https://facebook.com/{$row['facebookUsername']}' target='_black'><img src='assets/images/icons/facebook.png'></a></div>";
            }
    ?>
                </div>

            </div>
            
        </div>
        
<?php
       }

        mysqli_free_result($result);
   
?>         
        
        
        

    
    </section>
    
    <hr>
    
    <h2>PREVIOUS ARTISTS</h2>
    
    
    <section class="row">
        
  <?php
        $count = 4;
        $query = "SELECT * FROM artist WHERE visible = 1 AND active IS NULL ORDER BY artistName ";
        $result = queryDB($query);
        
        while($row = mysqli_fetch_assoc($result)){
            
            
        

?>
        
        <div class="col-xs-4 col-sm-2 artist-wrapper">
        
            <img src="assets/images/artist/<?php echo $row['id']; ?>.jpg" class="img-responsive">
            
            <div class="artist-details previous">
            <?php echo $row['artistName']; ?>
            </div>
            
        
        </div>
        
<?php
    
        }

?>
    

    
    </section>
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>