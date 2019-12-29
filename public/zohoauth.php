<?php
$fields = array(
            'scope' => 'ZohoCRM.users.ALL,ZohoCRM.org.ALL',
            'redirect_uri' => "https://lara55.stridecdev.com/zohoaccounts",
            'client_id' => urlencode('1000.VK4G8ZAYSG0FLOJIO5EJU7TTTOVFBV'),
			'response_type' => "code",
			'access_type' => "offline"
        );
$fields_string = http_build_query($fields);

//echo $fields_string; exit;

$url = "https://accounts.zoho.in/oauth/v2/token";
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);
print_r($result);

//close connection
curl_close($ch);


//https://accounts.zoho.in/oauth/v2/auth?scope=ZohoCRM.users.ALL&client_id=1000.VK4G8ZAYSG0FLOJIO5EJU7TTTOVFBV&response_type=code&access_type=offline&redirect_uri=https://lara55.stridecdev.com/zohoaccounts

//https://lara55.stridecdev.com/zohoaccounts?code=1000.2d25459c29ff01d1c861c5eac4210e7c.e9245daf9d2b6ebe06beaddae65bb809&location=in&accounts-server=https%3A%2F%2Faccounts.zoho.in



?>