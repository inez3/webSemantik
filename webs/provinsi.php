<?php
require 'vendor/autoload.php';
require_once __DIR__ . "/html_tag_helpers.php";
?>
<?php
// pastikan $uri_rdf sesuai dengan setting di komputer Anda
$uri_rdf = 'http://localhost/webs/ini.rdf';
$data = \EasyRdf\Graph::newAndLoad($uri_rdf);
$doc = $data->primaryTopic();
//var_dump($doc); die();
$prov_uri = [];
$prov_comment = [];
$prov_luas = [];
// $prov_data = [];
foreach ($doc->all('owl:sameAs') as $akun) {
	$prov_uri["{$akun->get('rdf:resource')}"] = $akun->get('rdfs:label');
	$prov_comment["{$akun->get('rdf:resource')}"] = $akun->get('rdfs:comment');
	$prov_luas["{$akun->get('rdf:resource')}"] = $akun->get('rdfs:luas');
	$prov_lahir["{$akun->get('rdf:resource')}"] = $akun->get('rdfs:lahir');
	$prov_penduduk["{$akun->get('rdf:resource')}"] = $akun->get('rdfs:penduduk');
	// $prov_data["{$akun->get('rdf:resource')}"] = [
	// 	'label' => $akun->get('rdfs:label'),
	// 	'comment' => $akun->get('rdf:comment')
	// ];
}

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

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

	<!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

	<title>Nusantara Semantic</title>

	<style>
		body {
			background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Flag_map_of_Indonesia.svg/1259px-Flag_map_of_Indonesia.svg.png");
			background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			background-size: 1200px 450px;
		}

		p {
			font-family: 'Roboto Slab', serif;
		}

		#map {
			border: 1px gray solid;
			float: right;
			margin: 0 0 20px 20px;
		}

		th {
			text-align: right
		}

		td {
			padding: 5px;
		}

		#mapid {
			width: 100%;
			height: 324px;
		}
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
							<a class="navbar-brand ml-sm-2" href="provinsi.php"> Nusantara Semantic</a>
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

	<div class="container my-5">
		<h1 style="padding-top:50px; text-align:center; color:#229954; -webkit-text-stroke-width: 0.8px; -webkit-text-stroke-color: #fff;">Nusantara Semantic</h1>
	</div>

	<div class="container my-5">
		<select onchange="hasil()" id="select_province" class="my-5 form-control col-sm-12 mr-sm-1">
			<?php foreach ($prov_uri as $key => $value) : ?>
				<option value="<?= $key ?>" data-comment="<?= $prov_comment[$key] ?>" data-luas="<?= $prov_luas[$key] ?>" data-lahir="<?= $prov_lahir[$key] ?>" data-penduduk="<?= $prov_penduduk[$key] ?>"> <?= $value ?> </option>
				<!-- <option value = "<?= $key ?>"> <?= $value ?> </option> -->
			<?php endforeach ?>
			<!-- <?php
					foreach ($prov_data as $key => $value) :
					?>
				<option value = "<?= $key ?>" data-comment="<?= $prov_comment[$key] ?>"> <?= $value ?> </option> 
				<option value = "<?= $key ?>"> <?= $value ?> </option>
			<?php
					endforeach
			?> -->
		</select>
		<div id="province">
		</div>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		const hasil = () => {
			const selectValue = $('#select_province').val()
			const selectLabel = $('#select_province option:selected').text();
			const selectComment = $('#select_province option:selected').data('comment');
			const selectLuas = $('#select_province option:selected').data('luas');
			const selectLahir = $('#select_province option:selected').data('lahir');
			const selectPenduduk = $('#select_province option:selected').data('penduduk');
			$.post("nilai.php", {
				provinsi_uri: selectValue
			}, function(data) {
				console.log(data);
				const contain = `
			<div class="container card card-body bg-default my-5 shadow" style="padding-top:50px; padding-right:50px; padding-left:50px; padding-bottom:50px;">
			<h1> ${selectLabel} </h1><hr><br>
			<label class="my-5"> <img src= "${data.gambar}"></label><br>
			<label>Nama Provinsi 	<label style="padding-left:50px;">:</label> ${selectLabel}</label>
			<label>Luas Daerah   	<label style="padding-left:66px;">:</label> ${selectLuas}</label>
			<label>Diresmikan		<label style="padding-left:74px;">:</label> ${selectLahir}</label>
			<label>Jumlah Penduduk <label style="padding-left:25px;">:</label> ${selectPenduduk}</label>
			<label>Kode Area 		<label style="padding-left:80px;">:</label> ${data.kodearea}</label>
			<label>Nama ibukota   <label style="padding-left:51px;">:</label> ${data.cityname}</label>
			<label>Mayor 			<label style="padding-left:108px;">:</label> ${data.mayor}</label>
			<label class="my-5" style="text-align:justify;">Deskripsi <label style="padding-left:90px;">:</label> <br><br>${selectComment}</label>
			<label>Lokasi <label style="padding-left:117px;">:</label> <div class="my-3" id='mapid'></div></label>
			<label class="my-3">Link Wikipedia 	<label style="padding-left:50px;">:</label> <a href="${data.wiki}" target="_blank">${data.wiki}</a></label><br>
			<a href="provinsi.php" class="btn btn-primary my-5">Kembali</a>
			</div>

			`
				$('#province').html(contain)
				var mymap = L.map('mapid').setView([data.lat, data.long], 13);
				L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					maxZoom: 18,
					attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, ' +
						'<a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, ' +
						'Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>',
					id: 'mapbox/streets-v11',
					tileSize: 512,
					zoomOffset: -1
				}).addTo(mymap)

				L.marker([data.lat, data.long]).addTo(mymap)
					.bindPopup("<b>" + data.cityname + "</b>").openPopup();


			}, 'json').done(function() {
				console.log('SUCCESS')
			}).fail(function() {
				console.log('FAIL')
			})
		}
	</script>
</body>

</html>