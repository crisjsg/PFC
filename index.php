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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/estilos/fuentes.css">
        <link rel="stylesheet" type="text/css" href="/estilos/header.css">
        <link rel="stylesheet" type="text/css" href="/estilos/footer.css">
        <link rel="stylesheet" type="text/css" href="/estilos/botones.css">
        <link rel="stylesheet" type="text/css" href="/estilos/empresas_transportistas.css">
        <link rel="stylesheet" type="text/css" href="/estilos/index.css">
    </head>
    <body>
        <?php
        require_once 'logica/class/Paquete.class.php';
        require_once 'logica/metodos_generales.php';
        require_once 'logica/session.php';
        ?>
        <header>
            <hgroup>
                <h1>Cheapsy Deliver</h1>
                <h2 id="tagline">Comparar, escoger, enviar</h2>
            </hgroup>
            <nav>
                <ul>
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="pages/sobre_nosotros.php">Sobre nosotros</a></li>
                    <li><a href="pages/consejos.php">Consejos</a></li>
                    <li><a href="pages/tecnologias.php">Tecnologías</a></li>
                </ul>
            </nav>
        </header>

        <div id="contenido">
            <div id="formulario">
                <h3>Datos del paquete</h3>
                <form name="formulario_datos_paquetes" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label>Ancho*:
                        <input id="ancho" type="number" name="ancho" placeholder="(cm)" min="1" max="300" oninvalid="setCustomValidity(errorAnchura)" oninput="setCustomValidity('')"  required/>
                    </label>
                    <br>
                    <label >Alto*:
                        <input id="alto" type="number" name="alto" placeholder="(cm)" min="1" max="300" oninvalid="setCustomValidity(errorAltura)" oninput="setCustomValidity('')" required/>
                    </label>
                    <br>
                    <label>Profundo*:
                        <input id="profundo" type="number" name="profundo" placeholder="(cm)" min="1" max="300" oninvalid="setCustomValidity(errorProfundidad)" oninput="setCustomValidity('')" required/>
                    </label>
                    <br>
                    <label>Peso*:
                        <input id="peso" type="number" name="peso" placeholder="(kg)" min="1" max="300" oninvalid="setCustomValidity(errorPeso)" oninput="setCustomValidity('')" required/>
                    </label>
                    <br>
                    <label>Corta descripción del contenido del paquete:
                        <br>
                        <textarea name="descripcion_paquete" rows="2" cols="50" maxlength="50" placeholder="Maximo 50 caracteres"></textarea>
                    </label>
                    <br>
                    <input class="boton" id="boton_enviar" type="submit" value="Añadir paquete" name="paquetes" />
                </form>
            </div>

            <?php
            //Si hay datos en la variable 'paquetes' en el envio por POST haz...

            if (isset($_POST['paquetes']) && ($_POST['paquetes'] != "")) {
                ?>
                <div id="envio">
                    <h3>Paquetes</h3>
                    <div id="paquetes">
                        <?php
                        /*
                         * $_POST['paquetes'] -> Contiene los paquetes que posteriormente se guardaran en 
                         * $_SESSION['comparar_paquetes'] para que luego se realice las peticiones a la API
                         */
                        /**
                         * La idea es que se envien varios paquetes por POST y luego ir guardando en la variable $_SESSION['comparar_paquetes'] cada paquete
                         * por individual para ir añadiendo de uno en uno con sus tamaños en las peticiones que se harán.
                         */
                        //Datos recibidos del formulario
                        $datos_paquetes = filtrar_datos_post($_POST);
                        //Creamos Objeto Paquete
                        $paquete = new Paquete($datos_paquetes['ancho'], $datos_paquetes['alto'], $datos_paquetes['profundo'], $datos_paquetes['peso'], $datos_paquetes['descripcion_paquete']);
                        //Guardamos el array de paquetes una vez tengamos todos los paquetes en la variable sesion
                        $_SESSION['ses_paquetes'][] = $paquete;


                        for ($i = 0; $i < count($_SESSION['ses_paquetes']); $i++) {
                            $medidas_paquete = $_SESSION['ses_paquetes'][$i]->mostrar_medidas_paquete();
                            echo '<div class="paquete"><img class="imagen_paquete" src="../media/img/icono_paquete.png" alt="icono_paquete">'
                            . '<span>'
                            . $medidas_paquete .
                            '</span><span id="numero_paquete">' . $i . '</span><button class="boton" onclick="quitarPaquete(this)">X</button>'
                            . '</div>';
                        }
                        echo '<br>';
                        echo '<a class="boton" id="boton_siguiente" href="pages/datos_personales.php" >Siguiente</a>';
                    } else {
                        $_POST['paquetes'] = NULL;
                        session_destroy();
                    }
                    ?>    
                </div>

            </div>
            <div id="tranportistas">
                <h3>Empresas transportistas</h3>
                <p>Empresas tranportistas con las que trabajamos</p>
                <ul id="empresas">
                    <li id="aramex"><a href="https://www.aramex.com/"><img src="/media/img/img_aramex_indice.png"></a></li>
                    <li id="tnt"><a href="https://www.tnt.com/express/es_es/site/home.html"><img src="/media/img/img_tnt_indice.png"></a></li>
                    <li id="bring"><a href="http://www.bring.com/"><img src="/media/img/img_bring_indice.png"></a></li>
                    <li id="dhl"><a href="http://www.dhl.es/"><img src="/media/img/img_dhl_indice.png"></a></li>
                    <li id="fedex"><a href="https://www.fedex.com/"><img src="/media/img/img_fedex_indice.png"></a></li>
                    <li id="yodel"><a href="http://www.yodel.co.uk/"><img src="/media/img/img_yodel_indice.png"></a></li>
                </ul>
            </div>   
        </div>


        <footer>
            <nav>
                <a href="pages/sobre_nosotros.php">Sobre nosotros</a> -
                <a href="pages/consejos.php">Consejos</a> -
                <a href="pages/tecnologias.php">Tecnologías</a> -
            </nav>
        </footer>

        <script src="/js/formulario.js"></script>


    </body>
</html>