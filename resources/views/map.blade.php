<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Reality</title>
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
        .big {
        width:300px;
            display: inline-block;
            vertical-align: middle;
        }

        .small {
        width:200px;
            display: inline-block;
            vertical-align: middle;
        }

        .balicek {
            display: flex; /* equal height of the children */
            background: #eee;
        }

        .popis {
            flex: 1; /* additionally, equal width */
            text-align:left;
            padding: 1em;

        }
        .obrazok {
            flex: 1; /* additionally, equal width */
            text-align:center;
            padding: 1em;

        }

        .centerer {
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }

        .readmore {
            -moz-box-shadow:inset 0px 1px 0px 0px #cf866c;
            -webkit-box-shadow:inset 0px 1px 0px 0px #cf866c;
            box-shadow:inset 0px 1px 0px 0px #cf866c;
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #d0451b), color-stop(1, #bc3315));
            background:-moz-linear-gradient(top, #d0451b 5%, #bc3315 100%);
            background:-webkit-linear-gradient(top, #d0451b 5%, #bc3315 100%);
            background:-o-linear-gradient(top, #d0451b 5%, #bc3315 100%);
            background:-ms-linear-gradient(top, #d0451b 5%, #bc3315 100%);
            background:linear-gradient(to bottom, #d0451b 5%, #bc3315 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d0451b', endColorstr='#bc3315',GradientType=0);
            background-color:#d0451b;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            border-radius:3px;
            border:1px solid #942911;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:13px;
            padding:6px 24px;
            text-decoration:none;
            text-shadow:0px 1px 0px #854629;
        }
        .readmore:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bc3315), color-stop(1, #d0451b));
            background:-moz-linear-gradient(top, #bc3315 5%, #d0451b 100%);
            background:-webkit-linear-gradient(top, #bc3315 5%, #d0451b 100%);
            background:-o-linear-gradient(top, #bc3315 5%, #d0451b 100%);
            background:-ms-linear-gradient(top, #bc3315 5%, #d0451b 100%);
            background:linear-gradient(to bottom, #bc3315 5%, #d0451b 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bc3315', endColorstr='#d0451b',GradientType=0);
            background-color:#bc3315;
        }
        .readmore:active {
            position:relative;
            top:1px;
        }

    </style>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
            mapTypeId: 'roadmap'
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

                        var name = markers[i].getAttribute("name");
                        var address = markers[i].getAttribute("address");
                        var size = markers[i].getAttribute('size');
                        var id_reality = markers[i].getAttribute('id_reality');
                        infowindow.setContent(

                                @include('content')


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

{!! Form::open(array('route' => 'filter', 'class' => 'form')) !!}
<div class="form-group">
    {!! Form::label('Max Price') !!}
    {!! Form::text('price', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'price')) !!}
</div>
<div class="form-group">
    {!! Form::submit('submit',
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

</body>

</html>