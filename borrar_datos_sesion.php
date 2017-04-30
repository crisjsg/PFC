<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'logica/Session.php';
$posicion_paquete = filter_input(INPUT_POST, 'numero_paquete');
$posicion_paquete_int = intval($posicion_paquete);

//Lo borramos y se autoindexa el array con este método pasandole la posicion del localizador a borrar.
array_splice($_SESSION['ses_paquetes'], $posicion_paquete_int, $posicion_paquete_int);
sleep(2);
