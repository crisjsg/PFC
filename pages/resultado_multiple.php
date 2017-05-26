<?php
require_once '../logica/class/Paquete.class.php';
require_once '../logica/class/UsuarioRQ.class.php';
require_once '../logica/class/Factoria_JSON.class.php';
require_once '../logica/class/CabeceraRQ.class.php';

require_once '../logica/class/Peticion.class.php';
require_once '../logica/Session.php';
require_once '../logica/metodos_generales.php';

$paquetes = $_SESSION['ses_paquetes'];
$datos_usuario = filtrar_datos_post($_POST);

require_once '../logica/conf/datos_peticion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cheapsy Deliver</title>
    </head>
    <body>
        <div id="contenedor">
            <header>
                <h1>Cheapsy Deliver</h1>
                <h2>Comparar, escoger, enviar</h2>
            </header>
            <div id="resultado">
                <h2>Resultado</h2>
<?php
include '../logica/peticion.php';

//echo $respuesta;
/*
foreach ($json_empresas as $json) {
    echo $json;
}
echo '<hr>';
 * 
foreach ($respuestas as $empresa => $respuesta) {
    echo '<h2>Respuesta: '. $empresa . '</h2><br>';
    echo $respuesta;
    echo '<br>';
}
*/
/*
echo 'Cabecera: <br>';
echo $cabecera_json;
echo '<br>';
echo 'Usuario: <br>';
echo $datos_usuario_json;
echo '<br>';

echo 'Peticion conjunta: <br>';
//print_r($array_cabecera);
echo '<br>';
//$peticion = array_merge($array_cabecera, $array_paquetes, $array_datos_usuario);
print_r(json_encode($peticion, JSON_UNESCAPED_UNICODE));

echo '<br>';
echo '<br>';
print_r($peticion);
*/


?>
            </div>
        </div>

    </body>
</html>