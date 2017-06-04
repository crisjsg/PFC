<?php
class Ventana {
    
    //Propiedades
    private $datos_a_mostrar;
    private $ventana = '';


    //Constructor
    function __construct($datos_a_mostrar) {
        $this->datos_a_mostrar = $datos_a_mostrar;
    }
    
    
    public function get_datos_a_mostrar() {
        return $this->datos_a_mostrar;
    }
    
    public function get_ventana(){
        return $this->ventana;
    }

    public function contruir_filas(){
        $datos = $this->get_datos_a_mostrar();
        $filas = array();
        foreach ($datos as $empresa => $servicios) {
            $nombre_empresa = $empresa;
            foreach ($servicios as $servicio => $elementos_servicios) {
                $precio = $elementos_servicios['precio'];
                $nombre_servicio = str_replace('_', ' ', $servicio);
                $fila =  '<div class="fila">';
                    $fila .=  '<figure class="'. $nombre_empresa .'">';
                        $fila .=  '<img class="imagen_empresa" src="../media/img/img_'.$nombre_empresa.'.png" alt="img_'.$nombre_empresa.'" height="50" width="50">';
                        $fila .=  '<figcaption class="servicio">'. $nombre_servicio.'</figcaption>';
                    $fila .=  '</figure>';
                    $fila .=  '<div class="precio">'.$precio.' €</div>';
                $fila .=  '</div>';
            
                $filas[] = $fila;
            }
            
        }
        return $filas;
    }
    
    public function construir_ventana() {
        $filas = $this->contruir_filas();
        foreach ($filas as $fila) {
            echo $fila;
        }
    }
}




?>

