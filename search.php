<?php
	/* Database connection settings */
	include "connect.php";

 	$coordinates = array();
 	$latitudes = array();
 	$longitudes = array();

	// Select all the rows in the markers table
	$query = "SELECT  `locationLatitude`, `locationLongitude` FROM `map_tab`";
  	$result = $MySQLiconn->query($query) or die('data selection for google map failed: ' . $MySQLiconn->error);

 	while ($row = mysqli_fetch_array($result)) {

		$latitudes[] = $row['locationLatitude'];
		$longitudes[] = $row['locationLongitude'];
		$coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] .','. $row['locationLongitude'] .'),';
	}

	//remove the comaa ',' from last coordinate
	$lastcount = count($coordinates)-1;
	$coordinates[$lastcount] = trim($coordinates[$lastcount], ",");	
?>
<!DOCTYPE html>
<html>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Map | View</title>
</head>
	<body>
	    <div class="container">
	        <br>
	        	<div class="panel panel-success">
     			<div class="panel-heading">Map Settings</div>
     			<div class="panel-body">
     				<form method="POST" action="crud.php">
                    <label class="label-control"> Location Latitude</label>
                 	<input type="text" class="form-control" name="locationLatitude">
                    <label class="label-control"> Location Longitude</label>
                    <input type="text" class="form-control" name="locationLongitude"><br>
               		<button class="btn btn-success pull-right" type="submit" name="editPageInfo">Show Map Location</button>
            	</form>
            	</div>
             <div class="panel-footer">
             		
		              <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
		              	 <a href="index.php" class="btn btn-danger">
     					 <span class="glyphicon glyphicon-step-backward"></span> Back
    				</a>
			    		<button type="submit" id="submit" name="import" class="btn btn-success">RELOAD DATA</button>
				        </form>
		       		 </div>
    			</div>
				<div id="map" style="width: 100%; height: 80vh;"></div>
			</div>
		<script>

			function initMap() {
			  var mapOptions = {
			    zoom: 18,
			    center: {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>}, //{lat: --- , lng: ....}
			    mapTypeId: google.maps.MapTypeId.SATELITE
			  };

			  var map = new google.maps.Map(document.getElementById('map'),mapOptions);

			  var RouteCoordinates = [
			  	<?php
			  		$i = 0;
					while ($i < count($coordinates)) {
						echo $coordinates[$i];
						$i++;
					}
			  	?>
			  ];

			  var RoutePath = new google.maps.Polyline({
			    path: RouteCoordinates,
			    geodesic: true,
			    strokeColor: '#1100FF',
			    strokeOpacity: 1.0,
			    strokeWeight: 10
			  });

			  mark = 'img/mark.png';
			  flag = 'img/flag.png';

			  startPoint = {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>};
			  endPoint = {<?php echo'lat:'.$latitudes[$lastcount] .', lng:'. $longitudes[$lastcount] ;?>};

			  var marker = new google.maps.Marker({
			  	position: startPoint,
			  	map: map,
			  	icon: mark,
			  	title:"Start point!",
			  	animation: google.maps.Animation.BOUNCE
			  });

			  var marker = new google.maps.Marker({
			  position: endPoint,
			   map: map,
			   icon: flag,
			   title:"End point!",
			   animation: google.maps.Animation.DROP
			});

			  RoutePath.setMap(map);
			}

			google.maps.event.addDomListener(window, 'load', initialize);
    	</script>
    	<!--remenber to put your google map key-->
	    <script async defer src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap"></script>
	</body>
</html>