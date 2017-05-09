<?php
/**
 * Función al que se le pasa la variable post para devolver un array con todos los datos filtrados.
 * @param array $variable_post
 */
function filtrar_datos_post($variable_post) {
    $datos_filtrados = array();
    foreach ($variable_post as $elemento => $valor) {
        $datos_filtrados[$elemento] = htmlspecialchars($valor);
    }
    
    return $datos_filtrados;
}
?>