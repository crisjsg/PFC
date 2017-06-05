<?php
require_once '../logica/class/Paquete.class.php';
require_once '../logica/class/UsuarioRQ.class.php';
require_once '../logica/class/Factoria_JSON.class.php';
require_once '../logica/class/CabeceraRQ.class.php';
require_once '../logica/class/Ventana.class.php';
require_once '../logica/class/Peticion.class.php';
require_once '../logica/Session.php';
require_once '../logica/metodos_generales.php';

$paquetes = $_SESSION['ses_paquetes'];
$datos_usuario = filtrar_datos_post($_POST);

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

$ventana = new Ventana($precios_correctos);
$ventana->construir_ventana();

?>
                
            </div>
        </div>

    </body>
</html>