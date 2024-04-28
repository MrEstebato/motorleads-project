<!DOCTYPE html>
    <html>
        <head>
            <title>
                MotorLeads
            </title>
            <link href="estilos.css" rel="stylesheet" type="text/css">
            <script src="grafica.js" type="text/JavaScript"></script>
            <meta charset="utf-8">
        </head>
        <body bgcolor="white">
            <div class="container">
                    <!-- encabezado de la pagina -->
                <header>
                    <button  class="button_menu">
                        <img src="pagina_principal.png" alt="Página Principal">
                    </button>
                    <button class="button_menu" id="boton_usuario">
                        <table>
                            <tr>
                                <td>
                                    <img src="usuario.png" alt="Usuario" width="50px" height="auto" style="margin-right: 2px;">
                                </td>
                                <td style="color: white;">
                                    Nombre del Usuario
                                </td>
                            </tr>
                        </table>
                    </button>
                </header>
                <main>
                    <div class="left-panel">
                        <h2>Despliegue de gráfica y especificaciones</h2>
                        <?php
                            include 'Utilerias.php';

                            // esto es correcto?
                            $url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                            $url = $url_base . $_SERVER['QUERY_STRING'];
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // decodificar la informacion dentro de la url
                                $datos = json_decode(file_get_contents($url));
                                if ($datos != NULL) {
                                    // validar la presencia de los datos recibidos
                                    if (isset($datos->makes) && isset($datos->models) && isset($datos->years) && isset($datos->vehicles) && isset($datos->pricings)) {
                                        // Los datos esperados están presentes
                                        $make = $datos->makes;
                                        $model = $datos->models;
                                        $year = $datos->years;
                                        $version = $datos->vehicles;
                                        $price = $datos->pricings;
                                    } else {
                                        http_response_code(405);
                                        echo "Faltan datos necesarios";
                                    }
                                }
                            }

                            // implementar funcion para recibir datos desde API y decodificarlos
                                    // esta funcion esta en Utilerias.php
                            $datos = conectaAPI($url);
                            // visualizar datos recibidos
                            echo $datos;
                            // pasar datos a JS recibiendolos desde window.onload
                                        // en grafica.js
                            echo "<script>var datosAPI = ".json_encode($datos).";</script>";

                            //formulario
                                // desplegar botones que modifican la grafica
                                    // desplegar la grafica
                                        // de manera predeterminada se grafica historico de 3 meses
                            function formulario($action) {
                                echo"
                                <table name='actions'>
                                    <tr>
                                        <td><button class='button' id='action' onclick='actBuild('3M')'>3M</button></td>
                                        <td><button class='button' id='action' onclick='actBuild('6M')'>6M</button></td>
                                        <td><button class='button' id='action' onclick='actBuild('1A')'>1A</button></td>
                                        <td><button class='button' id='action' onclick='actBuild('2A')'>2A</button></td>
                                    </tr>
                                </table>
                                <canvas id='grafica'></canvas>
                                    ";
                            }
                        ?>
                    </div>
                            <!-- Comienza el segundo panel de la pantalla -->
                    <div class="right-panel">
                        <div align="center">
                            <button class="button">+ Cotizar nuevo auto</button>
                        </div>
                        <!-- Aquí iría la información extra -->
                        <h2 id="h2_secundario">Especificaciones del auto</h2>
                    </div>
                </main>
            </div>
        </body>
    </html>