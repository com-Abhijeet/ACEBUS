<!DOCTYPE html>
<html>
<head>
	<title>Bus Staff</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
	<link rel="stylesheet" href="/ACEBUS/css/bus_staff.css">
	<style type="text/css">
		
	</style>
</head>
<body>
	<nav>
		AceBus
	</nav>
	<h1>Bus Staff Page</h1>
	<form method="post" action="update_location.php">
		<label for="bus_id">Bus ID:</label>
		<input type="text" id="bus_id" name="bus_id" value="<?php echo isset($_POST['bus_id']) ? htmlspecialchars($_POST['bus_id'], ENT_QUOTES) : ''; ?>" required><br><br>
		<label for="location">Location:</label>
		<input type="text" id="location" name="location" required><br><br>
		<button type="submit" class="button">Update Location</button>

		<div id="map"></div>
		<input type="hidden" id="latitude" name="latitude">
		<input type="hidden" id="longitude" name="longitude">
		<input type="hidden" id="geocoded_address" name="geocoded_address">
	</form>
<div class="container">
  	<div class="box"><a href="/ACEBUS/php/verifyticket.php" > Verify <br> Ticket</a></div>
	<div class="box"><a href="/ACEBUS/php/book_pass.php"> Verify <br> Pass</a></div>
	<div class="box"><a href="//php/index.php"> Bus <br> Details</a> </div>
  	<div class="box"><a href="//php/index.php"> Ticket <br> history</a></div>
</div>
	<!-- <script>
        // // Update the location every 2 minutes
        // setInterval(updateLocation, 120000); // 120000 milliseconds = 2 minutes

		if (navigator.geolocation) {
			navigator.geolocation.getcurrentPosition(function(position) {
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				var latlng = {lat: latitude, lng: longitude};
				var map = new google.maps.Map(document.getElementById('map'), {
					center: latlng,
					zoom: 18
				});
				var marker = new google.maps.Marker({
					position: latlng,
					map: map,
					title: 'Your location'
				});
				google.maps.event.addListener(map, 'click', function(event) {
					marker.setPosition(event.latLng);
					document.getElementById('latitude').value = event.latLng.lat();
					document.getElementById('longitude').value = event.latLng.lng();
					geocodeLatLng(event.latLng);
				});
				document.getElementById('latitude').value = latitude;
				document.getElementById('longitude').value = longitude;
				geocodeLatLng(latlng);
                setInterval(updateLocation, 120000);
			}, function() {
				alert('Error: The Geolocation service failed.');
			});
		} else {
			alert('Error: Your browser doesn\'t support geolocation.');
		}

		function geocodeLatLng(latlng) {
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({'location': latlng}, function(results, status) {
				if (status === 'OK') {
					if (results[0]) {
						document.getElementById('location').value = results[0].formatted_address;
						document.getElementById('geocoded_address').value = results[0].formatted_address;
					} else {
						alert('No results found');
					}
				} else {
					alert('Geocoder failed due to: ' + status);
				}
			});
		}
	</script> -->

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpADpK3ACC_2nD6PUSflatI67EQiIZXc&libraries=places"></script>
<script>
    // Update the location every 2 minutes
    setInterval(updateLocation, 120000); // 120000 milliseconds = 2 minutes

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var latlng = {lat: latitude, lng: longitude};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 18,
				disableDefaultUI: true,
				zoomControl: false,
				mapTypeControl: false,
				scaleControl: false,
				streetViewControl: false
				
            });
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Your location'
            });
            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
                geocodeLatLng(event.latLng);
            });
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            geocodeLatLng(latlng);
        }, function() {
            alert('Error: The Geolocation service failed.');
        });
    } else {
        alert('Error: Your browser doesn\'t support geolocation.');
    }

    function geocodeLatLng(latlng) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'location': latlng}, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    document.getElementById('location').value = results[0].formatted_address;
                    document.getElementById('geocoded_address').value = results[0].formatted_address;
                } else {
                    alert('No results found');
                }
            } else {
                alert('Geocoder failed due to: ' + status);
            }
        });
    }

    function updateLocation() {
        var bus_id = document.getElementById('bus_id').value;
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;
        var geocoded_address = document.getElementById('geocoded_address').value;

        $.post('update_location.php', {
            bus_id: bus_id,
            latitude: latitude,
            longitude: longitude,
            geocoded_address: geocoded_address
        }, function(data, status) {
            console.log('Location updated successfully.');
        });
    }
</script>

</body>
</html>
