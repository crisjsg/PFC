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
// La variable con los datos de los paquetes estan en "resultado_multiple.php" 
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
    
    
/* 
echo '<h2>JSON por empresa</h2>';
foreach ($array_json_peticion as $empresa => $json) {
    echo 'JSON empresa ' . $empresa . '<br>';
    echo $json;
    echo '<br>';
    echo '<br>';
    echo '<br>';
}
 * 
 */
//print_r($array_json_peticion['aramex']);

/*
echo '<h2>Respuestas JSON</h2>';
foreach ($respuestas as $empresa => $respuesta) {
    echo 'Respuesta empresa ' . $empresa . '<br>';
    echo $respuesta;
    echo '<br>';
    echo '<br>';
    echo '<br>';
}
*/

echo '<h2>Respuestas</h2>';


$tarifas_empresa = array();
$precios_correctos = array(); //Array que guardará los precios conversos a la moneda EUR

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

var_dump($precios_correctos);









/*
$precios = array();
foreach ($respuestas as $empresa => $json_respuesta) {
    $respuesta = new Respuesta($json_respuesta);
    $precios = $respuesta->sacar_precios_respuesta();
    echo 'Empresa ' . $empresa . '<br>';
    print_r($precios);
    echo '<br>';
}


*/











/*
foreach ($respuestas as $empresa => $respuesta) {
    //Convierte el string JSON a un array asociativo.
    $json_array = json_decode($respuesta, true);

    $ok = $json_array['meta']['message'];
    $resultado = $json_array['meta']['code'];

    //Si la respuesta es OK...
    if ($ok === 'OK' && $resultado === 200) {
        $datos = $json_array['data'];
        $tarifas = $datos['rates'];
        $nombre_empresa = $tarifas[0]['shipper_account']['slug']; // El nombre de la empresa siempre es el mismo.

        foreach ($tarifas as $tarifa) {
            $servicio = $tarifa['service_name'];
            $precio = $tarifa['total_charge']['amount'];
            //Si el servicio esta seteado y ya existe en el array...
            if (isset($precios[$nombre_empresa][$servicio]) && array_key_exists($servicio, $precios[$nombre_empresa])) {
                $precio_antiguo = $precios[$nombre_empresa][$servicio];
                //Y este precio es más bajo que el que ya existia...
                if ($precio < $precio_antiguo){
                    //Guardamos el precio más barato
                    $precios[$nombre_empresa][$servicio] = $precio;
                }else{
                    //No sustituye el precio antiguo al no ser más barato
                }
            } else {
                //Como no existia lo introducimos como nuevo precio para ese sericio
                $precios[$nombre_empresa][$servicio] = $precio;
            }
        }
    }
}

print_r($precios);
 * */