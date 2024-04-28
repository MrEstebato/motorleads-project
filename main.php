<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MotorLeads - Principal</title>
        <link href="estilos_main.css" rel="stylesheet" type="text/css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        </style>
    </head>
    <body>
        <div class="encabezado">
            <img src="pagina_principal.png" alt="Logo" class="logo">
        </div>
        <div class="principal">
            <?php
            echo"
                <form name='datos' method='POST'>
                    <table border='0' width='100%'>
                        <tr><p>Selecciona una Marca</p></tr>
                        <tr>
                        <input name='marca' type='search' size='40'>
                        </tr>
                        <tr><p>Selecciona un Modelo</p></tr>
                        <tr>
                        <input name='modelo' type='search' size='40'>
                        </tr>
                        <tr><p>Selecciona un Año</p></tr>
                        <tr>
                        <input name='anio' type='search' size='40'>
                        </tr>
                        <tr><p>Selecciona una Versión</p></tr>
                        <tr>
                        <input name='tipo' type='search' size='40'>
                        </tr>
                        <tr><p>Selecciona un Kilometraje</p></tr>
                        <tr>
                        <input name='kilometraje' type='text' size='40'>
                        </tr>
                        <tr><p>Selecciona un color</p></tr>
                        <tr>
                        <input name='color' type='search' size='40'>
                        </tr>
                        <tr><button type='submit' style='font-family: Poppins;'>Buscar</button>
                    </table>
                </form>
            ";
            ?>
        </div>
    </body>
</html>