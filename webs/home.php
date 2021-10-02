<?php
    require_once realpath(__DIR__.'/')."/vendor/autoload.php";
    require_once __DIR__."/html_tag_helpers.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

	<title>Tubes WS</title>

	<style>
		body{
			background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_map_of_Indonesia.svg/1259px-Flag_map_of_Indonesia.svg.png");
			background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			background-size: 1200px 450px;
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
            <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Logo_Semantic_Web.svg/1024px-Logo_Semantic_Web.svg.png" alt="semantic web" width="40" height="40"> -->
            <!-- <a class="navbar-brand" href="home.php"> Tubes WS</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a class="navbar-brand" href="home.php"> Tubes WS</a>
                    </li>
                    <li>
                        <a class="nav-link" href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>
                    <!-- <li>
                        <a class="nav-link" href="searchfix.php">Result</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

	<div class="container my-5">
		<h1 style="padding-top:50px; text-align:center; color:#229954; -webkit-text-stroke-width: 0.8px; -webkit-text-stroke-color: #fff;">Nusantara Semantic</h1>
	</div>

	<form class="container my-5" style="padding-top:50px;" method="post" action="hasil.php">
		<div class="form-inline">
			<input type="text" class="form-control col-sm-12 mr-sm-1" style="opacity:0.9;" name="search" placeholder="Search here ...">
			<!-- <button type="submit" class="btn btn-primary col-sm-1" id="button"><i class="fa fa-search" aria-hidden="true"></i> Cari</button> -->
		</div>
	</form>

</body>
</html>