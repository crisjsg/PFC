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
        <style>
            #numero_paquete{
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
        require_once 'logica/class/Paquete.class.php';
        require_once 'logica/metodos_generales.php';
        require_once 'logica/session.php';
        ?>
        <h1>Cheapsy Deliver</h1>
        <p>Comparar, escoger, enviar</p>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="pages/quienes_somos.php">Quienes somos</a></li>
                <li><a href="pages/contacto.php">Contacto</a></li>
            </ul>
        </nav>

        <div id="formulario">
            <h3>Formulario</h3>
            <form name="formulario_datos_paquetes" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>Ancho*:
                    <input type="number" name="ancho" placeholder="(cm)" min="1" max="300" oninvalid="setCustomValidity(errorAnchura)" oninput="setCustomValidity('')"  required/>
                </label>
                <br>
                <label>Alto*:
                    <input type="number" name="alto" placeholder="(cm)" min="1" max="300" oninvalid="setCustomValidity(errorAltura)" oninput="setCustomValidity('')" required/>
                </label>
                <br>
                <label>Profundo*:
                    <input type="number" name="profundo" placeholder="(cm)" min="1" max="300" oninvalid="setCustomValidity(errorProfundidad)" oninput="setCustomValidity('')" required/>
                </label>
                <br>
                <label>Peso*:
                    <input type="number" name="peso" placeholder="(kg)" min="1" max="300" oninvalid="setCustomValidity(errorPeso)" oninput="setCustomValidity('')" required/>
                </label>
                <br>
                <label>Corta descripción del contenido del paquete:
                    <br>
                    <textarea name="descripcion_paquete" rows="2" cols="50" maxlength="50" placeholder="Maximo 50 caracteres"></textarea>
                </label>
                <br>
                <input type="submit" value="Añadir paquete" name="paquetes" />
            </form>

            <?php
            //Si hay datos en la variable 'paquetes' en el envio por POST haz...

            if (isset($_POST['paquetes']) && ($_POST['paquetes'] != "")) {
                ?>
                <div id="envio">
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
                    //Datos recibidos del formulario
                    $datos_paquetes = filtrar_datos_post($_POST);
                    //Creamos Objeto Paquete
                    $paquete = new Paquete($datos_paquetes['ancho'], $datos_paquetes['alto'], $datos_paquetes['profundo'], $datos_paquetes['peso'], $datos_paquetes['descripcion_paquete']);
                    //Guardamos el array de paquetes una vez tengamos todos los paquetes en la variable sesion
                    $_SESSION['ses_paquetes'][] = $paquete;


                    for ($i = 0; $i < count($_SESSION['ses_paquetes']); $i++) {
                        $medidas_paquete = $_SESSION['ses_paquetes'][$i]->mostrar_medidas_paquete();
                        echo '<div>'
                        . '<span>'
                        . $medidas_paquete .
                        '</span><span id="numero_paquete">' . $i . '</span><button onclick="quitarPaquete(this)">X</button>'
                        . '</div>';
                    }
                    echo '<br>';
                    echo '<a id="boton_siguiente" href="pages/datos_personales.php" >Siguiente</a>';
                    var_dump($_SESSION['ses_paquetes']);
                } else {
                    $_POST['paquetes'] = NULL;
                    session_destroy();
                    //$_SESSION['ses_paquetes'] = NULL;
                }
                ?>
            </div>
        </div>
        <div id="tranportistas">
            <h3>Empresas transportistas</h3>
            <p>Empresas tranportistas con las que comparamos precios</p><hr>
            <ul id="empresas">
                <!-- Idea: Poner iconos de las emprsas en color grisaceo y con el hover consiga el color de su logo -->
                <li><a href="https://www.aramex.com/">ARAMEX</a></li>
                <li><a href="https://www.tnt.com/express/es_es/site/home.html">TNT</a></li>
                <li><a href="http://www.bring.com/">Bring</a></li>
                <li><a href="http://www.dhl.es/">DHL</a></li>
                <li><a href="https://www.fedex.com/">FedEx</a></li>
                <li><a href="http://www.yodel.co.uk/">Yodel</a></li>
            </ul>
        </div>
        
        
        <!-- 
               Idea: Poner al final de la página con footer (habría que sopesar si habrá un footer) un mini formulario 
               de sugerencias para la página por parte del cliente con los campos: correo, sugerencia y el boton de envío. Esto lo recibiría a mi correo.
               
        -->
        <footer>
            <nav>
                <a href="pages/quienes_somos.php">Quienes somos</a> -
                <a href="pages/tecnologias.php">Tecnologias</a> -
                <a href="pages/contacto.php">Contactanos</a>
            </nav>
        </footer>

        <script src="/js/formulario.js"></script>


    </body>
</html>