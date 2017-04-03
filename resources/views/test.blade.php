<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>MarkerClusterer v3 Example</title>

    <style type="text/css">
        body {
            margin: 0;
            padding: 10px 20px 20px;
            font-family: Arial;
            font-size: 16px;
        }

        #map-container {
            padding: 6px;
            border-width: 1px;
            border-style: solid;
            border-color: #ccc #ccc #999 #ccc;
            -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
            width: 600px;
        }

        #map {
            width: 600px;
            height: 400px;
        }

    </style>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="/js/data.json"></script>
    <script type="text/javascript" src="/js/markerclusterer.js"></script>

    <script type="text/javascript">
        function initialize() {
            var center = new google.maps.LatLng(37.4419, -122.1419);

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 3,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var markers = [];
            for (var i = 0; i < 100; i++) {
                var dataPhoto = data.photos[i];
                var latLng = new google.maps.LatLng(dataPhoto.latitude,
                    dataPhoto.longitude);
                var marker = new google.maps.Marker({
                    position: latLng
                });
                markers.push(marker);
            }
            var markerCluster = new MarkerClusterer(map, markers);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
<h3>A simple example of MarkerClusterer (100 markers)</h3>
<div id="map-container"><div id="map"></div></div>
</body>
</html>
