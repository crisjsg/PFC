<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cheapsy Deliver</title>
    </head>
    <body>
        <?php
        require_once 'class/Session.class.php';
        require_once 'class/Paquete.class.php';
        $sesion = new Sesion();

        $_SESSION['prueba'] = "Hola mundo"
        ?>
        <header>
            <h1>Cheapsy Deliver</h1>
            <h2>Comparar, escoger, enviar</h2>
        </header>

        <div id="formulario">
            <h3>Formulario</h3>
            <form name="formulario_datos_paquetes" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                Ancho:
                <input type="text" name="ancho" placeholder="Anchura del paquete (cm)" />
                <br>
                Alto:
                <input type="text" name="alto" placeholder="Altura del paquete (cm)" />
                <br>
                Profundo:
                <input type="text" name="profundo" placeholder="Profundidad del paquete (cm)" />
                <br>
                Peso:
                <input type="text" name="peso" placeholder="Peso del paquete (kg)" />
                <br>
                Corta descripción del paquete:
                <textarea name="descripcion_paquete" rows="2" cols="50" maxlength="50" placeholder="Maximo 50 caracteres"></textarea>

                <br>
                <!-- <button onclick="anadirPaquete()">Añadir</button> -->

                <input type="submit" value="Comparar" name="paquetes" />
            </form>

            <h3>Paquetes</h3>
            <?php
            /*
             * $_POST['paquetes'] -> Contiene los paquetes que posteriormente se guardaran en 
             * $_SESSION['comparar_paquetes'] para que luego se realice las peticiones a la API
             */

            /**
             * La idea es que se envien varios paquetes por POST y luego ir guardando en la variable $_SESSION['comparar_paquetes'] cada paquete
             * por individual para ir añadiendo de uno en uno con sus tamaños en las peticiones que se harán.
             */
            //Si hay datos en la variable 'paquetes' en el envio por POST haz...
            if (isset($_POST['paquetes'])) {

                echo '<h4>Datos formulario</h4><br>';
                //Datos recibidos del formulario

                $ancho = filter_input(INPUT_POST, 'ancho');
                $alto = filter_input(INPUT_POST, 'alto');
                $profundo = filter_input(INPUT_POST, 'profundo');
                $peso = filter_input(INPUT_POST, 'peso');
                $descripcion = filter_input(INPUT_POST, 'descripcion_paquete');

                $paquete = new Paquete($ancho, $alto, $profundo, $peso, $descripcion);

                $medidas_paquete = $paquete->get_medidas_paquete();
                $medidas_paquetes = array('paquete1' => $medidas_paquete);

                print_r($medidas_paquetes);

                //$_SESSION['comparar_paquetes'] = $medidas_paquetes;
                echo '<br><h4>Sesion</h4>';
                print_r($_SESSION);
            }

            
            ?>
        </div>
    </body>
</html>
