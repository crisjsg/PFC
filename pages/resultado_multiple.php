<?php
require_once '../logica/class/Paquete.class.php';
require_once '../logica/Session.php';
require_once '../logica/metodos_generales.php';

$paquetes = $_SESSION['ses_paquetes'];
$datos_usuario = filtrar_datos_post($_POST);

require_once '../logica/conf/datos_peticion.php';



//var_dump($paquetes);
//var_dump($datos_usuario);
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

                echo 'JSON enviado<br>';
                echo $body;
                ?>
            </div>
        </div>

    </body>
</html>