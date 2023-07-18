<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Mech Care Portal</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
<style>
    #locationButton {
      background-color: #2dcc70;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }
    #locationResult {
      margin-top: 20px;
    }


    .large-input {
            width: 700px; /* Adjust the width as needed */
            height: 50px; /* Adjust the height as needed */
            background-color: #DFFADC;
            color: black;
            font-size: 40px;
        }
  </style>
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<div style="text-align: center; padding:30px">
<form action="search.php" method="GET">
        <input  class="large-input" type="text" name="query" placeholder="Enter your search term">
        <input type="submit" value="Search">
    </form>

    </div>



<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

<script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      var locationResult = document.getElementById("locationResult");
      locationResult.innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;
    }

    var locationButton = document.getElementById("locationButton");
    locationButton.addEventListener("click", getLocation);
  </script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>YouTube Search</title>
</head>
<body>

</body>
</html> -->


<?php
// Retrieve the search query from the GET request
$query = $_GET['query'];

// Your YouTube Data API key
$apiKey = 'AIzaSyCzLJb3aJwFESBShENjYmRnEdXdOm9ovJE';

// Construct the YouTube search URL
$searchUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=10&q=' . urlencode($query) . '&key=' . $apiKey;

// Perform a cURL request to get the search results
$curl = curl_init($searchUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Process the response (you can customize this based on your requirements)
$results = json_decode($response, true);

foreach ($results['items'] as $item) {
    // Extract the video ID and title from each search result
    $videoId = $item['id']['videoId'];
    $title = $item['snippet']['title'];

    // Display the video title and embed the video on your page
    echo "<h3>$title</h3>";
    echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/$videoId' frameborder='0' allowfullscreen></iframe>";
}
?>
