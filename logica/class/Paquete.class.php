<?php

//Nota: en esta clase no se utilizan los setters ya que no se necesitan cambiar las medidas posteriormente una vez se construya el paquete.
class Paquete {

//Propiedades
    private $ancho;
    private $alto;
    private $profundo;
    private $peso;
    private $descripcion;

//Constructor
    /**
     * Constructor de la clase Paquete que le pasamos por parametros todas las medidas de este.
     * @param string $ancho
     * @param string $alto
     * @param string $profundo
     * @param string $peso
     */
    function __construct($ancho, $alto, $profundo, $peso, $descripcion) {
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->profundo = $profundo;
        $this->peso = $peso;
        $this->descripcion = $descripcion;
    }

//Logica

    /**
     * Metodo que devuelve una string con la anchura
     * @return string
     */
    public function get_ancho() {
        return $this->ancho;
    }

    /**
     * Metodo que devuelve una string con la altura
     * @return string
     */
    public function get_alto() {
        return $this->alto;
    }

    /**
     * Metodo que devuelve una string con la profundidad
     * @return string
     */
    public function get_profundo() {
        return $this->profundo;
    }

    /**
     * Metodo que devuelve una string con el peso
     * @return string
     */
    public function get_peso() {
        return $this->peso;
    }

    /**
     * Metodo que devuelve una string con la descripcion del paquete
     * @return string
     */
    public function get_descripcion() {
        return $this->descripcion;
    }

    /**
     * Función que devuelve un array con todas las medidas del paquete
     * @return array
     */
    public function get_medidas_paquete() {
        $ancho = $this->get_ancho();
        $alto = $this->get_alto();
        $profundo = $this->get_profundo();
        $peso = $this->get_peso();
        $descripcion = $this->get_descripcion();

        $medidas_paquete = array(
            "Anchura" => $ancho,
            "Altura" => $alto,
            "Profundidad" => $profundo,
            "Peso" => $peso,
            "Descripcion" => $descripcion);

        return $medidas_paquete;
    }

    /**
     * Función que devuelve una string con todas las medidas del paquete
     * @return string
     */
    public function mostrar_medidas_paquete() {
        $medidas = '';
        $paquete = $this->get_medidas_paquete();
        foreach ($paquete as $dato => $valor) {
            $medidas .= '<span class="medida">' . $dato . ': ' . $valor . '</span> ';
        }
        
        return $medidas;
        
    }

    /**
     * Metodo que devuelve los datos del objeto paquete como array asociativo
     * para su posterior construcción en el JSON
     * @return array
     */
    public function get_paquete() {
        $paquete_json = array() ;
        $paquete_json['description'] = $this->descripcion;
        $paquete_json['box_type'] = 'custom';
        $paquete_json['weight'] = array(
            'value' => intval($this->peso),
            'unit' => 'kg'
        );
        $paquete_json['dimension'] = array(
            'width' => intval($this->ancho),
            'height' => intval($this->alto),
            'depth' => intval($this->profundo),
            'unit' => 'cm'
        );
        
        $paquete_json['items'][] = array(
            'description' => 'envio',
            'quantity' => 1,
            'price' => array(
                'amount' => 3,
                'currency' => 'EUR'
            ),
            'weight' => array(
                'value' => intval($this->peso),
                'unit' => 'kg'
            )
        );
        return $paquete_json;
    }

}
