<?php
    require_once realpath(__DIR__.'/..')."/vendor/autoload.php";//artinya kita mundur ke direktori sblmnya 
    require_once __DIR__."/html_tag_helpers.php";
?>
<html>
<head>
  <title>Membaca File RDF</title>
</head>
<body>

<?php
  $data = \EasyRdf\Graph::newAndLoad('http://localhost/webs/satriani.rdf');
  $doc = $data->primaryTopic();
?>

<h3>Profil</h3>
Nama			: <?= $doc->get('foaf:name') ?><br>
Nama depan		: <?= $doc->get('foaf:givenName') ?><br>
Nama belakang	: <?= $doc->get('foaf:familyName') ?><br>
Gender 			: <?= $doc->get('foaf:gender') ?><br>
Homepage		: <a href="<?= $doc->get('foaf:homepage') ?>">http://www.satriani.com/</a> <br>

Gambar			: <br> <img src="<?= $doc->get('foaf:img') ?>"><br>
Interest		: <?php
				  $text = '';

    			  foreach ($doc->all('foaf:knows') as $akun) { 
    			  	$text .= $akun->get('rdfs:label') .
        		  ', ';
    			  }
    			  echo substr ($text, 0, -2);
				  ?><br>
Knows			: <?= $doc->get('foaf:knows') 
						  ->get('rdfs:label')
						  ?><br>
Current project	: <?= $doc->get('foaf:currentProject') 
				  		  ->get('foaf:name')
						  ?><br>
Past project	: <?= $doc->get('foaf:pastProject') 
				  		  ->get('foaf:name')
						  ?><br>
<hr>

<h3>Media Sosial</h3>
<?php
    foreach ($doc->all('foaf:account') as $akun) {
        echo $akun->get('foaf:page');
        echo '<br>';
    }
?>

</body>
</html>
