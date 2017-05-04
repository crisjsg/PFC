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
        <?php require_once 'logica/Session.php'; ?>
        <h2>¡Estas a un paso de comparar!</h2>
        <!-- Idea: 
            Información del remitente y destinatario (podría ponerse esto en unas "Migas de pan" para el proceso de entrada de los datos en los formularios
        -->
        <p>Solo necesitamos esta información principalmente para concretar más y mostrar un precio más preciso para tu envío.</p>
        <form name="formulario_datos" action="resultado.php" method="POST">
            <!-- 
            Idea 1: Conseguir mediante JavaScript que muestre o chequee si el codigo postal que se introduce es valido para la ciudad
            Idea 2: En la API no del todo obligatorio ambos inputs, con uno basta pero por lo menos debe de haber uno. Chequear con JS si hay uno con datos y si lo está 
            no es necesario que pongan el otro.
            -->
            <h3>Origen</h3>
            Ciudad*: <input type="text" name="ciudad_origen" /> <br>
            Código postal*: <input type="text" name="codigo_postal_origen" /><br>
            Calle: <input type="text" name="calle_origen" /><br>
            
            <h3>Destino</h3>
            Ciudad*: <input type="text" name="ciudad_destino" /> <br>
            Código postal*: <input type="text" name="codigo_destino" /><br>
            Calle: <input type="text" name="calle_postal_destino" /><br>
            
            <!-- 
            Idea: realizar una comprobación de si está el valor en Sí o No, en caso de que sí lo esté poner el campo "email" como obligatorio. 
            Pensamiento: Quizás esto no sea al final aplicable al objetivo de la aplicación ya que para qué servirá el envio de lo que pone en el formulario 
                        (datos personales) si en verdad el cliente tiene como objetivo solo ver los diferentes precios. Pensar más detenidamente esto
            -->
            
            <h3>Datos personales</h3>
            Nombre: <input type="text" name="nombre" value="" /><br>
            Apellido: <input type="text" name="apellido"/><br>
            Telefono: <input type="tel" name="telefono" /><br>
            Email remitente: <input type="email" name="email_remitente" /><br>
            Email destinatario: <input type="email" name="email_destinatario" /><br>
            <br>
            ¿Quieres que te lo enviemos por correo? 
            Sí<input type="radio" name="eleccion" value="si" style="margin-right: 5px;">
            No<input type="radio" name="eleccion" value="no" checked> <br>
            <input type="submit" value="Comparar">
        </form>
    </body>
</html>
