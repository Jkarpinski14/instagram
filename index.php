<?php
//Configuration for our PHP server
set_time_limit(0);
ini_set('default_socket_timeout', 300); //Sets it so that it goes to 300 seconds
session_start(); //Commences the session

//Make constants using define
define('client_ID', 'bb199a42cd21404fadf74e1564d369b5');
define('client_Secret', '21dec25dae844aa5b8edad461cd4803d');
define('redirectURI', 'http://localhost:8888/instagram/index.php');
define('ImageDirectory', 'pics/'); //Saves pictures to the server
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<!--Creating a login for people to go and give approval for our web app to access their Instagram account-->
	<!--After getting approval, we are going to have the information so that we can play with it-->
	<a href="https:api.instagram/oauth/authorize/?client_id=<?php echo client_ID?>&redirect_uri=<?php echo redirectURI?>&response_type=code">LOGIN</a> <!--Response will always be code-->
	<script type="text/javascript" src=""></script>
</body>
</html>