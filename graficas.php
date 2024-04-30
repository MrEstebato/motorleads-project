<!DOCTYPE html>
<html>

<head>
    <title>
        MotorLeads
    </title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <script src="Utils.js"></script>
    <meta charset="utf-8">
</head>

<body bgcolor="white">
    <div class="container">
        <header>
            <button class="button_menu">
                <img src="images/pagina_principal.png" alt="Página Principal">
            </button>
            <button class="button_menu" id="boton_usuario">
                <table>
                    <tr>
                        <td>
                            <img src="images/usuario.png" alt="Usuario" width="50px" height="auto" style="margin-right: 2px;">
                        </td>
                        <td style="color: white;">
                            Usuario
                        </td>
                    </tr>
                </table>
            </button>
        </header>
        <main>
            <?php

            //$url_form = $_GET[''];
            //json_decode($url_form);

            $URLAPI = $_GET["enlaceAPI"];
            $kilometraje = $_GET["kilometraje"];
            $anio = $_GET["anio"];
            $datos = file_get_contents($URLAPI);
            $datos = json_decode($datos);
            $make = $datos->make;
            $model = $datos->model;
            $historicos = $datos->historic;

            function getImage($fabricante)
            {
                switch ($fabricante) {
                    case 'toyota':
                        $imagen = 'images/logo_toyota.png';
                        break;
                    case 'chevrolet':
                        $imagen = 'images/logo_chevrolet.png';
                        break;
                    case 'ford':
                        $imagen = 'images/logo_ford.png';
                        break;
                    case 'honda':
                        $imagen = 'images/logo_honda.png';
                        break;
                    case 'hyundai':
                        $imagen = 'images/logo_hyundai.png';
                        break;
                    case 'kia':
                        $imagen = 'images/logo_kia.png';
                        break;
                    case 'mazda':
                        $imagen = 'images/logo_mazda.png';
                        break;
                    case 'nissan':
                        $imagen = 'images/logo_nissan.png';
                        break;
                    case 'volkswagen':
                        $imagen = 'images/logo_volkswagen.png';
                        break;
                    default:
                        $imagen = 'logo_not_found.png';
                }
            }


            echo "
                    <div class='left-panel'>
                    <div style='display: flex; padding-left: 30px;'>
                        <div style='padding-left: 40px; flex: 1; align-content: center;'>
                            <img src='" . getImage($make) . "' alt='marcaAuto' width='55px' height='auto'>
                        </div>
                        <div class='separador'></div>
                        <div style='flex-direction: column; flex: 1; padding-left: 15px;'>
                            <h2 style='text-align: left;'>" . $make . " " . $model . "</h2>
                            <h3>" . $anio . " " . $kilometraje . "</h3>
                        </div>
                    </div>
                    <div class='valores' id='adicionales'>
                        <div class='valores' id='estados'>
                            <h3>Valor de Venta</h3>
                            <b>" . $historicos[0]->purchase_price . "</b>
                            <p style='font-size: x-small; font-weight: 700;'>Cambio de un año</p>
                            <b>" . $datos->sale_price_percentage_variation . "</b>
                            <b>" . $datos->sale_price_variation . "</b>
                        </div>
                        <div class='separador'></div>
                        <div class='valores' id='estados'>
                            <h3>Valor medio</h3>
                            <b>" . $historicos[0]->medium_price . "</b>
                            <p style='font-size: x-small; font-weight: 700;'>Cambio de un año</p>
                            <b>" . $datos->medium_price_percentage_variation . "</b>
                            <b>" . $datos->medium_price_variation . "</b>
                        </div>
                        <div class='separador'></div>
                        <div class='valores' id='estados'>
                            <h3>Valor de compra</h3>
                            <b>" . $historicos[0]->purchase_price . "</b>
                            <p style='font-size: x-small; font-weight: 700;'>Cambio de un año</p>
                            <b>" . $datos->purchase_price_percentage_variation . "</b>
                            <b>" . $datos->purchase_price_variation . "</b>
                        </div>
                    </div>
                    <div class='valores' id='actions'>
                    <form id='form' type='submit' action=''>
                        <button name='3M' class='b_action'>3M</button>
                        <button name='6M' class='b_action'>6M</button>
                        <button name='1A' class='b_action'>1A</button>
                        <button name='2A' class='b_action'>2A</button>
                    </form>
                    </div>
                    <div class='grafica'>
                        <canvas id='grafica'></canvas>
                    </div>
                    <div class='valores' id='adicionales'>
                        <div class='valores' id='estados'>
                            <h3>Kilometrajes esperados </h3>
                            <b>" . $datos->km_minimum . "-" . $datos->km_maximum . "</b>
                        </div>
                        <div class='valores' id='estados'>
                            <h3>Kilometraje </h3>
                            <b>" . $kilometraje . "</b>
                        </div>
                        <div class='valores' id='estados'>
                            <h3>Indice de Facilidad Comercial (IFC)</h3>
                            <b>*IFC [Bajo, Medio, Alto]*</b>
                        </div>
                    </div>
                </div>
                <div class='separador'></div>
                <div class='right-panel'>
                    <div align='center'>
                        <!-- Regresar al formulario -->
                        <button class='button'>+ Cotizar nuevo auto</button>
                    </div>
                    <h2 id='h2_secundario'>Recomendaciones del auto</h2>
                </div>
                    ";
            ?>
        </main>
    </div>
</body>

</html>