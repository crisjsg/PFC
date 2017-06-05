<?php
require_once '../logica/Session.php';
require_once '../logica/class/Respuesta.class.php';
require_once '../logica/class/Precio.class.php';
/* 
 Archivo php dedicado a realizar todo lo relacionado con peticiones a la API Postmen.
 */

/* CONSTRUCCION DE (objetos) */

$empresas = array('aramex', 'bring', 'dhl', 'fedex', 'tnt', 'yodel');
$respuestas = array();
$usuario = new UsuarioRQ($datos_usuario);
// La variable con los datos de los paquetes estan en "resultado.php" 
// como $paquetes pero se pueden recoger aun desde ahí.


//Factoria
foreach ($empresas as $empresa) {
    $cabecera = new CabeceraRQ($empresa);
    $json = new Factoria_JSON($cabecera, $paquetes, $usuario);
    $array_json_peticion[$empresa] = $json->montar_JSON();
}

//Guardamos cada respuesta por empresa
foreach ($array_json_peticion as $empresa => $json) {
    $peticion = new Peticion($json);
    $respuestas[$empresa] = $peticion->enviar_peticion();
}

// *** PARTE DE TRATADO DE LA INFORMACION ***
$tarifas_empresa = array();
$precios_correctos = array(); //Array que guardará los precios conversos a la moneda EUR
$array_ext_tarifas = array();

//De las respuestas iteramos por cada respuesta de cada empresa
foreach ($respuestas as $json_respuesta) {
    $respuesta = new Respuesta($json_respuesta);
    if ($respuesta->sacar_precios_respuesta()) {
        $array_ext_tarifas[] = $respuesta->sacar_precios_respuesta();
    }
}

//Recogemos las tarifaas de las empresas
for ($i = 0; $i < count($array_ext_tarifas); $i++) {
    $empresa = key($array_ext_tarifas[$i]);
    $tarifas = $array_ext_tarifas[$i][$empresa];
    //Por cada tarifa cogemos la moneda y el precio
    foreach ($tarifas as $tarifa => $elementos) {
        $moneda = $elementos['moneda'];
        $cantidad = $elementos['precio'];
        
        //Construimos el objeto Precio
        $precio = new Precio($cantidad, $moneda, $tarifa);
        //Si el nombre de la tarifa no esta vacio (y por lo tanto el precio tampoco)...
        if ($precio->get_nombre_tarifa() !== '') {
            //Los guardamos en el array de precios correctos
            $precios_correctos[$empresa][$precio->get_nombre_tarifa()] = array(
                'precio' => $precio->get_precio(),
                'moneda' => $precio->get_moneda()
            );
        }
    }
}

$precios_correctos_ordenados = asort($precios_correctos, 1); //Ordenar array asociativo de forma numerica segun su valor

//var_dump($precios_correctos);