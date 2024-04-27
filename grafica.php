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
                        <!-- Aquí iría la gráfica histórica y las especificaciones del auto con ayuda de PHP -->
                        
                        <!-- 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // collect value of input field
                                $name = $_POST['fname'];
                                $response =
                                file_get_contents('https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/makes');
                                if (empty($name)) {
                                echo "Name is empty";
                                } else {
                                echo $name;
                                echo $response;
                                }
                                }
                        -->
                        
                        <?php
                            echo"<canvas id='grafica'></canvas>";

                            include 'Utilerias.php';

                            $url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                            $url = $url . $_SERVER['QUERY_STRING'];
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                            function obtenerDatos() {

                            }
                        ?>
                    </div>
                    <div class="right-panel">
                        <div align="center">
                            <button class="button">+ Cotizar nuevo auto</button>
                        </div>
                        <!-- Aquí iría la información extra -->
                        <h2>Especificaciones del auto</h2>
                    </div>
                </main>
            </div>
        </body>
    </html>