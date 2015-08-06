<h3>Payment method</h3>
All transactions are secure and encrypted. Credit card information is never stored.

<br><br>

<form id="checkout" method="post" action="receipt.php">
  <div id="payment-form"></div>
  <input type="submit" value="Pay $10">
</form>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<script>
// We generated a client token for you so you can test out this code
// immediately. In a production-ready integration, you will need to
// generate a client token on your server (see section below).
var clientToken = "<? echo createClientToken(); ?>";

braintree.setup(clientToken, "dropin", {
  container: "payment-form"
});
    
</script>