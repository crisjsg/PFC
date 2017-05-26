<?php

/**
 * Clase encargada de construir el JSON a partir de un objeto CabeceraRQ, Paquete, UsuarioRQ.
 */
class Factoria_JSON {

    //Propiedades
    private $cabecera;
    private $paquetes;
    private $datos_usuario;

    //Constructor
    function __construct($cabecera, $datos_paquetes, $usuario) {

        //Conseguimos el array asociativo del objeto Cabecera para luego
        //su conversion a JSON
        $datos_cabecera = $cabecera->get_cabecera();
        $this->cabecera = $datos_cabecera;

        //Recibimos el array de objetos paquete para luego construirlo en el JSON
        $this->paquetes = $datos_paquetes;

        //Conseguimos el array asociativo del objeto Uusario para luego
        //su conversion a JSON
        $datos_usuario = $usuario->get_datos_usuario();
        $this->datos_usuario = $datos_usuario;
    }

    //Metodos
    
    /**
     * Metodo que transforma toda la informacion de los datos pasados en arrays 
     * asociativos a una string con la estructura de un JSON
     * @return string
     */
    public function montar_JSON() {
        $datos_cabecera = $this->cabecera;
        $datos_paquetes = $this->paquetes;
        $datos_usuario = $this->datos_usuario;

        $array_paquetes_datos = array();
        //Construimos los paquetes
        foreach ($datos_paquetes as $paquete) {
            $array_paquetes_datos['shipment']['parcels'][] = $paquete->get_paquete();
        }
//Añadimos el origen y destino del paquete con los datos del usuario uniendolos en el array de paquetes
        $array_paquetes_datos['shipment']['ship_from'] = $datos_usuario['ship_from'];
        $array_paquetes_datos['shipment']['ship_to'] = $datos_usuario['ship_to'];


        $json = array_merge(
                $datos_cabecera, $array_paquetes_datos
        );
        
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

}
