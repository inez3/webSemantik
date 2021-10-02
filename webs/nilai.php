<?php
 require 'vendor/autoload.php';
$prov_uri = $_POST['provinsi_uri'];

\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dct', 'http://purl.org/dc/terms/');
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#');

$sparql_endpoint = 'https://dbpedia.org/sparql';
$sparql = new \EasyRdf\Sparql\Client($sparql_endpoint);

$sparql_query = " 
SELECT distinct * WHERE {
<".$prov_uri."> dbp:seat ?ibukota;
          foaf:isPrimaryTopicOf ?wiki. 
    			OPTIONAL {?ibukota dbp:name ?cityname.}
    			?ibukota dbo:areaCode ?kodearea.
    			?ibukota geo:lat ?lat.
				?ibukota geo:long ?long.
				OPTIONAL { ?ibukota dbo:politicalLeader ?pemimpin .
                        ?pemimpin dbo:personName ?mayor. }
<".$prov_uri.">dbo:thumbnail ?gambar. 
}
";

$result = $sparql->query($sparql_query);
    // var_dump($result[0]);

    // ambil detail joe dari $result sparql
    $detail = [];
    foreach ($result as $row) {
      $detail = [
        'ibukota'=>$row->ibukota ? $row->ibukota->__toString() : null,
        'wiki'=>$row->wiki ? $row->wiki->__toString() : null,
        'gambar'=>$row->gambar ?$row->gambar->__toString() :null,
        'cityname'=> $row->cityname ? $row->cityname->getValue() : null,
        'kodearea'=> $row->kodearea ? $row->kodearea->getValue() : null,
        'lat'=>$row->lat ? $row->lat->getValue() : null,
        'long'=> $row->long ? $row->long->getValue() : null,
        'pemimpin'=> $row->pemimpin ? $row->pemimpin->__toString() : null,
        'mayor'=> $row->mayor ? $row->mayor->getValue() : null,
      ];
      
      break;
    }

echo json_encode($detail);
?>
