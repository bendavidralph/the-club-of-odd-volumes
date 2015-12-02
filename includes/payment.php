<?php 

    require_once 'braintree-php/lib/Braintree.php';

// Sandbox
    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('snz7kjy9hqxjk2ny');
    Braintree_Configuration::publicKey('fkvhnx9rd9yhky9h');
    Braintree_Configuration::privateKey('b2db8c5a60a8d6084341623e329cbb7a');

// Live
//    Braintree_Configuration::environment('production');
//    Braintree_Configuration::merchantId('xw6s2x3hws7htznw');
//    Braintree_Configuration::publicKey('t5y6hzvqpndsqvbj');
//    Braintree_Configuration::privateKey('ceb0ac5f4968300da77a0e98e3915b43');

    function createClientToken(){
     
        $clientToken = Braintree_ClientToken::generate();
        return $clientToken;
        
    }

    function executePayment($nonce,$amount){
    
        
        $result = Braintree_Transaction::sale([
            'amount' => $amount,
//          'merchantAccountId' => 'Pocketful_of_Pixels',
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]    
        ]);
        
        
        return $result;
        
    }


    function saveTransaction($id){

        // Update Order Status to = confirmed 
        $updateValues['orderStatus'] = 'confirmed';
        update_DB('customerOrder',$updateValues,$id);
        
        
    }

 

    function handleFailure($result){
        
    // reprot the issue to the user   
    // There has been an error please contact shop@theclubofoddvolumes.com
        
    $status = $result->_attributes["transaction"]->_attributes["status"];
    $status = urlencode($status);
    
    // Response Code 
    $responseCode = $result->_attributes["transaction"]->_attributes["processorResponseCode"];
    
    // Message 
    $responseText = $result->_attributes["transaction"]->_attributes["processorResponseText"];
    $responseText = urlencode($responseText);    
     
    header("Location: ../../failed-payment.php?status={$status}&text={$responseText}");   
        
        
    }
    
   



?>