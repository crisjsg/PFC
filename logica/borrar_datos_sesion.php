<?php
require_once 'session.php';

$posicion_paquete = filter_input(INPUT_POST, 'numero_paquete');
$posicion_paquete_int = intval($posicion_paquete);

//Se comprueba con este condicional si el paquete a borrar es el primero ya que
//es mejor utilizar el metodo array_shift con el primer elemento porque si se hace 
//con el array_splice el programa se bugeaba y no borraba correctamente los paquetes.
if ($posicion_paquete_int === 0) {
    //Lo borra el primer elemento del array y autoindexa los demás elementos
    array_shift($_SESSION['ses_paquetes']);
    sleep(2);
} else {
    //Lo borramos y se autoindexa el array con este método pasandole la posicion del localizador a borrar.
    array_splice($_SESSION['ses_paquetes'], $posicion_paquete_int, $posicion_paquete_int);
    sleep(2);
}
