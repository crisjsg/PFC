<?php

class Peticion {

    // Propiedades
    const HEADERS = array(
        'content-type: application/json',
        'postmen-api-key: 5efa3bf0-1ef7-4aad-8335-cfeb478f0785' // API maestra de mi cuenta en POSTMEN
    );
    const URL = 'https://sandbox-api.postmen.com/v3/rates';
    const METHOD = 'POST';

    /**
     * Api keys para poder realizar las peticiones por cada empresa de reparto.
     * 'empresa de reparto' => 'key'
     */
    const API_SHIPPERS_KEYS = array(
        'aramex' => '07b55d06-48af-4b02-a6b0-1e311e22b1e6',
        'bring' => '3fad06c4-b325-45e9-b635-a1dc7fafd102',
        'dhl' => '0fe56e4f-2c61-4088-8fbf-e9614e4f6d0e',
        'fedex' => '6f43fe77-b056-45c3-bce4-9fec4040da0c',
        'tnt' => 'a2b8a970-6fe5-4491-b9e2-8e3a6d17cd08',
        'yodel' => 'fa23fe7d-93c9-4426-8412-ea03ce5a63f7'
    );

    private $empresa_reparto;
    private $api_key_empresa;
    private $json;

    //Constructor
    function __construct($nombre_empresa_reparto) {
        $this->empresa_reparto = $nombre_empresa_reparto;
        $keys = self::API_SHIPPERS_KEYS;
        $this->api_key_empresa = $keys[$nombre_empresa_reparto];
    }

    //Metodos

    /**
     * Metodo que devuelve el nombre de la empresa que se enviará a la peticion.
     * @return string
     */
    public function get_empresa_reparto() {
        return $this->empresa_reparto;
    }

    /**
     * Metodo que muestra la api key que se utilizará y la cual esta relacionada con la empresa
     * @return string
     */
    public function get_api_key_empresa() {
        return $this->api_key_empresa;
    }

    /**
     * Metodo que deuvelve el contenido de la propiedad $json
     * @return string
     */
    public function get_json() {
        return $this->json;
    }

    /**
     * Función que pasados los array de datos de usuario y paquetes genera el JSON.
     * @param array $datos_usuario
     * @param array $paquetes
     */
    public function generar_json($datos_usuario, $paquetes) {
        /* @var $body string */
        $body = '{"async":false,"shipper_accounts":[{"id":"' . $this->get_api_key_empresa() . '"}],'
                . '"shipment":{'
                . '"parcels":[';
        $body .= $this->anadir_paquetes($paquetes, $datos_usuario);
        $body .= '],'; //Acaba los datos de los paquetes
        $body .= $this->anadir_datos_usuario($datos_usuario);
        $this->json = $body;
    }

    /**
     * Metodo que va introduciendo todos los paquetes que se utilizaran en la peticion.
     * @param array $paquetes
     * @param array $datos_usuario
     * @return string
     */
    public function anadir_paquetes($paquetes, $datos_usuario) {
        //Bucle que introduce los paquetes que se hayan hecho en el primer formulario
        $body = '';
        for ($i = 0; $i < count($paquetes); $i++) {
            $datos_paquete = $paquetes[$i]->get_medidas_paquete();
            $body .= '{"description":"' . $datos_paquete['descripcion'] . '",'
                    . '"box_type":"custom",'
                    . '"weight":{"value":' . $datos_paquete['peso'] . ',"unit":"kg"},'
                    . '"dimension":{"width":' . $datos_paquete['anchura'] . ','
                    . '             "height":' . $datos_paquete['altura'] . ','
                    . '             "depth":' . $datos_paquete['profundidad'] . ',"unit":"cm"},'
                    . '"items":[{"description":"envio","origin_country":'
                    . '"' . pasar_pais_a_codigo($datos_usuario['pais_origen']) . '",'
                    . '"quantity":1,"price":{"amount":3,"currency":"EUR"},'
                    . '"weight":{"value":' . $datos_paquete['peso'] . ',"unit":"kg"}}]}';
            if (($i + 1) !== sizeof($paquetes)) {
                $body .= ','; //Coma para los siguientes datos del proximo paquete
            }
        }
        return $body;
    }

    /**
     * Metodo que va introduciendo todos los datos del usuario que se utilizaran en la peticion.
     * @param array $datos_usuario
     * @return string
     */
    public function anadir_datos_usuario($datos_usuario) {
        // Parte del JSON con los datos del usuario
        $body = '"ship_from":{"contact_name":"' . $datos_usuario['nombre'] . ' ' . $datos_usuario['apellido'] . '",'
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
        return $body;
    }

    /**
     * Metodo que construye las opciones especificas para la peticion.
     * @return array
     */
    public function set_opciones_peticion() {
        $cabecera = self::HEADERS;
        $metodo = self::METHOD;
        $url = self::URL;
        $json = $this->json;

        $opciones_peticion = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $metodo,
            CURLOPT_HTTPHEADER => $cabecera,
            CURLOPT_POSTFIELDS => $json
        );

        return $opciones_peticion;
    }

    /**
     * Metodo encargado de construir la petición mediante cURL para enviarla a
     * la API
     * @return string
     */
    public function enviar_peticion() {
        $opciones = $this->set_opciones_peticion();
        $curl = curl_init();
        curl_setopt_array($curl, $opciones);

        $respuesta = curl_exec($curl);

        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            $respuesta_error = "cURL Error #:" . $error;
            return $respuesta_error;
        } else {
            return $respuesta;
        }
    }

}

?>