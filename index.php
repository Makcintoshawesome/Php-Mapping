
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
     			<div class="panel-heading">PHP Developer Trial Project</div>
     			<div class="panel-body">
     				<center>
     			<div class="row">
     				<div class="col-md-6">
     				   <button onclick="getlocation();" class="btn btn-info">
     					 <span class="glyphicon glyphicon-map-marker"></span> Show your Current Location
    				</button>
    				</div>
    				<div class="col-md-6">
    					 <a href="search.php" class="btn btn-danger">
     					 <span class="glyphicon glyphicon-search"></span> Pin Your Desired Map
    				</a>
    				</div>
    			</div>	
    			</center>
            	</div>
    			</div>
    			<div id="demo" style="width: 100%; height: 80vh;"></div> 
    			 <script src="https://maps.google.com/maps/api/js?sensor=false"> </script> 
        
        <script type="text/javascript"> 
        function getlocation(){ 
            if(navigator.geolocation){ 
                navigator.geolocation.getCurrentPosition(showPos, showErr); 
            }
            else{
                alert("Sorry! your Browser does not support Geolocation API")
            }
        } 
        //Showing Current Poistion on Google Map
        function showPos(position){ 
            latt = position.coords.latitude; 
            long = position.coords.longitude; 
            var lattlong = new google.maps.LatLng(latt, long); 
            var myOptions = { 
                center: lattlong, 
                zoom: 15, 
                mapTypeControl: true, 
                navigationControlOptions: {style:google.maps.NavigationControlStyle.SMALL} 
            } 
            var maps = new google.maps.Map(document.getElementById("demo"), myOptions); 
            var markers = 
            new google.maps.Marker({position:lattlong, map:maps, title:"You are here!"}); 
        } 

        //Handling Error and Rejection
             function showErr(error) {
              switch(error.code){
              case error.PERMISSION_DENIED:
             alert("User denied the request for Geolocation API.");
              break;
             case error.POSITION_UNAVAILABLE:
             alert("USer location information is unavailable.");
            break;
            case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
           case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
           }
        }        </script> 
			
			</div>
		
	</body>
</html>