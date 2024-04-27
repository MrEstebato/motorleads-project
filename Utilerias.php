<?php
    function conectaAPI() {
    // URL de la API a la que nos conectamos
    $api_url = "https://https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1";

    // Realizar la solicitud a la API
        // Acoplarlo a la estructura que podemos construir para hacer las solicitudes
    $response = file_get_contents($api_url);

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);
    return $data;
    }

    function mensaje($msg) {
        echo "
        <script>
            alert('$msg')
        </script>
        ";
    }
?>