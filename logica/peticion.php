<?php

/* 
 Archivo php dedicado a realizar todo lo relacionado con peticiones a la API Postmen.
 */

/* CONSTRUCCION DE (objetos) PETICIONES */
$empresas = array('aramex', 'bring', 'dhl', 'fedex', 'tnt', 'yodel');
$peticiones = array();
$respuestas = array();

foreach ($empresas as $nombre_empresa) {
    //Creamos objeto peticion
    $peticion = new Peticion($nombre_empresa);
    
    //Construimos cada json por peticion (el json se guarda dentro de una propiedad del objeto llamado "json").
    $peticion->generar_json($datos_usuario, $paquetes);
    
    //Introducimos la peticion en el array de peticiones con el nombre de la empresa como clave y el valor el objeto peticion.
    $peticiones[$nombre_empresa] = $peticion;
    $respuestas[$nombre_empresa] = $peticion->enviar_peticion();
    
    $json_empresas[] = '<h2>JSON de la empresa ' . $nombre_empresa . '</h2><br>' . $peticiones[$nombre_empresa]->get_json() . '<br>';
}