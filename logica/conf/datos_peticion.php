<?php

//var_dump($datos_usuario);


$id_repartidor_api = 'a2b8a970-6fe5-4491-b9e2-8e3a6d17cd08';

$body = '{"async":false,"shipper_accounts":[{"id":"' . $id_repartidor_api . '"}],'
        . '"shipment":{'
        . '"parcels":[';

//Bucle que introduce los paquetes que se hayan hecho en el primer formulario al JSON
for ($i = 0; $i < count($paquetes); $i++) {
    $datos_paquete = $paquetes[$i]->get_medidas_paquete();
    $body .= '{"description":"' . $datos_paquete['descripcion'] . '",'
            . '"box_type":"custom",'
            . '"weight":{"value":' . $datos_paquete['peso'] . ',"unit":"kg"},'
            . '"dimension":{"width":' . $datos_paquete['anchura'] . ','
            . '             "height":' . $datos_paquete['altura'] . ','
            . '             "depth":' . $datos_paquete['profundidad'] . ',"unit":"cm"},'
            . '"items":[{"description":"envio","origin_country":"' . pasar_pais_a_codigo($datos_usuario['pais_origen']) . '","quantity":1,"price":{"amount":3,"currency":"EUR"},"weight":{"value":' . $datos_paquete['peso'] . ',"unit":"kg"}}]}'
            . ','; //Coma para los siguientes datos del proximo paquete
}

$body .= '],'; //Acaba los datos de los paquetes
// Parte del JSON con los datos del usuario
$body .= '"ship_from":{"contact_name":"' . $datos_usuario['nombre'] . ' ' . $datos_usuario['apellido'] . '",'
        . '     "street1": "' . $datos_usuario['calle_origen'] . '",'
        . '     "city":"' . $datos_usuario['ciudad_origen'] . '",'
        . '     "postal_code":"' . $datos_usuario['codigo_postal_origen'] . '",'
        . '     "country":"' . pasar_pais_a_codigo($datos_usuario['pais_origen']) . '",'
        . '     "phone":"' . $datos_usuario['telefono'] . '",'
        . '     "email":"' . $datos_usuario['email_remitente'] . '",'
        . '     "type":"residential"},'
        . '"ship_to":{"contact_name":"' . $datos_usuario['nombre'] . ' ' . $datos_usuario['apellido'] . '",'
        . '   "street1": "' . $datos_usuario['calle_origen'] . '",'
        . '   "city":"' . $datos_usuario['ciudad_destino'] . '",'
        . '   "postal_code":"' . $datos_usuario['codigo_postal_destino'] . '",'
        . '   "country":"' . pasar_pais_a_codigo($datos_usuario['pais_destino']) . '",'
        . '   "phone":"' . $datos_usuario['telefono'] . '",'
        . '   "email":"' . $datos_usuario['email_destinatario'] . '",'
        . '   "type":"residential"}}}';

