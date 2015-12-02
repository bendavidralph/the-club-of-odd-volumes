<?php
    
    $styleSheets = ["cms"];
    $pageTitle = "Reseller Login";
    include ('php/modules/_header.php');
 
?>


<main class="container">
    
    <?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 'reseller'){
         echo "<br><br><p class='center'>You are already logged in!</p>";
    }
    ?>
        
    <section class="row" >
  
        <h1>Welcome</h1>
        <p class="center">Please login using the form bellow</p>
        
        <form class="col-sm-6 col-sm-push-3">
            
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" name="email" id="email-input" placeholder="Email">
          </div>        

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="password-input" placeholder="Password">
        </div>
        
        
        <button type="submit" class="btn btn-default">Submit</button>
    
            <div id="result"></div>
            
        </form>
        
    
        <div id="login-message" class="static-message error">
            Sorry, your username or password did not match. Please try again. 
        </div>
            
        
    </section>
        
</main>

<?php   $scripts = ["validate-login"]; ?>
<?php   include('php/modules/_footer.php'); ?>