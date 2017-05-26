<?php

class UsuarioRQ {

// Propiedades
    private $datos_usuario;
    private $ship_from = array(); // array asociativo
    private $ship_to = array();

//Constructor

    function __construct($datos_usuario) {
        $this->datos_usuario = $datos_usuario;
        $this->ship_from = $this->anadir_datos_origen();
        $this->ship_to = $this->anadir_datos_destino();
    }

    /**
     * Metodo que va introduciendo todos los datos de origen del usuario que se utilizaran en la peticion.
     * @param array $datos_usuario
     * @return string
     */
    public function anadir_datos_origen() {
// Campo del requerido del JSON -> Campo del formulario que rellena este campo
        $datos_origen = array(
            'contact_name' => $this->datos_usuario['nombre'] . ' ' . $this->datos_usuario['apellido'],
            'street1' => $this->datos_usuario['calle_origen'],
            'city' => $this->datos_usuario['ciudad_origen'],
            'postal_code' => $this->datos_usuario['codigo_postal_origen'],
            'country' => pasar_pais_a_codigo($this->datos_usuario['pais_origen']),
            'phone' => $this->datos_usuario['telefono'],
            'email' => $this->datos_usuario['email_remitente'],
            'type' => 'residential'
        );
        return $datos_origen;
    }
    
    /**
     * Metodo que va introduciendo todos los datos de destino del usuario que se utilizaran en la peticion.
     * @param array $datos_usuario
     * @return string
     */
    public function anadir_datos_destino() {
// Campo del requerido del JSON -> Campo del formulario que rellena este campo
        $datos_destino = array(
            'contact_name' => $this->datos_usuario['nombre'] . ' ' . $this->datos_usuario['apellido'],
            'street1' => $this->datos_usuario['calle_destino'],
            'city' => $this->datos_usuario['ciudad_destino'],
            'postal_code' => $this->datos_usuario['codigo_postal_destino'],
            'country' => pasar_pais_a_codigo($this->datos_usuario['pais_destino']),
            'phone' => $this->datos_usuario['telefono'],
            'email' => $this->datos_usuario['email_destinatario'],
            'type' => 'residential'
        );
        return $datos_destino;
    }
    
    /**
     * Metodo que devuelve un array de asociativo con los datos del usuario.
     * @return array
     */
    public function get_datos_usuario() {
        $datos_usuario_json['ship_from'] = $this->ship_from;
        $datos_usuario_json['ship_to'] = $this->ship_to;
        return $datos_usuario_json;
    }

}
