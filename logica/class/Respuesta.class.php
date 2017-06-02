<?php

class Respuesta {

    private $json;
    private $json_decodificado;
    private $ok;
    private $code;
    private $moneda;

    function __construct($json_respuesta) {

        $this->json = $json_respuesta;
        $this->json_decodificado = json_decode($json_respuesta, true);
        $this->recoger_resultado_respuesta();
    }

    /**
     * Devuelve el resultado de la respuesta
     * @return string
     */
    public function get_ok() {
        return $this->ok;
    }

    /**
     * Devuelve el codigo de la respuesta
     * @return String
     */
    public function get_code() {
        return $this->code;
    }

    /**
     * Metodo que devuelve el json decodificado en un array asociativo.
     * @return String
     */
    public function get_json_decodificado() {
        return $this->json_decodificado;
    }

    /**
     * Metodo que guarda en las propiedades "ok" y "code" el resultado de la respuesta a la API
     */
    public function recoger_resultado_respuesta() {
        $json_decodificado = $this->json_decodificado;
        $this->ok = $json_decodificado['meta']['message'];
        $this->code = $json_decodificado['meta']['code'];
    }

    public function sacar_moneda_respuesta() {
        $json_decodificado = $this->json_decodificado;
        $this->moneda;
    }

    public function check_respuesta_satisfactoria() {
        if ($this->get_ok() === 'OK' && $this->get_code() === 200) {
            return true;
        } else {
            return false;
        }
    }

    //Revisar...
    public function sacar_precios_respuesta() {
        $precios = array();

        //Si la respuesta es OK  y el servicio no es null...
        if ($this->check_respuesta_satisfactoria()) {
            $json_array = $this->get_json_decodificado();
            $datos = $json_array['data'];
            $tarifas = $datos['rates'];
            $nombre_empresa = $tarifas[0]['shipper_account']['slug']; // El nombre de la empresa siempre es el mismo.

            foreach ($tarifas as $tarifa) {
                $servicio = $tarifa['service_name'];
                $precio = $tarifa['total_charge']['amount'];
                $moneda = $tarifa['total_charge']['currency'];
                //Si el servicio esta seteado y ya existe en el array...
                if (isset($precios[$nombre_empresa][$servicio]) && array_key_exists($servicio, $precios[$nombre_empresa])) {
                    $precio_antiguo = $precios[$nombre_empresa][$servicio];
                    //Y este precio es más bajo que el que ya existia...
                    if ($precio < $precio_antiguo) {
                        //Guardamos el precio más barato
                        $precios[$nombre_empresa][$servicio]['precio'] = $precio;
                        $precios[$nombre_empresa][$servicio]['moneda'] = $moneda;
                    } else {
                        //No sustituye el precio antiguo al no ser más barato
                    }
                } else {
                    //Como no existia lo introducimos como nuevo precio para ese sericio
                    $precios[$nombre_empresa][$servicio]['precio'] = $precio;
                    $precios[$nombre_empresa][$servicio]['moneda'] = $moneda;
                }
            }
        }
        return $precios;
    }

}
