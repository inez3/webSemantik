<?php

    require_once realpath(__DIR__.'/..')."/vendor/autoload.php";
    require_once __DIR__."/html_tag_helpers.php";

    \EasyRdf\RdfNamespace::setDefault('og');
?>
<html>
<head>
  <title>Ebay</title>
  <style type="text/css">
    body { font-family: sans-serif; }
    dt { font-weight: bold; }
    .image { float: right; margin: 10px;}
  </style>
</head>
<body>
  
<?php
  $doc = \EasyRdf\Graph::newAndLoad('https://www.ebay.com/itm/Leica-X-U-Typ-113-Waterproof-Digital-Camera-EXCELLENT-CONDITION/143839127339');
  if  ($doc->image) {
    echo content_tag('img', null, array('src'=>$doc->image, 'class'=>'image'));
  }
?>

<h3>Leica X-U (Typ 113) Waterproof Digital Camera - EXCELLENT CONDITION</h3>
<dl>
  <dt>Nama web:</dt> <dd><?= $doc->site_name ?></dd>
  <dt>Laman:</dt> <dd><?= link_to($doc->url) ?></dd>
  <dt>Judul:</dt> <dd><?= $doc->title ?></dd>
  <dt>Deskripsi:</dt> <dd><?= $doc->description ?></dd>

</dl>

</body>
</html>
