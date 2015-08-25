<?php 

    require_once 'braintree-php/lib/Braintree.php';

    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('snz7kjy9hqxjk2ny');
    Braintree_Configuration::publicKey('fkvhnx9rd9yhky9h');
    Braintree_Configuration::privateKey('b2db8c5a60a8d6084341623e329cbb7a');

    function createClientToken(){
     
        $clientToken = Braintree_ClientToken::generate();
        return $clientToken;
        
    }

    function executePayment($nonce,$amount){
    
        
        $result = Braintree_Transaction::sale([
          'amount' => $amount,
          'paymentMethodNonce' => $nonce
        ]);
        
        
        

        
        return $result;
        
    }


    function saveTransaction($id){

        // Update Order Status to = confirmed 
        $updateValues['orderStatus'] = 'confirmed';
        update_DB('customerOrder',$updateValues,$id);
        
        
    }

    function sendRedeiptEmail($id){
     
        // Send Receipt Emails to Sarah and Customer 
        
    }



 

    function handleFailure($result){
        
    // reprot the issue to the user   
    // There has been an error please contact shop@theclubofoddvolumes.com
        
    echo $result->_attributes["transaction"]->_attributes["status"];
    
    // Response Code 
    echo $result->_attributes["transaction"]->_attributes["processorResponseCode"];
    
    // Message 
    echo $result->_attributes["transaction"]->_attributes["processorResponseText"];
        
     
        // Log Errors 
        
        // Email ADMIN
        
        
    }
    
   



?>