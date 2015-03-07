$(document).ready(function() {
    function success(position) {
        lat = position.coords.latitude;
        long = position.coords.longitude;
        var latImatge = $('#comollegar').attr('lat');
        var longImatge = $('#comollegar').attr('long');
        $('#comollegar').append('<a href="https://www.google.es/maps/dir/'+lat+','+long+'/'+latImatge+','+longImatge+'/@'+lat+','+long+',18z">Como llegar?</a>');
    }

    function error() {
        $('#comollegar').append('<p>Como llegar no disponible</p>');
    }

    var options = {
        enableHighAccuracy: true,
        timeout: 15000,
        maximumAge: 9000
    };

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error, options);
    } else {
        $('#comollegar').append('<p>Como llegar no disponible</p>');
    }
    
});
