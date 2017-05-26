<?php

class CabeceraRQ {

    // Propiedades
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
    // Elementos para el JSON
    private $async = false;
    private $shipper_accounts = array();

    //Constructor
    function __construct($nombre_empresa_reparto) {
        $this->empresa_reparto = $nombre_empresa_reparto;
        $keys = self::API_SHIPPERS_KEYS;
        $this->api_key_empresa = $keys[$nombre_empresa_reparto];
        $this->shipper_accounts = $this->anadir_api_key();
    }

    /**
     * Función que pasados los array de datos de usuario y paquetes genera el JSON.
     * @param array $datos_usuario
     * @param array $paquetes
     */
    public function anadir_api_key() {
        $shipper_accounts = array(
            "id" => $this->get_api_key_empresa()
        );
        return $shipper_accounts;
    }

    /**
     * Metodo que muestra la api key que se utilizará y la cual esta relacionada con la empresa
     * @return string
     */
    public function get_api_key_empresa() {
        return $this->api_key_empresa;
    }

    /**
     * Metodo que construye la primera parte del JSON (cabecera)
     * @return array
     */
    public function get_cabecera() {
        $cabecera_json['async'] = $this->async;
        $cabecera_json['shipper_accounts'] = array($this->shipper_accounts);
        return $cabecera_json;
    }

}
