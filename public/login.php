<?php
session_start();

if(isset($_GET['password']) && ($_GET['password'] == "s3162404")){
    
    $_SESSION['user'] = "true";
    
}else{

?>


    <script>
    var person = prompt("Please enter your password", "");

    if (person != null) {
        window.location = "login.php?password="+person
    }
        </script>

<?php
}

?>

