/* 
 * Aquí si incluye todo el código JavaScript que interactuará con los formularios
 */

var quitarPaquete = function (elemento) {
    var paquete = elemento.previousSibling.textContent;
    //Para quitar el localizador de la lista
    elemento.parentElement.parentElement.removeChild(elemento.parentElement);
    borrarDatosSesion(paquete);
};

function borrarDatosSesion(numero_paquete) {

    $.ajax({
        url: "borrar_datos_sesion.php",
        cache: false,
        method: "POST",
        data: "paquete=" + numero_paquete,
        dataType: "text"
    }).done(function (paquete) {
        console.log("Se ha borrado el paquete " + numero_paquete);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
    });
}