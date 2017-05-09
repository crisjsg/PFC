/* 
 * Aquí si incluye todo el código JavaScript que interactuará con los formularios
 */




/**
 * Variables que se utilicen para el formulario
 */

    // Variables con los mensajes de error
    var errorAnchura = "No has introducido una anchura valida";
    var errorAltura  = "No has introducido una altura";
    var errorProfundidad  = "No has introducido una profundidad valida";
    var errorPeso  = "No has introducido un peso valido";


/**
 * 
 * Métodos que interactuan con los formularios
 *
 */

var quitarPaquete = function (elemento) {
    var paquete = elemento.previousSibling.textContent;
    //Para quitar el paquete de la lista
    elemento.parentElement.parentElement.removeChild(elemento.parentElement);
    borrarDatosSesion(paquete);
};

function borrarDatosSesion(numero_paquete) {

    $.ajax({
        url: "logica/borrar_datos_sesion.php",
        cache: false,
        method: "POST",
        data: "numero_paquete=" + numero_paquete,
        dataType: "text"
    }).done(function () {
        console.log("Se ha borrado el paquete " + numero_paquete);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
    });
}
