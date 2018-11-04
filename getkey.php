<?php

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://omsweb.public-safety-cloud.com/jtclientweb/(S())/jailtracker/index/'
));
$resp = curl_exec($curl);
curl_close($curl);
preg_match('/(S(?:(.*)))/', $resp, $m);
print_r($m);
$key =  substr($m[0], 2, 24); 
echo $key; exit;
echo strlen($key);

