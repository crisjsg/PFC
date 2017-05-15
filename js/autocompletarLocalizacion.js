// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocompletarOrigen, autocompletarDestino;
var componentFormOrigen = {
    //Ciudad
    ciudad_origen: {dato: 'locality', tipo_dato: 'long_name'},
    //Pais
    pais_origen: {dato: 'country', tipo_dato: 'long_name'},
    //Codigo Postal
    codigo_postal_origen: {dato: 'postal_code', tipo_dato: 'short_name'},
    //Calle
    calle_origen:   {dato: 'route', tipo_dato: 'long_name'}
};

var componentFormDestino = {
    //Ciudad
    ciudad_destino: {dato: 'locality', tipo_dato: 'long_name'},
    //Pais
    pais_destino: {dato: 'country', tipo_dato: 'long_name'},
    //Codigo Postal
    codigo_postal_destino: {dato: 'postal_code', tipo_dato: 'short_name'},
    //Calle
    calle_destino: {dato: 'route', tipo_dato: 'long_name'}
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocompletarOrigen = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocompletarOrigen')),
            {types: ['geocode']});

    autocompletarDestino = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocompletarDestino')),
            {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocompletarOrigen.addListener('place_changed', fillInAddressOrigen);
    autocompletarDestino.addListener('place_changed', fillInAddressDestino);
}

function fillInAddressOrigen() {
    // Get the place details from the autocomplete object.
    var place = autocompletarOrigen.getPlace();
    //console.log(place);
    //console.log(place.address_components);
    for (var component in componentFormOrigen) {
        //console.log(component);
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        for (var elemento in componentFormOrigen) {
            if (componentFormOrigen[elemento]["dato"] === addressType) {
                var val = place.address_components[i][componentFormOrigen[elemento]['tipo_dato']];
                document.getElementById(elemento).value = val;
            }
        }

    }
}
function fillInAddressDestino() {
    // Get the place details from the autocomplete object.
    var place = autocompletarDestino.getPlace();
    //console.log(place);
    for (var component in componentFormDestino) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        for (var elemento in componentFormDestino) {
            if (componentFormDestino[elemento]["dato"] === addressType) {
                var val = place.address_components[i][componentFormDestino[elemento]['tipo_dato']];
                document.getElementById(elemento).value = val;
            }
        }

    }
}


