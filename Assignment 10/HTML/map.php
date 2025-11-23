<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo isset($PageTitle) ? $PageTitle : 'Injury Tracker'?></title>


</head>


<body>



<h3>Detecting Your IP</h3>

  <script>
    fetch('https://ipinfo.io/json')
    .then(response => response.json())
    .then(data =>{console.log('IP: ', data.ip);
        fetch("map.php", {
          method: 'POST',
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({ip:data.ip})
        })
        .then(r => r.text())
        .then(html => {document.write(html);});
    })
    .catch(error => {
        console.error('Get IP error: ', error);
    });
    
  </script>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);
    $ip = $json['ip'];
    echo "<script> window.location.href = 'map_result.php?ip=" . $ip . "'; </script>";
    exit;

}
?>



</body>
</html>
