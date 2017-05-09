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
                margin: 0 0 0 10px;
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
        <?php require_once 'logica/session.php'; ?>
        <header>
            <h1>Cheapsy Deliver</h1>
            <h2>Comparar, escoger, enviar</h2>
        </header>
        <h2>¡Estas a un paso de comparar!</h2>
        <!-- Idea: 
            Información del remitente y destinatario (podría ponerse esto en unas "Migas de pan" para el proceso de entrada de los datos en los formularios
        -->
        <p>Solo necesitamos esta información principalmente para concretar más y mostrar un precio más preciso para tu envío.</p>
        <form name="formulario_datos_usuario" action="resultado.php" method="POST">
            <!-- 
            Idea 1: Conseguir mediante JavaScript que muestre o chequee si el codigo postal que se introduce es valido para la ciudad
            Idea 2: En la API no del todo obligatorio ambos inputs, con uno basta pero por lo menos debe de haber uno. Chequear con JS si hay uno con datos y si lo está 
            no es necesario que pongan el otro.
            -->
            <h3>Origen</h3>
            Dirección: <br>
            <input id="autocompletarOrigen" placeholder="Introduce tu dirección de origen" type="text">
            <br>
            Ciudad*: <input type="text" name="ciudad_origen" id="ciudad_origen" disabled="true"/> <br>
            Código postal*: <input type="text" name="codigo_postal_origen" id="codigo_postal_origen" disabled="true"/><br>
            Calle: <input type="text" name="calle_origen" id="calle_origen" disabled="true"/><br>
            País: <input type="text" name="pais_origen" id="pais_origen" disabled="true"/><br>

            <h3>Destino</h3>
            Dirección: <br>
            <input id="autocompletarDestino" placeholder="Introduce tu dirección de destino" type="text">
            <br>
            Ciudad*: <input type="text" name="ciudad_destino" id="ciudad_destino" disabled="true"/> <br>
            Código postal*: <input type="text" name="codigo_postal_destino" id="codigo_postal_destino" disabled="true"/><br>
            Calle: <input type="text" name="calle_destino" id="calle_destino" disabled="true"/><br>
            País: <input type="text" name="pais_destino" id="pais_destino" disabled="true"/><br>

            <!-- 
            Idea: realizar una comprobación de si está el valor en Sí o No, en caso de que sí lo esté poner el campo "email" como obligatorio. 
            Pensamiento: Quizás esto no sea al final aplicable al objetivo de la aplicación ya que para qué servirá el envio de lo que pone en el formulario 
                        (datos personales) si en verdad el cliente tiene como objetivo solo ver los diferentes precios. Pensar más detenidamente esto
            -->
            <h3>Datos personales</h3>
            Nombre: <input type="text" name="nombre" /><br>
            Apellido: <input type="text" name="apellido"/><br>
            Telefono: <input type="tel" name="telefono" /><br>
            Email remitente: <input type="email" name="email_remitente" /><br>
            Email destinatario: <input type="email" name="email_destinatario" />
            <br> 
                        <!--
            <br>
            ¿Quieres que te lo enviemos por correo? 
            Sí<input type="radio" name="eleccion" value="si" style="margin-right: 5px;">
            No<input type="radio" name="eleccion" value="no" checked> <br>
            -->
            <input name="submit" type="submit" value="Comparar">
        </form>

        <script src="/js/autocompletarLocalizacion.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm-E7KVUA2jQbyCwMxsyHjD30BpNTONgA&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>
