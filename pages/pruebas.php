<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pruebas</title>
    </head>
    <body>
        <?php
        require_once '../class/Peticion.class.php';

        /* CREACION DE PETICIONES MULTIPLES */

        $empresas = array('aramex', 'bring', 'dhl', 'fedex', 'tnt', 'yodel');
        $peticiones = array();

        foreach ($empresas as $nombre_empresa) {
            $peticiones[] = new Peticion($nombre_empresa);
        }


        /* CREACION DE JSON MULTIPLES */
        $url = 'https://sandbox-api.postmen.com/v3/rates';
        $method = 'POST';
        $headers = array(
            "content-type: application/json",
            "postmen-api-key: 5efa3bf0-1ef7-4aad-8335-cfeb478f0785"
        );

        /* PETICION DE PRUEBA CON LOS DATOS RECOGIDOS DE VARIOS PAQUETES */
        $id_repartidor_api = 'a2b8a970-6fe5-4491-b9e2-8e3a6d17cd08';

        $body = '{"async":false,"shipper_accounts":[{"id":"' . $id_repartidor_api . '"}],'
                . '"shipment":{'
                . '"parcels":[';
        
        //Bucle que introduce los paquetes que se hayan hecho en el primer formulario al JSON
        for ($i = 0; $i < count($paquetes); $i++) {
            $datos_paquete = $paquete[$i]->get_medidas_paquete();
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

        echo 'JSON enviado<br>';
        echo $body;

        echo '<br>';
        echo '<br>';
        echo '<br>';
        ?>
    </body>
</html>
