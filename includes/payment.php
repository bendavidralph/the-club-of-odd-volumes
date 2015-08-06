<?

    require_once 'braintree-php/lib/Braintree.php';

    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('snz7kjy9hqxjk2ny');
    Braintree_Configuration::publicKey('fkvhnx9rd9yhky9h');
    Braintree_Configuration::privateKey('b2db8c5a60a8d6084341623e329cbb7a');

    function createClientToken(){
     
        $clientToken = Braintree_ClientToken::generate();
        return $clientToken;
        
    }

    function executePayment($nonce){
    
        
        $result = Braintree_Transaction::sale([
          'amount' => '100.00',
          'paymentMethodNonce' => $nonce
        ]);
        
        return $result;
        
    }
 

?>