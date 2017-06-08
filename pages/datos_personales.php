<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cheapsy Deliver</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/estilos/fuentes.css">
        <link rel="stylesheet" type="text/css" href="/estilos/header.css">
        <link rel="stylesheet" type="text/css" href="/estilos/botones.css">
        <link rel="stylesheet" type="text/css" href="/estilos/datos_personales.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">

    </head>
    <body>
        <?php
        require_once '../logica/class/Paquete.class.php';
        require_once '../logica/session.php';
        ?>
        <header>
            <hgroup>
                <h1>Cheapsy Deliver</h1>
                <h2 id="tagline">Comparar, escoger, enviar</h2>
            </hgroup>
            <nav>
                <ul>
                    <li><a href="/index.php">Home</a></li>
                </ul>
            </nav>
        </header>
        <div id="contenido">
            <h2 class="titulo_pagina">¡Estas a un paso de comparar!</h2>
            <p class="titulo_pagina">Solo necesitamos esta información para concretar un pelín más y mostrar un precio más preciso para tu envío.</p>
            <form id="formulario_datos_usuario" name="formulario_datos_usuario" action="resultado.php" method="POST">
                <fieldset id="origen">
                    <h3>Origen</h3>
                    <label>Dirección: <br>
                    <input id="autocompletarOrigen" class="direccion" placeholder="Introduce tu dirección de origen" type="text" onkeydown='selecting_key(event);'>
                    </label><br>
                    <label>Ciudad*: <input class="ciudad" type="text" name="ciudad_origen" id="ciudad_origen" disabled="true" required/> </label><br>
                    <label>Código postal*: <input type="text" name="codigo_postal_origen" id="codigo_postal_origen" disabled="true" required/></label><br>
                    <label>Calle: <input class="calle" type="text" name="calle_origen" id="calle_origen" disabled="true"/></label><br>
                    <label>País: <input class="pais"type="text" name="pais_origen" id="pais_origen" disabled="true"/></label><br>
                </fieldset>
                <fieldset id="destino">
                    <h3>Destino</h3>
                    <label>Dirección: <br>
                    <input id="autocompletarDestino" class="direccion" placeholder="Introduce tu dirección de destino" type="text" onkeydown='selecting_key(event);'>
                    </label><br>
                    <label>Ciudad*: <input class="ciudad" type="text" name="ciudad_destino" id="ciudad_destino" disabled="true"/></label> <br>
                    <label>Código postal*: <input type="text" name="codigo_postal_destino" id="codigo_postal_destino" disabled="true"/></label><br>
                    <label>Calle: <input class="calle" type="text" name="calle_destino" id="calle_destino" disabled="true"/></label><br>
                    <label>País: <input class="pais" type="text" name="pais_destino" id="pais_destino" disabled="true"/></label><br>
                </fieldset>
                <fieldset id="datos_personales">
                    <h3>Datos personales</h3>
                    <label>Nombre: <input id="nombre" type="text" name="nombre" /></label><br>
                    <label>Apellido: <input id="apellido" type="text" name="apellido"/></label><br>
                    <label>Telefono: <input id="telefono" type="tel" name="telefono" /></label><br>
                    <label>Email remitente: <input id="email_remitente" type="email" name="email_remitente" /></label><br>
                    <label>Email destinatario: <input type="email" name="email_destinatario" /></label><br>
                </fieldset>
                <input id="boton_buscar" class="boton" name="submit" type="submit" value="Buscar">
            </form>  
        </div>


        <script src="../js/autocompletarLocalizacion.js"></script>
        <script src="/js/formulario.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm-E7KVUA2jQbyCwMxsyHjD30BpNTONgA&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>
