<?php
//Configuration for our PHP server
set_time_limit(0);
ini_set('default_socket_timeout', 300); //Sets it so that it goes to 300 seconds
session_start(); //Commences the session

//Make constants using define
define('clientID', 'bb199a42cd21404fadf74e1564d369b5');
define('clientSecret', '21dec25dae844aa5b8edad461cd4803d');
define('redirectURI', 'http://localhost/appacademyapi/index.php');
define('ImageDirectory', 'pics/'); //Saves pictures to the server

//isset dertermines if a variable is set and not NULL
if (isset($_GET['code'])){
	$code = (($_GET['code']));
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID, 
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>AppAcademy API</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<!--Creating a login for people to go and give approval for our web app to access their Instagram account-->
	<!--After getting approval, we are going to have the information so that we can play with it-->
	<div class="linkdiv">
		<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Login</a> <!--Response will always be code-->
	</div>
	<script type="text/javascript" src=""></script>
</body>
</html>