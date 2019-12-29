<?php


$fields = array(
            'code' => urlencode('1000.873b339a81db258e9f9b1aec6b17e594.b8d1932d9fea40557c343ecc5ce14e42'),
            'redirect_uri' => "https://lara55.stridecdev.com/zohoaccounts",
            'client_id' => urlencode('1000.VK4G8ZAYSG0FLOJIO5EJU7TTTOVFBV'),
			'client_secret' => urlencode('5ed7c9ceb72be39d38d86afd19d450665a12af44b7'),
			'grant_type' => urlencode('authorization_code'),
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


?>