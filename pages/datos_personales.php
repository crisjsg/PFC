<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cheapsy Deliver</title>
        <meta charset="utf-8">
        <style>
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0 0 10px 10px;
                padding: 0;
            }
        </style>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
        <style>
            #autocompletarDestino, #autocompletarOrigen{
                width: 200px;
            }
        </style>

    </head>
    <body>
        <?php 
        require_once '../logica/class/Paquete.class.php';
        require_once '../logica/session.php'; 
        
        ?>
        <header>
            <h1>Cheapsy Deliver</h1>
            <h2>Comparar, escoger, enviar</h2>
        </header>
        <h2>¡Estas a un paso de comparar!</h2>
        <p>Solo necesitamos esta información para concretar un pelín más y mostrar un precio más preciso para tu envío.</p>
        <form name="formulario_datos_usuario" action="resultado.php" method="POST">
            <h3>Origen</h3>
            Dirección: <br>
            <input id="autocompletarOrigen" placeholder="Introduce tu dirección de origen" type="text" onkeydown='selecting_key(event);'>
            <br>
            Ciudad*: <input type="text" name="ciudad_origen" id="ciudad_origen" disabled="true" required/> <br>
            Código postal*: <input type="text" name="codigo_postal_origen" id="codigo_postal_origen" disabled="true" required/><br>
            Calle: <input type="text" name="calle_origen" id="calle_origen" disabled="true"/><br>
            País: <input type="text" name="pais_origen" id="pais_origen" disabled="true"/><br>

            <h3>Destino</h3>
            Dirección: <br>
            <input id="autocompletarDestino" placeholder="Introduce tu dirección de destino" type="text" onkeydown='selecting_key(event);'>
            <br>
            Ciudad*: <input type="text" name="ciudad_destino" id="ciudad_destino" disabled="true"/> <br>
            Código postal*: <input type="text" name="codigo_postal_destino" id="codigo_postal_destino" disabled="true"/><br>
            Calle: <input type="text" name="calle_destino" id="calle_destino" disabled="true"/><br>
            País: <input type="text" name="pais_destino" id="pais_destino" disabled="true"/><br>

            <h3>Datos personales</h3>
            Nombre: <input type="text" name="nombre" /><br>
            Apellido: <input type="text" name="apellido"/><br>
            Telefono: <input type="tel" name="telefono" /><br>
            Email remitente: <input type="email" name="email_remitente" /><br>
            Email destinatario: <input type="email" name="email_destinatario" />
            <br>
            <input name="submit" type="submit" value="Buscar">
        </form>

        <script src="../js/autocompletarLocalizacion.js"></script>
        <script src="/js/formulario.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm-E7KVUA2jQbyCwMxsyHjD30BpNTONgA&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>
