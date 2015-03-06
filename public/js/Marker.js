$(document).ready(function () {
    function CargarInformacio() {
        $.getJSON('/wildflash/public/stylesMap/maps.json', function (data) {
            var userStyle = $('#map_canvas').attr('type_map');
            
            var featureOpts;
            $.each(data.mapes, function (posicio, style) {
         
                if (style.nom == userStyle)
                    featureOpts = style.featureOpt;
            })
            CargarMapa(featureOpts);
        });
    }
    function CargarMapa(featureOpts) {
        var MY_MAPTYPE_ID = 'custom_style';
        var styledMapOptions = {
            name: 'Custom Style'
        };
        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
        var punto = new google.maps.LatLng(0, 0);
        var mapProp = {
            center: punto,
            minZoom: 2,
            maxZoom: 90,
            zoom: 2,
            mapTypeControlOptions: {
                mapTypeId: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]//Tipo de mapa inicial, satélite para ver las pirámides
            },
            mapTypeId: MY_MAPTYPE_ID
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), mapProp);
        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
        PintarMarcadors(map);
    }
    function getNom() {
        var url = document.URL + "";
        var num = url.lastIndexOf('/');
        var name = url.substring(num + 1, url.length);
        return name;
    }
    function PintarMarcadors(map) {
        $.getJSON("json/" + getNom(), function (data) {
            data.forEach(function (e) {
                var latitud = parseFloat(e.latitud);
                var longitud = parseFloat(e.longitud);
                if (!(latitud == 0 && longitud == 0)) {
                    var myLatLng = new google.maps.LatLng(latitud, longitud);
                    var contentString = '<div id="content">' +
                            '<div id="siteNotice">' +
                            '</div>' +
                            '<div id="bodyContent">' +
                            '<h2>' + e.nom + '</h2>' +
                            '<a href="imatge/' + e.id + '"><img class="img-circle" src=http://localhost/wildflash/public/' + e.path + ' width="50" height="50"></img></a>' +
                            '<p> Likes: ' + e.puntuacio + '</p>' +
                            '</div>' +
                            '</div>';
                    var infobubble = new google.maps.InfoWindow({
                        content: contentString
                    });
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        animation: google.maps.Animation.DROP,
                        title: e.nom
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infobubble.open(map, marker);
                    });
                }
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', CargarInformacio);
});