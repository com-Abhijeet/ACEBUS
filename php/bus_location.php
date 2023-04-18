
<!-- <?php 
$bus_id = $_GET['bus_id'];
session_start();
?> -->
<!DOCTYPE html>
<html>
<head>
  <title>User and Bus Location Map</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpADpK3ACC_2nD6PUSflatI67EQiIZXc&libraries=places"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet"/>
  <link href="styles.css"rel="stylesheet"/>
  <script src="script.js" defer></script>
  <script>
    var map;

    function initMap() {
      // Create a map centered at user's location
      navigator.geolocation.getCurrentPosition(function(position) {
        var userLatLng = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map = new google.maps.Map(document.getElementById('map'), {
          center: userLatLng,
          zoom: 13,
          disableDefaultUI : true,
        //   mapId:"roadmap"
        //   mapId:"cd486193df0c0628"
          mapId:"9269fc931e5741d6"

        });

        // Add a marker for user's location
        var userMarker = new google.maps.Marker({
          position: userLatLng,
          map: map,
          title: 'Your Location'
        });

        // Prompt user to enter bus ID
        const urlParams = new URLSearchParams(window.location.search);

        // Get the value of the 'bus_id' parameter from the URL
        const busId = urlParams.get('bus_id');

        // var busId = prompt('Enter Bus ID:');
        if (busId !== null && busId !== '') {
          // Make AJAX request to fetch bus location based on bus ID
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              var busData = JSON.parse(xmlhttp.responseText);
              if (busData && busData.latitude && busData.longitude) {
                // Add a marker for bus location
                var busLatLng = {
                  lat: parseFloat(busData.latitude),
                  lng: parseFloat(busData.longitude)
                };
                var busMarker = new google.maps.Marker({
                  position: busLatLng,
                  map: map,
                  title: 'Bus Location (ID: ' + busId + ')',
                icon: 'https://img.icons8.com/external-flaticons-flat-flat-icons/64/null/external-bus-digital-nomading-relocation-flaticons-flat-flat-icons-3.png',
                // icon: 'https://maps.google.com/mapfiles/ms/icons/bus.png',
                // title: "FontAwesome SVG Marker"
                });
              } else {
                alert('Bus not found for the given ID');
              }
            }
          };
          xmlhttp.open('GET', 'get_bus_location.php?id=' + busId, true);
          xmlhttp.send();
        }
      }, function(error) {
        alert('Error getting user location: ' + error.message);
      });
    }
  </script>
</head>
<body onload="initMap()">
<nav class="navbar">
        <div class="brand-title">AceBUS</div>
          <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </a>
          <div class="navbar-links">
            <ul>
            <?php if(isset($_SESSION["username"])) { ?>
              <li><a href="#">Welcome <?php echo $_SESSION["username"]; ?></a></li>
              <li><a href="#">Home</a></li>
              <li><a href="/ACEBUS/php/book_pass.php">Book a pass</a></li>
              
              <li><a href="logout.php">Logout</a></li>
              <?php } else { ?>
              <li><a href="login.php">login</a></li>
              <?php } ?>
            </ul>
        </div>
</nav>

  <div id="map" style="height: 600px;"></div>
</body>
</html>
