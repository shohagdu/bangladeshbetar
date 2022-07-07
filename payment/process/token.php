<?php
    session_start();
    
	$request_token=bkash_Get_Token();
	//print_r($request_token);
	$idtoken=$request_token['id_token'];
	
	$_SESSION['token']=$idtoken;
	
	echo $idtoken;
	

	function bkash_Get_Token(){
	$post_token=array(
	       'app_key'=>'hpjmrvgn7oadn4jneb9mehlv',
		   'app_secret'=>'1ro4ekbbfqtjiksevf97pk2opblhi3unieogc01o0ckpsh0csf9a'
	);	
		$url=curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant');
	

		$posttoken=json_encode($post_token);
		//print_r($post_tokenx); die();
		$header=array(
		        'Content-Type:application/json',
				'password:u9!v3rSitydH@k@51C',
				'username:DHAKAUNIVERSITY');				
				//print_r($header); 
				curl_setopt($url,CURLOPT_HTTPHEADER, $header);
				curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
				curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
				$resultdata=curl_exec($url);
				curl_close($url);
				//print_r($resultdata);
				return json_decode($resultdata, true);
				//error_log()
	}




?>