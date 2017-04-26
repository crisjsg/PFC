<?php
//Comentar clase con BlockDoc
class Sesion {


    public function __construct() {
        if (!isset($_SESSION)) {
            $this->iniciar_sesion();
        }
    }


    public function iniciar_sesion() {
        session_start();
    }

}
