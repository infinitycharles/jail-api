<?php
// error_reporting(E_ERROR | E_PARSE);

require("class.php");
$getRecord = NEW getArrest;
$apiKey = NEW getKey;

$ch = curl_init();
#$key = $apiKey->returnKey();
echo "First Key: ".$key."\n\n";
$key = "11pxaf1tik54woqqkngxru1r";
// echo "Working Key: ".$key."\n\n";
$URL = "https://omsweb.public-safety-cloud.com/jtclientweb/(S($key))//(S($key))/JailTracker/GetInmates?_dc=1541056454067&start=0&limit=28&sort=LastName&dir=ASC";
echo $URL; exit;
curl_setopt($ch, CURLOPT_URL, "$URL");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = "Accept-Encoding: gzip, deflate, br";
$headers[] = "Accept-Language: en-US,en;q=0.9";
$headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";
$headers[] = "Accept: */*";
$headers[] = "Referer: https://omsweb.public-safety-cloud.com/jtclientweb/(S($key))/jailtracker/index/";
$headers[] = "X-Requested-With: XMLHttpRequest";
$headers[] = "Connection: keep-alive";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$result = json_decode($result);
foreach($result AS $data => $jail){
    $count = count($jail);
    for($x = 0; $x < $count; $x++){
        $fullName = $jail[$x]->FirstName." ".$jail[$x]->LastName;
        $bookDate = $jail[$x]->OriginalBookDateTime;
        echo "\n $fullName ";
        $arrestNum = $jail[$x]->ArrestNo;
        $getRecord->getCharges($key, $arrestNum);
    }
    
}


