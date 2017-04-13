<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            width: 100%;
            height: 768px;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
<div id="map"></div>
<script type="text/javascript">
    //<![CDATA[

    var customIcons = {
        restaurant: {
            icon: 'https://mt.googleapis.com/vt/icon/name=icons/onion/166-purple-pushpin.png&scale=1.0',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        },
        bar: {
            icon: 'http://files.gamebanana.com/img/ico/games/css_icon.png',
            shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
        }
    };

    function initMap() {
        var cluster = [];
        var map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(48.6724821, 19.696058),
            zoom: 7,
            mapTypeId: 'satellite'
        });
        var infowindow = new google.maps.InfoWindow();

        // Change this depending on the name of your PHP file
        downloadUrl("/data", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
                var name = markers[i].getAttribute("name");
                var address = markers[i].getAttribute("address");
                var type = markers[i].getAttribute("type");
                var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                var html = "<b>" + name + "</b> <br/>" + address;
                var icon = customIcons[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    icon: icon.icon,
                    shadow: icon.shadow
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {

                        //infowindow.setContent(markers[i].getAttribute("name"));
                        infowindow.setContent(
                        "<strong>názov miesta:</strong>"+markers[i].getAttribute('name')+"<br>"+
                        "<strong>ulica:</strong>"+markers[i].getAttribute('address')+"<br>"+
                        "<img src="+/images/+"fotky/"+markers[i].getAttribute('image')+">"

                        );
                        console.log(markers[i]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                cluster.push(marker);
            }
            var mc = new MarkerClusterer(map,cluster);
        });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
        });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}

    //]]>
</script>


<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANgYNnUb9ebTTtB8RWgx0zHr4Nl-llHrI&callback=initMap">

</script>

</body>
</html>