<?
    include '../includes/payment.php';
    $styleSheets = ["checkout"];
    $pageTitle = "Checkout";
    include ('php/modules/_header.php');
?>


<main class="container">
    
    <section class="row">
        <h1 class="col-xs-12">Checkout</h1>
    </section>
    
    <section class="row">
    <ol class="breadcrumb">
      <li class="active"><a href="#">Customer Information</a></li>
      <li>Shipping Method</a></li>
      <li>Payment Details</li>
    </ol>
    </section>
    
    <section class="row">
        
            <div id="order-info-wrapper" class="col-xs-12  col-md-4 col-md-push-8">
       
            <form class="form-inline">
              <div class="form-group">
                <input type="text" class="form-control" id="discount-code" placeholder="Discount Code">
              </div>
              
               <input class="btn btn-default" type="button" value="Apply">
            </form>
            
            <hr>
            
            <section class="row">
                <div id="subtotal-label" class=" col-xs-6">Subtotal</div>
                <div id="subtotal-value"  class="value col-xs-6">$60.00</div>
            </section>
                
            <section class="row">
                <div id="shipping-label" class=" col-xs-6">Shipping</div>
                <div id="shipping-value" class="value col-xs-6">$0.00</div>
            </section>
            
            <hr>
            
            <section class="row">
                <div id="total" class=" col-xs-6">Total</div>
                <div id="total-value" class="value col-xs-6">$0.00</div>
            </section>
            
          
            
        
        </div><!-- End of Order Information -->
        
        <div id="form-wrapper" class="col-xs-12 col-md-6 col-md-pull-4">
            
            <?php 

            include 'php/modules/checkout_customer-information.php';
            
            //include 'php/modules/checkout_shipping-method.php';
            
             //include 'php/modules/checkout_payment-method.php';
            
            ?>
            
            
        </div><!-- end customer-info-wrapper -->
        

        
        
    </section>
    

    
    
    
    
    
    
</main>
  
<? include('php/modules/_footer.php'); ?>