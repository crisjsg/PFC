<?php

class Peticion {

    private $cabecera;

    const HEADERS = array(
        'content-type: application/json',
        'postmen-api-key: 5efa3bf0-1ef7-4aad-8335-cfeb478f0785' // API maestra de mi cuenta en POSTMEN
    );
    const URL = 'https://sandbox-api.postmen.com/v3/rates';
    const METHOD = 'POST';

    private $json;

    //Constructor
    function __construct($json_peticion) {
        $this->json = $json_peticion;
        $this->cabecera = $this->construir_opciones_peticion();
    }

    //Metodos

    /**
     * Metodo encargado de construir la petición mediante cURL para enviarla a
     * la API
     * @return string
     */
    public function enviar_peticion() {
        $opciones = $this->cabecera;
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

    /**
     * Metodo que construye las opciones especificas para la peticion.
     * @return array
     */
    public function construir_opciones_peticion() {
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
     * Metodo que deuvelve el contenido de la propiedad $json
     * @return string
     */
    public function get_json() {
        return $this->json;
    }
}

?>