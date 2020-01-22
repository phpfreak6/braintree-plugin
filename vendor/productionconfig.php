<?php
if(get_option('braintree_payment_mode') == 'sandbox'){
	
$merchat_key = get_option('sandbox_merchant_key');	
$public_key = get_option('sandbox_public_key');
$private_key = get_option('sandbox_private_key');
		
}else{
	
$merchat_key = get_option('live_merchant_key');	
$public_key = get_option('live_public_key');
$private_key = get_option('live_private_key');	
	
}
Braintree_Configuration::environment(get_option('braintree_payment_mode'));
Braintree_Configuration::merchantId($merchat_key);
Braintree_Configuration::publicKey($public_key);
Braintree_Configuration::privateKey($private_key);
?>
