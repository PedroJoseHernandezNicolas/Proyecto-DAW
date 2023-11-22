<?php
        $params_json = file_get_contents('php://input');
        $curl = curl_init();
        $apiUrl = 'http://localhost/DWES/Proyecto/login.php';
    
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params_json);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;  
?>
