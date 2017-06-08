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
        <link rel="stylesheet" type="text/css" href="/estilos/fuentes.css">
        <link rel="stylesheet" type="text/css" href="/estilos/header.css">
        <link rel="stylesheet" type="text/css" href="/estilos/botones.css">
        <link rel="stylesheet" type="text/css" href="/estilos/resultado.css">
    </head>
    <body>
        <header>
            <hgroup>
                <h1>Cheapsy Deliver</h1>
                <h2 id="tagline">Comparar, escoger, enviar</h2>
            </hgroup>
            <nav>
                <ul>
                    <li><a href="/index.php">Home</a></li>
                </ul>
            </nav>
        </header>
        <div id="contenido">
            <div id="resultado">
                <h2>Resultado</h2>
<?php
include '../logica/peticion.php';

$ventana = new Ventana($precios_correctos);

if(empty($ventana->get_datos_a_mostrar())){
    header('Location: error_resultado.php');
}else{
    $ventana->construir_ventana();
}


//var_dump($ventana);
?>
                
            </div>
        </div>

    </body>
</html>