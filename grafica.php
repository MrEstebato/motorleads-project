<!DOCTYPE html>
    <html>
        <head>
            <title>
                MotorLeads
            </title>
            <link href="estilos.css" rel="stylesheet" type="text/css">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                    Usuario
                                </td>
                            </tr>
                        </table>
                    </button>
            </header>
            <main>
                <?php
                    include 'Utilerias.php';

                    //$url_form = $_GET[''];
                    //json_decode($url_form);
                    
                    $diccionario_general = API();
                    
                    $fabricante = findData($diccionario_general,'make');
                    $modelo = findData($diccionario_general,'model');
                    $anio = findData($diccionario_general,'year');
                    $version = findData($diccionario_general,'version');
                    $vehicle_id = findData($diccionario_general, 'vehicle_id');
                    $mes = findData($diccionario_general,'month_name');
                    
                    
                    $historicos = getHistoric($vehicle_id);
                    echo $historicos;
                    
                    $months = 3;
                    $url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                    $url_completa = $url_base."vehicles/".$vehicle_id."pricings?filter[since]=".$months;
                    
                    $precioCompra = findData(findData(findData($historicos,'historic'),'0'),'purchase_price');
                    $precioVenta = findData(findData(findData($historicos,'historic'),'0'),'sale_price');;
                    $precioMedio = findData(findData(findData($historicos,'historic'),'0'),'medium_price');

                    $km_minimum = findData($historicos,'km_minimum');
                    $km_maximum = findData($historicos,'km_maximum');
                    $kilometraje = findData($historicos,'km_average');


                    $dif_precios_venta = findData($historicos,'sale_price_variation');
                    $dif_precios_venta_porcentaje = findData($historicos,'sale_price_percentage_variation');
                    $dif_precios_compra = findData($historicos,'purchase_price_variation');
                    $dif_precios_compra_porcentaje = findData($historicos,'purchase_price_percentage_variation');
                    $dif_precios_medio = findData($historicos,'medium_price_variation');
                    $dif_precios_medio_porcentaje = findData($historicos,'medium_price_percentage_variation');

                    echo $diccionario_general;

                    $datasets[] = [$precioCompra,$precioMedio, $precioVenta];

                    echo "
                    <div class='left-panel'>
                    <div style='display: flex; padding-left: 30px;'>
                        <div style='padding-left: 40px; flex: 1; align-content: center;'>
                            <img alt='marcaAuto' width='55px' height='auto'>
                        </div>
                        <div class='separador'></div>
                        <div style='flex-direction: column; flex: 1; padding-left: 15px;'>
                            <h2 style='text-align: left;'>".$fabricante." ".$modelo."</h2>
                            <h3>".$anio." ".$version." ".$kilometraje."</h3>
                        </div>
                    </div>
                    <div class='valores' id='adicionales'>
                        <div class='valores' id='estados'>
                            <h3>Valor de Venta</h3>
                            <b>".$precioVenta."</b>
                            <p style='font-size: x-small; font-weight: 700;'>Cambio de un año</p>
                            <b>".$dif_precios_venta_porcentaje."</b>
                            <b>".$dif_precios_venta."</b>
                        </div>
                        <div class='separador'></div>
                        <div class='valores' id='estados'>
                            <h3>Valor medio</h3>
                            <b>".$precioMedio."</b>
                            <p style='font-size: x-small; font-weight: 700;'>Cambio de un año</p>
                            <b>".$dif_precios_medio_porcentaje."</b>
                            <b>".$dif_precios_medio."</b>
                        </div>
                        <div class='separador'></div>
                        <div class='valores' id='estados'>
                            <h3>Valor de compra</h3>
                            <b>".$precioCompra."</b>
                            <p style='font-size: x-small; font-weight: 700;'>Cambio de un año</p>
                            <b>".$dif_precios_compra_porcentaje."</b>
                            <b>".$dif_precios_compra."</b>
                        </div>
                    </div>
                    <div class='valores' id='actions'>
                    <form id='form' type='submit' action='' method='post'>
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
                            <h3>Kilometrajes esperados</h3>
                            <b>".$km_minimum."-".$km_maximum."</b>
                        </div>
                        <div class='valores' id='estados'>
                            <h3>Kilometraje</h3>
                            <b>".$kilometraje."</b>
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
                <script>
                    function getButtonByName(nombreboton) {
                        document.getElementById('form').getElementsByTagName(nombreboton);
                    }

                    function buildChart(canvas,dataset,months) {
                        const data = {
                            labels: months,
                            datasets: [
                                {
                                    label: 'Valor a la venta',
                                    data: dataset[0],
                                    borderColor: green,
                                    fill: {
                                        target: origin,
                                        below: 'rgba(124, 238, 55, 0.2)'
                                    },
                                    order: 1
                                },
                                {
                                    label: 'Valor medio',
                                    data: dataset[1],
                                    borderColor: orange,
                                    fill: {
                                        target: origin,
                                        below: 'rgba(253, 163, 33, 0.2)'
                                    },
                                    order: 2
                                },
                                {
                                    label: 'Valor a la compra',
                                    data: dataset[2],
                                    borderColor: blue,
                                    fill: {
                                        target: origin,
                                        below: 'rgba(33, 176, 253, 0.2)'
                                    },
                                    order: 3
                                }
                            ]
                        };
                        
                        // config
                        const config = {
                            type: 'line',
                            data: data,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    tooltips: {
                                        enabled: true,
                                        mode: 'average',
                                        callbacks: {
                                            label: function(context) {
                                                let label = '';
                                                if (context.dataset.label) {
                                                    label += context.dataset.label + ': ';
                                                }
                                                label += '$' + context.parsed.y.toFixed(2);
                                                return label;
                                            }
                                        }
                                    }
                                }
                            }
                        };
                        // verificar si ya hay una grafica en el canvas, 
                                    // de ser así actualizar la grafica
                        if (Chart.getChart(canvas)) {
                            Chart.getChart(canvas)
                            graficaExistente.data = data;
                            graficaExistente.update();
                        } else {
                            // contruir una grafica predeterminada en la ventana
                            var ctx = document.getElementById(canvas).getContext('2d');
                            var nuevaGrafica = buildChart(canvas,dataset,months);
                        }
                    }
                    
                    months = 0;
                    if (getButtonByName('3M')) {
                        months=3;
                        url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                        url_completa = url_base+"vehicles/"+<?php echo $vehicle_id; ?>+"pricings?filter[since]="+months;
                        fetch(url_completa);
                    } else if (getButtonByName('6M')) {
                        months=6;
                        url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                        url_completa = url_base+"vehicles/"+<?php echo $vehicle_id; ?>+"pricings?filter[since]="+months;
                        fetch(url_completa);
                    } else if (getButtonByName('1A')) {
                        months=12;
                        url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                        url_completa = url_base+"vehicles/"+<?php echo $vehicle_id; ?>+"pricings?filter[since]="+months;
                        fetch(url_completa);
                    } else if (getButtonByName('2A')) {
                        months=24;
                        url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                        url_completa = url_base+"vehicles/"+<?php echo $vehicle_id; ?>+"pricings?filter[since]="+months;
                        fetch(url_completa);
                    } else {
                        months = 1500;
                        url_base = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/";
                        url_completa = url_base+"vehicles/"+<?php echo $vehicle_id; ?>+"pricings?filter[since]="+months;
                        fetch(url_completa);
                    }
                </script>
                </main>
            </div>
        </body>
    </html>