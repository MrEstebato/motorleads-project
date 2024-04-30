<?php
// encontrar un dato en un diccionario por su llave
function findByKey($data, $key) {
    foreach ($data as $item) {
        if ($item->id == $key) {
            return $item;
        }
    }
    return null;
}

// obtener la información de un JSON para extraer e imprimirla en html
function API() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != NULL) {
            if (isset($datos->makes) && isset($datos->models) &&  isset($datos->years) && 
                isset($datos->vehicles) && isset($datos->pricings)) {
                $conjuntoDatos = [];

                foreach ($datos->vehicles as $vehicle) {
                    // Buscar los datos correspondientes al vehicle
                    $make = findByKey($datos->makes, $vehicle->make_id);
                    $model = findByKey($datos->models, $vehicle->model_id);
                    $year = findByKey($datos->years, $vehicle->year_id);
                    $pricing = findByKey($datos->pricings, $vehicle->pricing_id);

                    // Construir el diccionario de datos
                    $conjuntoDatos[] = [
                        'make' => $make->name,
                        'model' => $model->name,
                        'year' => $year->name,
                        'version' => $vehicle->version,
                        'month' => $pricing->month_name,
                        'purchase_price' => $pricing->purchase_price
                    ];
                }
                http_response_code(200);
                return $conjuntoDatos;
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
    }
}

// encontrar el dato detras de una llave de un diccionario
function findData($data, $key) {
    if (isset($data[$key])) {
        return htmlspecialchars($data[$key]);
    } else {
        return '';
    }
}

// solicitar historicos
function getHistoric($vehicle) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $datos = json_decode(file_get_contents('php://input'));
        if ($datos != NULL) {
            if (isset($datos->vehicles)) {
                $historicos = [];

                foreach ($datos->vehicles as $vehicle) {
                    $vehicle = findByKey($datos->vehicle,$vehicle->vehicle_id);

                    $historicos[] = [
                        'vehicle_id' => $vehicle->vehicle_id,
                        'historic' => $vehicle->historic,
                        'sale_price_variation' => $vehicle->sale_price_variation,
                        'sale_price_percentage_variation' => $vehicle->sale_price_percentage_variation,
                        'purchase_price_variation' => $vehicle->purchase_price_variation,
                        'purchase_price_percentage_variation' => $vehicle->purchase_price_percentage_variation,
                        'medium_price_variation' => $vehicle->medium_price_variation,
                        'medium_price_percentage_variation' => $vehicle->medium_price_percentage_variation,
                        'km_minimum'=>$vehicle->km_minimum,
                        'km_maximum'=>$vehicle->km_maximum,
                        'km_average'=>$vehicle->km_average
                    ];

                    if ($historicos[1] != NULL){
                        $historic = $historicos[1];
                        for ($i = 0; $i < count($historic); $i++) {
                            $year = $historic[$i]['year'];
                            $month = $historic[$i]['month'];
                            $month_name = $historic[$i]['month_name'];
                            $pruchase_price = $historic[$i]['purchase_price'];
                            $sale_price = $historic[$i]['sale_price'];
                            $medium_price = $historic[$i]['medium_price'];
                        }
                        $year = array_reverse($year);
                        $month = array_reverse($month);
                        $month_name = array_reverse($month_name);
                        $pruchase_price = array_reverse($pruchase_price);
                        $sale_price = array_reverse($sale_price);
                        $medium_price = array_reverse($medium_price);
                    }
                }
                http_response_code(200);
                return $historicos;
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
    }
}