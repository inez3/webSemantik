<?php

    require_once realpath(__DIR__.'/..')."/vendor/autoload.php";
    require_once __DIR__."/html_tag_helpers.php";

    \EasyRdf\RdfNamespace::set('postcode', 'http://data.ordnancesurvey.co.uk/ontology/postcode/');
    \EasyRdf\RdfNamespace::set('sr', 'http://data.ordnancesurvey.co.uk/ontology/spatialrelations/');
    \EasyRdf\RdfNamespace::set('eg', 'http://statistics.data.gov.uk/def/electoral-geography/');
    \EasyRdf\RdfNamespace::set('ag', 'http://statistics.data.gov.uk/def/administrative-geography/');
    \EasyRdf\RdfNamespace::set('osag', 'http://data.ordnancesurvey.co.uk/ontology/admingeo/');
?>
<html>
<head>
  <title>Pencarian Lokasi Kode Pos UK</title>
  <style type="text/css" media="all">
    #map
    {
        border: 1px gray solid;
        float: right;
        margin: 0 0 20px 20px;
    }
    th { text-align: right }
    td { padding: 5px; }

    #mapid { width:640; height: 320; }
  </style>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

   <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
</head>
<body>
<h3>Pencarian Kode Pos UK</h3>

<?= form_tag() ?>
  <?= text_field_tag('postcode', 'W1A 1AA', array('size'=>10)) ?>
  <?= submit_tag() ?>
<?= form_end_tag() ?>

<?php
    if (isset($_REQUEST['postcode'])) {
        $postcode = str_replace(' ', '', strtoupper($_REQUEST['postcode']));
        $docuri = "http://data.ordnancesurvey.co.uk/doc/postcodeunit/$postcode";
        $graph = \EasyRdf\Graph::newAndLoad($docuri);

        // Get the first resource of type PostcodeUnit
        $res = $graph->get('postcode:PostcodeUnit', '^rdf:type');
        if ($res) {
            $lat = $res->get('geo:lat');
            $long = $res->get('geo:long');

            print "<div id='mapid'></div>";
            $map_script = "var mymap = L.map('mapid').setView([51.505, -0.09], 13);
	                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		              maxZoom: 18,
		              attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, ' +
			                      '<a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, ' +
			                         'Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>',
		              id: 'mapbox/streets-v11',
		              tileSize: 512,
		              zoomOffset: -1
	               }).addTo(mymap);

	               L.marker([" . $lat . ", " . $long . "]).addTo(mymap)
		             .bindPopup(\"<b>" . $postcode . "</b>\").openPopup();";

            print "<script>" . $map_script . "</script>";

            print "<table id='facts'>\n";
            print "<tr><th>Longitude:</th><td>" . $res->get('geo:long') . "</td></tr>\n";
            print "<tr><th>Latitude:</th><td>" . $res->get('geo:lat') . "</td></tr>\n";
            print "<tr><th>Easting:</th><td>" . $res->get('sr:easting') . "</td></tr>\n";
            print "<tr><th>Northing:</th><td>" . $res->get('sr:northing') . "</td></tr>\n";
            print "<tr><th>District:</th><td>" . $res->get('postcode:district')->label() . "</td></tr>\n";
            print "<tr><th>Ward:</th><td>" . $res->get('postcode:ward')->label() . "</td></tr>\n";
            print "</table>\n";

            print "<div style='clear: both'></div>\n";
        }

        //print $graph->dump();
    }
?>
</body>
</html>
