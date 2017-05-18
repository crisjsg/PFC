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
        'bring'  => '3fad06c4-b325-45e9-b635-a1dc7fafd102',
        'dhl'    => '0fe56e4f-2c61-4088-8fbf-e9614e4f6d0e',
        'fedex'  => '6f43fe77-b056-45c3-bce4-9fec4040da0c',
        'tnt'    => 'a2b8a970-6fe5-4491-b9e2-8e3a6d17cd08',
        'yodel'  => 'fa23fe7d-93c9-4426-8412-ea03ce5a63f7'
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
    
    public function set_json($parm_json) {
        $this->json = $parm_json;
    }
}

?>