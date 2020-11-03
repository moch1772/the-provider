<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header ('WWW-Authenticate: Basic realm=\"Private Area\"');
        header ("HTTP/1.0 401 Unauthiruzed");
        print "Sorry, you need proper credentials";
        exit;

    } else {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "http://sko.te4-ntig.se/verify/verify.php?user=".$_SERVER['PHP_AUTH_USER']."&password=".$_SERVER['PHP_AUTH_PW']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);

        curl_close($curl);

        $output = (json_decode($output, true));
        
        echo $output['hash'];
    }
?>