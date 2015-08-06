<?
    include '../includes/payment.php';
    $styleSheets = ["receipt"];
    $pageTitle = "Receipt";
    include ('php/modules/_header.php');
?>

<main class="container">

<?

 
        if($_POST["payment_method_nonce"]){
        
            $nonce = $_POST["payment_method_nonce"];
            $result = executePayment($nonce);
            
        }

        echo "You're the best, thanks for shopping!";

        

?>

</main>
  
<? include('php/modules/_footer.php'); ?>