<?php
require_once '../class/Paquete.class.php';
require_once '../logica/Session.php';
require_once '../logica/metodos_generales.php';

$paquetes = $_SESSION['ses_paquetes'];
$datos_usuario = filtrar_datos_post($_POST);
//var_dump($paquetes);
//var_dump($datos_usuario);
var_dump($datos_usuario);
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
                $url = 'https://sandbox-api.postmen.com/v3/rates';
                $method = 'POST';
                $headers = array(
                    "content-type: application/json",
                    "postmen-api-key: 5efa3bf0-1ef7-4aad-8335-cfeb478f0785"
                );
                
                /* PETICION DE PRUEBA CON LOS DATOS RECOGIDOS DE UN SOLO PAQUETE */
                $paquete_prueba = $paquetes[0];
                $datos_paquete = $paquete_prueba->get_medidas_paquete();
                $id_repartidor_api = 'a2b8a970-6fe5-4491-b9e2-8e3a6d17cd08';
                
                /*MIRAR DE COGER EN EL CAMPO DIRECCION LO QUE SE INTRODUCE YA QUE ES POSIBLE QUE EL CAMPO CALLE SEA ESE, CHEQUEAR CON EL EJEMPLO DE GOOGLE*/
                
                $body = '{"async":false,"shipper_accounts":[{"id":"'. $id_repartidor_api .'"}],'
                        . '"shipment":{'
                            . '"parcels":['
                            . '{"description":"'. $datos_paquete['descripcion'] .'",'
                            . '"box_type":"custom",'
                            . '"weight":{"value":' . $datos_paquete['peso'] . ',"unit":"kg"},'
                            . '"dimension":{"width":' . $datos_paquete['anchura'] . ','
                            . '             "height":' . $datos_paquete['altura'] . ','
                            . '             "depth":' . $datos_paquete['profundidad'] . ',"unit":"cm"},'
                            . '"items":[{"description":"envio","origin_country":"' . pasar_pais_a_codigo($datos_usuario['pais_origen']) . '","quantity":1,"price":{"amount":3,"currency":"EUR"},"weight":{"value":' . $datos_paquete['peso'] . ',"unit":"kg"}}]}'
                            . '],';//Acaba los datos del paquete
                
                
                // Parte del JSON con los datos del usuario
                $body  .= '"ship_from":{"contact_name":"'.$datos_usuario['nombre'].' ' . $datos_usuario['apellido'] .'",'
                        . '     "street1": "'.$datos_usuario['calle_origen'].'",'
                        . '     "city":"'.$datos_usuario['ciudad_origen'].'",'
                        . '     "postal_code":"'.$datos_usuario['codigo_postal_origen'].'",'
                        . '     "country":"' . pasar_pais_a_codigo($datos_usuario['pais_origen']) . '",'
                        . '     "phone":"'.$datos_usuario['telefono'].'",'
                        . '     "email":"'.$datos_usuario['email_remitente'].'",'
                        . '     "type":"residential"},'
                . '"ship_to":{"contact_name":"'.$datos_usuario['nombre'].' ' . $datos_usuario['apellido'] .'",'
                        . '   "street1": "'.$datos_usuario['calle_origen'].'",'
                        . '   "city":"'.$datos_usuario['ciudad_destino'].'",'
                        . '   "postal_code":"'.$datos_usuario['codigo_postal_destino'].'",'
                        . '   "country":"'.pasar_pais_a_codigo($datos_usuario['pais_destino']).'",'
                        . '   "phone":"'.$datos_usuario['telefono'].'",'
                        . '   "email":"'.$datos_usuario['email_destinatario'].'",'
                        . '   "type":"residential"}}}';

                echo 'JSON enviado<br>';
                echo $body;
                
                echo '<br>';
                echo '<br>';
                echo '<br>';
                
                
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_URL => $url,
                    CURLOPT_CUSTOMREQUEST => $method,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_POSTFIELDS => $body
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                echo 'Respuesta API:<br>';
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
                ?>
            </div>
        </div>

    </body>
</html>