<?php

class Precio {

    //Propiedades
    private $precio;
    private $moneda;
    private $nombre_tarifa;

    function __construct($precio, $moneda, $nombre_tarifa) {
        if ($moneda !== 'EUR') {
            $precio_convertido = $this->convertir_moneda($precio, $moneda, 'EUR');
            $this->precio = $precio_convertido;
            $this->moneda = 'EUR';
            $this->nombre_tarifa = $nombre_tarifa;
        } else {
            $this->precio = $precio;
            $this->moneda = $moneda;
            $this->nombre_tarifa = $nombre_tarifa;
        }
    }

    //Metodos

    public function get_moneda() {
        return $this->moneda;
    }

    public function get_precio() {
        return $this->precio;
    }

    public function get_nombre_tarifa() {
        return $this->nombre_tarifa;
    }

    public function convertir_moneda($cantidad, $moneda_origen, $moneda_destino) {
        $url = "https://www.google.com/finance/converter?a=$cantidad&from=$moneda_origen&to=$moneda_destino";
        $datos = file_get_contents($url);
        preg_match("/<span class=bld>(.*)<\/span>/", $datos, $conversion);
        if (!isset($conversion[1])) {
            $conversion[1] = null;
        }
        $conversion = preg_replace("/[^0-9.]/", "", $conversion[1]);
        $resultado_conversion = round($conversion, 2);
        return $resultado_conversion;
    }

}
