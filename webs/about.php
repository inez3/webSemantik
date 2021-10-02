<?php
    require 'vendor/autoload.php';
    require_once __DIR__."/html_tag_helpers.php";

    \EasyRdf\RdfNamespace::setDefault('og');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="alternate" type="application/rdf+xml" href="https://theculturetrip.com/asia/indonesia/articles/11-things-you-should-know-about-indonesian-culture/.rdf">
    <link rel="alternate" type="text/turtle" href="https://theculturetrip.com/asia/indonesia/articles/11-things-you-should-know-about-indonesian-culture/.ttl">
    <link rel="alternate" type="application/json" href="https://theculturetrip.com/asia/indonesia/articles/11-things-you-should-know-about-indonesian-culture/.json">

    <link rel="alternate" type="application/rdf+xml" href="https://www.britannica.com/place/Indonesia.rdf">
    <link rel="alternate" type="text/turtle" href="https://www.britannica.com/place/Indonesia.ttl">
    <link rel="alternate" type="application/json" href="https://www.britannica.com/place/Indonesia.json">

    <link rel="alternate" type="application/rdf+xml" href="https://www.indonesia.travel/id/id/general-information/about-indonesia.rdf">
    <link rel="alternate" type="text/turtle" href="https://www.indonesia.travel/id/id/general-information/about-indonesia.ttl">
    <link rel="alternate" type="application/json" href="https://www.indonesia.travel/id/id/general-information/about-indonesia.json">

    <link rel="alternate" type="application/rdf+xml" href="https://www.holidify.com/pages/facts-about-indonesia-2438.html.rdf">
    <link rel="alternate" type="text/turtle" href="https://www.holidify.com/pages/facts-about-indonesia-2438.html.ttl">
    <link rel="alternate" type="application/json" href="https://www.holidify.com/pages/facts-about-indonesia-2438.html.json">

    <link rel="alternate" type="application/rdf+xml" href="https://www.wowshack.com/25-interesting-facts-about-indonesia-you-might-not-know/.rdf">
    <link rel="alternate" type="text/turtle" href="https://www.wowshack.com/25-interesting-facts-about-indonesia-you-might-not-know/.ttl">
    <link rel="alternate" type="application/json" href="https://www.wowshack.com/25-interesting-facts-about-indonesia-you-might-not-know/.json">

    <link rel="alternate" type="application/rdf+xml" href="https://www.lotusbungalows.com/news/10-facts-about-indonesia-you-might-not-know/.rdf">
    <link rel="alternate" type="text/turtle" href="https://www.lotusbungalows.com/news/10-facts-about-indonesia-you-might-not-know/.ttl">
    <link rel="alternate" type="application/json" href="https://www.lotusbungalows.com/news/10-facts-about-indonesia-you-might-not-know/.json">

    <link rel="alternate" type="application/rdf+xml" href="https://usindo.org/information-on-u-s-and-indonesia/about-indonesia/.rdf">
    <link rel="alternate" type="text/turtle" href="https://usindo.org/information-on-u-s-and-indonesia/about-indonesia/.ttl">
    <link rel="alternate" type="application/json" href="https://usindo.org/information-on-u-s-and-indonesia/about-indonesia/.json">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

	<title>Nusantara Semantic</title>

	<style>
		body{
			background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_map_of_Indonesia.svg/1259px-Flag_map_of_Indonesia.svg.png");
			background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			background-size: 1200px 450px;
		}

        p{
			font-family: 'Roboto Slab', serif;
		}

        #map
        {
            border: 1px gray solid;
            float: right;
            margin: 0 0 20px 20px;
        }
        th { text-align: right }
        td { padding: 5px; }

        #mapid { width:100%; height: 324px; }
	</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="https://cdn.countryflags.com/thumbs/indonesia/flag-round-250.png" alt="logo" width="20" height="20">
            <a class="navbar-brand ml-sm-2 pull-left" href="provinsi.php"> Nusantara Semantic</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <!-- <li>
                        <a class="navbar-brand" href="provinsi.php"> Nusantara Semantic</a>
                    </li> -->
                    <li>
                        <a class="nav-link" href="provinsi.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>
                    <li>
                        <a class="nav-link" href="about.php"><i class="fa fa-home" aria-hidden="true"></i> About</a>
                    </li>
                    <!-- <li>
                        <a class="nav-link" href="searchfix.php">Result</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

<?php 
    $doc = \EasyRdf\Graph::newAndLoad('https://theculturetrip.com/asia/indonesia/articles/11-things-you-should-know-about-indonesian-culture/');
    $doc2 = \EasyRdf\Graph::newAndLoad('https://www.britannica.com/place/Indonesia');
    $doc3 = \EasyRdf\Graph::newAndLoad('https://www.indonesia.travel/id/id/general-information/about-indonesia');
    $doc4 = \EasyRdf\Graph::newAndLoad('https://www.holidify.com/pages/facts-about-indonesia-2438.html');
    $doc5 = \EasyRdf\Graph::newAndLoad('https://www.wowshack.com/25-interesting-facts-about-indonesia-you-might-not-know/');
    $doc6 = \EasyRdf\Graph::newAndLoad('https://www.lotusbungalows.com/news/10-facts-about-indonesia-you-might-not-know/');
    $doc7 = \EasyRdf\Graph::newAndLoad('https://usindo.org/information-on-u-s-and-indonesia/about-indonesia/');
?>

<div class="container card card-body bg-default my-5 shadow" style="padding-top:50px; padding-right:50px; padding-left:50px; padding-bottom:50px;">
    <br>
    <h3 style="font-weight: bold">Tentang Nusantara Semantic</h3>
    <hr>

    <label class="my-3" style="text-align:justify;">Nusantara Semantic merupakan website yang menyajikan beberapa informasi mengenai provinsi di Indonesia dengan menerapkan web semantik.</label>

    <br>
    <h3 style="font-weight: bold; padding-top:50px;">Artikel Luar Negeri Mengenai Indonesia</h3>
    <hr>

    <br>
    <br>

    <dl>
        <div class="col-sm-12">
            <dt>Title: <?= $doc->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc->description ?> <a href="<?= $doc->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
            <dt>Title: <?= $doc2->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc2->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc2->description ?> <a href="<?= $doc2->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
            <dt>Title: <?= $doc6->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc6->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc6->description ?> <a href="<?= $doc6->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
            <dt>Title: <?= $doc3->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc3->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc3->description ?> <a href="<?= $doc3->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
            <dt>Title: <?= $doc4->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc4->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc4->description ?> <a href="<?= $doc4->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
            <dt>Title: <?= $doc5->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc5->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc5->description ?> <a href="<?= $doc5->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
            <dt>Title: <?= $doc7->title ?></dt><br>
            <dd class="my-3"><img src="<?= $doc7->image ?>" style="width:750px; length:650px;" alt="image"></dd>
            <dt class="my-3" style="padding-top:50px;">Description:</dt><dd><label style="text-align:justify;"><?= $doc7->description ?> <a href="<?= $doc7->url ?>" target="_blank">Read More</a></dd></label><br>
            <br>
			<a href="provinsi.php" class="btn btn-primary my-3">Kembali</a>
        </div>
    </dl>
</div>

</body>
</html>
