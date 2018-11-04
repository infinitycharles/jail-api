<?php

class getKey {
    function returnKey(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://omsweb.public-safety-cloud.com/jtclientweb/(S())//(S())/JailTracker/GetInmates?_dc=1541056454067&start=0&limit=28&sort=LastName&dir=ASC'
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        preg_match('/(S(?:(.*)))/', $resp, $m);
        return substr($m[0], 2, 24); 
    }
}


class getArrest {
    function getKey(){

    }
    function getCase($key, $arrestNum){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://omsweb.public-safety-cloud.com/jtclientweb/(S($key))//(S($key))/JailTracker/GetInmate?_dc=1541053042199&arrestNo=$arrestNum");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = "Accept-Encoding: gzip, deflate, br";
    $headers[] = "Accept-Language: en-US,en;q=0.9";
    $headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";
    $headers[] = "Accept: */*";
    $headers[] = "Referer: https://omsweb.public-safety-cloud.com/jtclientweb/(S($key))/jailtracker/index/Carter_County_Ky";
    $headers[] = "X-Requested-With: XMLHttpRequest";
    $headers[] = "Connection: keep-alive";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);


    $result = json_decode($result);
    return $result;


    }
    function getCharges($key, $arrestNum){
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://omsweb.public-safety-cloud.com/jtclientweb/(S($key))//(S($key))/JailTracker/GetCharges");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "arrestNo=$arrestNum");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Origin: https://omsweb.public-safety-cloud.com";
        $headers[] = "Accept-Encoding: gzip, deflate, br";
        $headers[] = "Accept-Language: en-US,en;q=0.9";
        $headers[] = "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = "Accept: */*";
        $headers[] = "Referer: https://omsweb.public-safety-cloud.com/jtclientweb/(S($key))/jailtracker/index/Carter_County_Ky";
        $headers[] = "X-Requested-With: XMLHttpRequest";
        $headers[] = "Connection: keep-alive";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        $result = json_decode($result);
        
        foreach($result as $data => $charge){
            $count = count($charge);
            for($x = 0; $x < $count; $x++){
                echo "Charge: ";
                echo $charge[$x]->ChargeDescription;
                echo "\n";
            }
        }
    }
    
}