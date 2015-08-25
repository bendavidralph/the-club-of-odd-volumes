<?php 
    include '../includes/payment.php';
    $styleSheets = ["checkout"];
    $pageTitle = "Checkout";
    $scripts = ["checkout"];
    include ('php/modules/_header.php');
?>


<main class="container">
  
    <?php 

     if(isset($_SESSION['userID'])){
         
         
         $customer = queryById('customer',$_SESSION['userID']);
         $cartValues = calculateCartValue($customer['shippingRegion']);
         
     }else{
      $cartValues = calculateCartValue();   
        
         $customer["fullName"] = NULL; 
         $customer["email"] = NULL; 
         $customer["phone"] = NULL; 
         $customer["line1"] = NULL; 
         $customer["line2"] = NULL; 
         $customer["city"] = NULL; 
         $customer["state"] = NULL; 
         $customer["zip"] = NULL; 
         $customer["country"] = NULL; 
         $customer["shippingRegion"] = NULL;
         
     }
    
    
    
    

    ?>
    
    <section class="row">
        <h1 class="col-xs-12">Checkout</h1>    
    </section>
    <section class="row">
    <ol class="breadcrumb">
        <li class="active"><a href="checkout">Customer Information</a></li>
        <li><a href="checkout?page=shipping">Shipping Method</a></li>
        <li><a href="checkout?page=payment">Payment Details</a></li>
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
                <div id="subtotal-value"  class="value col-xs-6">$<?php   echo $cartValues['product'] ?></div>
            </section>
                
            <section class="row">
                <div id="shipping-label" class=" col-xs-6">Shipping</div>
                <div id="shipping-value" class="value col-xs-6"><?php   
        
                    if(isset($cartValues['shippingWarning'])){
                        echo $cartValues['shippingWarning']; 
                    }else{
                        echo "$".$cartValues['shipping']; 
                    }
        
                
                ?></div>
            </section>
            
            <hr>
            
            <section class="row">
                <div id="total" class=" col-xs-6">Total</div>
                <div id="total-value" class="value col-xs-6">$<?php   echo $cartValues['product']+$cartValues['shipping'];  ?></div>
            </section>
            
          
            
        
        </div><!-- End of Order Information -->
        
        <div id="form-wrapper" class="col-xs-12 col-md-6 col-md-pull-4">
            
            <?php   

            if(isset($_GET['page'])){
               $loadPage = $_GET['page'];
            }else{  
                $loadPage = "";
            }

            // Test that the users has created a shipping address before continuing 
            if(!isset($_SESSION['userID'])){
                  $loadPage = "";  
            }

            switch ($loadPage){
                case "shipping":
                    
                    include 'php/modules/checkout_shipping-method.php';
                    
                break;
                case "payment":
                    
                    include 'php/modules/checkout_payment-method.php';
                
                break;
                default:
                    
                    include 'php/modules/checkout_customer-information.php'; 
                    
            }
            
            ?>
        </div><!-- end customer-info-wrapper -->
        

        
        
    </section>
    

    
    
    
    
    
    
</main>
  
<?php   include('php/modules/_footer.php'); ?>