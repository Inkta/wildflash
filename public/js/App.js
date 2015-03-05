var map;
var geocoder;
var punto;
var adreca;
var infowindow;
var localitzador;
var arraypunts = [""];
var contentString;
var urlimatge;
var URL;
var imgURL;
var titolImatge;
var MY_MAPTYPE_ID = 'custom_style';
var featureOpts;

function localitza(e, i) {
    localitzador = e;
    urlimatge = i;
}


var styledMapOptions = {
    name: 'Custom Style'
};


geocoder = new google.maps.Geocoder();
function initialize() {
    geocoder = new google.maps.Geocoder();
    punto = new google.maps.LatLng(42.2649229, 2.9502337); //ubicación del Plaza Central de Tikal, Guatemala
    isTouchDevice();
}

function isTouchDevice() {
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

  

    } else {


        featureOpts =
                [
                    {
                        "featureType": "all",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "saturation": 36
                            },
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "13"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-44"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-33"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-41"
                            },
                            {
                                "weight": 1.2
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-26"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-23"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-34"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-27"
                            },
                            {
                                "weight": 0.2
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-41"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-22"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c8102e"
                            },
                            {
                                "lightness": "-29"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#b40e29"
                            },
                            {
                                "lightness": "0"
                            }
                        ]
                    }
                ]


        var styledMapOptions = {
            name: 'Custom Style'
        };
        
        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
        geocoder = new google.maps.Geocoder();
        punto = new google.maps.LatLng(42.2649229, 2.9502337); //ubicación del Plaza Central de Tikal, Guatemala
        var myOptions = {
            zoom: 12, //nivel de zoom para poder ver de cerca.
            center: punto,
            mapTypeControlOptions: {
                mapTypeId: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]//Tipo de mapa inicial, satélite para ver las pirámides
            },
            mapTypeId: MY_MAPTYPE_ID
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        console.log(map);
        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);


    }
}


function pedirPosicion(pos) {
    var myLatlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    var centro = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    map.setCenter(centro);
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    var image = '../js/ammap/images/wildflash-icon-1.png';
    var marker = new google.maps.Marker({
        position: myLatlng,
        icon: image
    });

    marker.setMap(map);


    geocoder.geocode({'latLng': myLatlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (localitzador == 0) {
                adreca = results[1].formatted_address;
            }
            if (localitzador == 1) {
                adreca = results[0].formatted_address;
            }
            contentString = '<p><img width="150px" src="' + urlimatge + '"/><p><p style="color:grey"><strong>' + titolImatge + '</strong></p><p>' + adreca + '</p>';

            infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            infowindow.open(map, marker);


            google.maps.event.addListener(marker, 'click', function () {

                infowindow.open(map, marker);
            });


            // guardarImatge();

        } else {
            alert("Geocoder failed due to: " + status);
        }

    });
}



/******Tercera funcio******/

function geolocalizame(r, i) {
    localitza(r, i);
    navigator.geolocation.getCurrentPosition(pedirPosicion);
}

function guardarImatge() {
    var fotonova = document.createElement('li');
    fotonova.setAttribute('style', 'width:315px');
    fotonova.setAttribute('class', 'list-group-item');
    document.body.appendChild(fotonova);
    fotonova.innerHTML = "<span class='glyphicon glyphicon-picture'> " + adreca;

}


/*******Segona funcio******/
function captura() {
    titolImatge = document.getElementById('titolimatge').value;
    document.body.removeChild(document.getElementById('form_show'));
    geolocalizame(0, imgURL);
}

/******Primera funcio******/
function form_show() {

    var imatge = document.getElementById('foto');
    if (imatge.files.length > 0) {
        URL = window.URL || window.webkitURL
        imgURL = URL.createObjectURL(imatge.files[0]);
    }

    var a = document.createElement('div');
    a.setAttribute('id', 'form_show');
    a.setAttribute('class', 'form-group');
    var tit = document.createElement('p');
    tit.innerHTML = "<span style='color:white'>WILD<strong>FLASH</strong></span> <img src='../js/ammap/images/wildflash-icon-1.png'/>";
    tit.setAttribute('style', 'text-align:center');
    var imatge_show = document.createElement('img');
    imatge_show.setAttribute('src', imgURL);
    imatge_show.setAttribute('width', '239px');
    var b = document.createElement('input');
    b.setAttribute('type', 'text');
    b.setAttribute('placeholder', 'Títol Imatge');
    b.setAttribute('id', 'titolimatge');
    b.setAttribute('class', 'form-control formu');
    var c = document.createElement('button');
    c.setAttribute('id', 'cap');
    /*captura*/
    c.setAttribute('onclick', 'captura()');
    c.setAttribute('class', 'btn btn-success');
    c.innerHTML = "Guardar <span class='glyphicon glyphicon-floppy-disk'></span>";
    var d = document.createElement('button');
    d.setAttribute('id', 'borr');
    d.setAttribute('onclick', 'borrarImatge()');
    d.setAttribute('class', 'btn btn-danger');
    d.innerHTML = "Cancelar <span class='glyphicon glyphicon-remove-circle'></span>";

    a.appendChild(tit);
    a.appendChild(imatge_show);
    a.appendChild(b);
    a.appendChild(c);
    a.appendChild(d);

    document.body.appendChild(a);




}   