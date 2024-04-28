<?php
    function conecta() {
        $cs = mysqli_connect("localhost","root","");
        $cbd = mysqli_select_db($cs,"database");
        return $cs;
    }

    function conectaAPI($api_url) {
    // Realizar la solicitud a la API
        // Acoplarlo a la estructura que podemos construir para hacer las solicitudes
    $response = file_get_contents($api_url);
    // Decodificar la respuesta JSON
    $data = json_decode($response, true);
    return $data;
    }
?>