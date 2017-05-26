<?php
require_once '../logica/Session.php';
/* 
 Archivo php dedicado a realizar todo lo relacionado con peticiones a la API Postmen.
 */

/* CONSTRUCCION DE (objetos) */

$empresas = array('aramex', 'bring', 'dhl', 'fedex', 'tnt', 'yodel');
$respuestas = array();
$usuario = new UsuarioRQ($datos_usuario);
// La variable con los datos de los paquetes estan en "resultado_multiple.php" 
// como $paquetes pero se pueden recoger aun desde ahí.


//Factoria
foreach ($empresas as $empresa) {
    $cabecera = new CabeceraRQ($empresa);
    $json = new Factoria_JSON($cabecera, $paquetes, $usuario);
    $array_json_peticion[$empresa] = $json->montar_JSON();
}

foreach ($array_json_peticion as $empresa => $json) {
    $peticion = new Peticion($json);
    $respuestas[$empresa] = $peticion->enviar_peticion();
}
    
    
    
echo '<h2>JSON por empresa</h2>';
foreach ($array_json_peticion as $empresa => $json) {
    echo 'JSON empresa ' . $empresa . '<br>';
    echo $json;
    echo '<br>';
    echo '<br>';
    echo '<br>';
}
//print_r($array_json_peticion['aramex']);


echo '<h2>Respuestas</h2>';
foreach ($respuestas as $empresa => $respuesta) {
    echo 'Respuesta empresa ' . $empresa . '<br>';
    echo $respuesta;
    echo '<br>';
    echo '<br>';
    echo '<br>';
}

/*
//Datos usuario

$array_datos_usuario = $usuario->get_datos_usuario();

//Paquetes
$array_paquetes_datos = array();

//Construimos los paquetes
foreach ($paquetes as $paquete) {
    $array_paquetes_datos['shipment']['parcels'][] = $paquete->get_paquete();
}
//Añadimos el origen y destino del paquete con los datos del usuario uniendolos en el array de paquetes
$array_paquetes_datos['shipment']['ship_from'] = $array_datos_usuario['ship_from'];
$array_paquetes_datos['shipment']['ship_to'] = $array_datos_usuario['ship_to'];

//Juntamos la cabecera y el array de paquetes (lleva informacion de los paquetes y del usuario)
$peticion_json = array_merge(
    $array_cabecera,
    $array_paquetes_datos
);
*/

//Envio de peticion
//$peticion = $cabecera_peticion, json_encode($peticion_json, JSON_UNESCAPED_UNICODE);
//$respuesta = $peticion->enviar_peticion();




/*
foreach ($empresas as $nombre_empresa) {
    $cabecera = new CabeceraRQ($nombre_empresa);
    $array_cabecera = $cabecera->get_cabecera();
    $cabecera_peticion = $cabecera->get_opciones_peticion();
    //Creamos objeto peticion
    $peticion = new Peticion($cabecera_peticion, json_encode($peticion_json, JSON_UNESCAPED_UNICODE));
    
    //Introducimos la peticion en el array de peticiones con el nombre de la empresa como clave y el valor el objeto peticion.
    $peticiones[$nombre_empresa] = $peticion;
    $respuestas[$nombre_empresa] = $peticion->enviar_peticion();
    
    $json_empresas[] = '<h2>JSON de la empresa ' . $nombre_empresa . '</h2><br>' . $peticiones[$nombre_empresa]->get_json() . '<br>';
}
 */
//var_dump($usuario);

//var_dump($array_datos_usuario);