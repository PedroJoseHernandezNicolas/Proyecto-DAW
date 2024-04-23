<?php
    $parameters = $_GET;
    $apiUrl = 'http://localhost/DWES/Proyecto/usuario.php';
    $headers = array();
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $headers[] = 'api-key: ' . $token;
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
?>