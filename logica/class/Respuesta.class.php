<?php

class Respuesta {
    
    private $json;
    private $json_decodificado;
    
    function __construct($json_respuesta) {
        
        $this->json = $json_respuesta;
        $this->json_decodificado = json_decode($json_respuesta);
        
    }

}

