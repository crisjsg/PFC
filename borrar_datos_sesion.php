<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'logica/Session.php';
$posicion_paquete = trim(filter_input(INPUT_POST, 'paquete'));

//$sesion->borrar_elemento_sesion($_SESSION['ses_paquetes'], $paquete);
function borrar_elemento_sesion($variable_sesion, $posicion_a_borrar) {

    //Lo borramos y se autoindexa el array con este método pasandole la posicion del localizador a borrar.
    array_splice($variable_sesion, intval($posicion_a_borrar), intval($posicion_a_borrar));
}

borrar_elemento_sesion($_SESSION['ses_paquetes'], $posicion_paquete);
var_dump($_SESSION);
//session_destroy();
