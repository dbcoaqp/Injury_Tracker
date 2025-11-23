<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo isset($PageTitle) ? $PageTitle : 'Injury Tracker'?></title>
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</head>

<body>

<div class="container">
    <nav>
      <div class="logo">
        <a href="index.html">
          <img src="img/logo.jpg" alt="Logo" class="logo-img">
          <span class="logo-text">InjuryTracker</span>
        </a>
      </div>

      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Stat</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="login.php">Maintenance</a></li>
        <li><a href="search.html">Search</a></li>
      </ul>

      <div class="search-container">
        <input type="text" class="search-input" placeholder="Search...">
        <button class="search-button">🔍</button>
      </div>

      <div class="buttons">
        <a href="#" class="login"><span>Log in</span></a>
        <a href="a_Users.php" class="register">Register</a>
      </div>
    </nav>


<?php
$ip = $_GET['ip'] ?? null;
if(!$ip){
    die("No IP provided");
}
$url = "https://ipinfo.io/{$ip}/json";
$response = file_get_contents($url);
$data = json_decode($response, true);
$loc = explode(",", $data["loc"]);
$lat = $loc[0];
$lon = $loc[1];
?>

<h3>IP: <?= htmlspecialchars($ip) ?></h3>

<div id="map" style="height: 400px;"></div>

<script>
    console.log("Map element:", document.getElementById("map"));

    var lat = <?= $lat ?>;
    var lon = <?= $lon ?>;
    var ip  = "<?= $ip ?>";

    var map = L.map('map').setView([lat, lon], 10);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([lat, lon]).addTo(map);
    marker.bindPopup("IP: " + ip).openPopup();
</script>


</div>  
<footer>
  <div class="footer-container">
    <p>&copy; 2025 Injury Tracker | Database Project</p>

    <p class="footer-links">
      <a href="index.html">Home</a> |
      <a href="#">News</a> |
      <a href="#">History</a> |
      <a href="#">Reports</a> |
      <a href="imprint.html">Imprint</a>
    </p>
  </div>
</footer>

</body>
</html>