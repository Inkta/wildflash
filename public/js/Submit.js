function clickSubmit() {
    $('#formulariImatge').append('<p id="loading"> Loading please wait...</p>');
    var lat;
    var long;
    function success(position) {
        lat = position.coords.latitude;
        long = position.coords.longitude;
        crearInputs(lat, long);
    }

    function error() {
        lat = 0;
        long = 0;
        crearInputs(lat, long);
    }

    var options = {
        enableHighAccuracy: true,
        timeout: 15000,
        maximumAge: 9000
    };

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error, options);
    } else {
        alert("No geolocation available in your Web Browser");
    }
}


function crearInputs(lat, long) {
    $('<input />').attr('type', 'hidden')
            .attr('name', "latitud")
            .val(lat)
            .appendTo('#formulariImatge');
    $('<input />').attr('type', 'hidden')
            .attr('name', "longitud")
            .val(long)
            .appendTo('#formulariImatge');
    $('#loading').remove();
    $('#enviar').removeAttr('type', 'hidden');
    $('#enviar').attr('type', 'submit');
}