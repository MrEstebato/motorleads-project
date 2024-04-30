
    
    <?php

if(sizeof($_GET) == 0){
    $URLAPI = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/makes";
    $nombreLista = "makesL";
    $datosFormulario = "";
    $casoEspecialEndPoint = "-1";
    $elementosDisponibles = "[]";
    
}
else{
    $URLAPI = $_GET["enlaceAPI"];
    $nombreLista = $_GET["nombreLista"];
    $datosFormulario = $_GET["datosFormulario"];
    $elementosDisponibles = $_GET["elementosDisponibles"];
}

$datos = file_get_contents($URLAPI);
//$datos = json_encode($datos);
$datos = str_replace('\"', " pulgadas", $datos);


    echo "
    <!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<script src='index.js'></script>
<title>MotorLeads - Principal</title>
<link href='estilos_main.css' rel='stylesheet' type='text/css'>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    /* Añade estilos adicionales para centrar y ajustar la disposición */
    body {
        text-align: center; /* Centra el contenido de todo el cuerpo */
        font-family: 'Poppins', sans-serif;
    }

    table {
        margin: 0 auto; /* Centra la tabla horizontalmente */
    }

    td {
        text-align: left; /* Alinea el texto de cada celda a la izquierda */
        vertical-align: top; /* Asegura que el contenido de las celdas se alinee en la parte superior */
    }

    p {
        text-align: center; /* Centra los párrafos dentro de sus celdas */
    }

    input {
        display: block; /* Hace que los inputs se muestren como bloque para forzar un salto de línea */
        margin: 10px auto; /* Espaciado y centrado vertical de los inputs */
    }
</style>
</head>
<body>
<div class='encabezado'>
    <img src='pagina_principal.png' alt='Logo' class='logo'>
</div>
<div class='principal'>
    <form name='APIForm' method='POST'>
        <table border='0' width='50%'> <!-- Ajusta el ancho de la tabla si es necesario -->
            <tr>
                <td><p>Selecciona una Marca</p>
                <input list='makesL' id='makes' size='40'></td>
            </tr>
            <tr>
                <td id='modelsTdP'><p>Selecciona un Modelo</p>
                <input list='modelsL' id='models' size='40' disabled = 'false'></td>
            </tr>
            <tr>
                <td id='yearsTd'><p>Selecciona un Año</p>
                <input list='yearsL' id='years' size='40' disabled></td>
            </tr>
            <tr>
                <td id='vehiclesTd'><p>Selecciona una Versión</p>
                <input list='vehiclesL' id='vehicles' size='40' disabled></td>
            </tr>
            <tr>
                <td><p>Selecciona un Kilometraje</p>
                <input name='kilometraje'id ='km' type='text' size='40'></td>
            </tr>
            <tr>
                <td><p>Selecciona un color</p>
                <input name='color' type='text' id='color' size='40'></td>
            </tr>
            <tr>
                <td><center><button type='button' style='font-family: Poppins; padding-left:'300px';' onClick='enviaDatos(JSON.stringify(".$datos."),3)'>Buscar</button></center></td>
            </tr>
        </table>
    </form>
    

    
</div>
</body>
</html>


";







echo "<script>agregarEventListenersListas()</script>";


echo "<script>setEnlaceActual('".$URLAPI."')</script>";

echo "<script>desplegarDatos('".$datos."','".$nombreLista."','".$datosFormulario."','".$elementosDisponibles."')</script>";


?>

