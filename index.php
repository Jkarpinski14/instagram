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

//Isset dertermines if a variable is set and not NULL
if (isset($_GET['code'])){
	$code = (($_GET['code']));
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID, 
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
//cURL is a library we use in PHP that calls to other APIs
//cURL lets you make PHP requests, such as 'get' & means client URL
	$curl = curl_init($url); //Setting a cURL session, put in URL because that's where we're getting our data fron
	curl_setopt($curl, CURLOPT_POST, true); //CURLOPT used to set numerous options, and then the return vakue for those options
	curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); //Setting the POSTFIELDS to the array setup we created
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Set equal to one because we are getting strings back
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //In live work-production, we want to set this to true

$result = curl_exec($curl); //Stores all the above information in this variable
curl_close();

$results = json_decode($result, true);
echo $results['user']['username'];
}

else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>AppAcademy API</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="linkdiv">
		<!--Creating a login for people to go and give approval for our web app to access their Instagram account-->
		<!--After getting approval, we are going to have the information so that we can play with it-->
		<!--Once client_id and redirect_uri were set to blank, you'll have to echo it out from the constants-->
		<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Login</a> <!--Response will always be code-->
	</div>
	<script type="text/javascript" src=""></script>
</body>
</html>
<?php 
}
?>