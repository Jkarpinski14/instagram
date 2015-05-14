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

//Function that is going to connect to Instagram
function connectToInstagram($url){
	$ch = curl_init(); //'CH' is a curl handle returned by curl_init()

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result; //Can be called over and over again when we want to connect to Instagram
}

//Function to get userID since userName doesn't allow us to get pictures
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID; //The s indicates a secure connection
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data']['0']['id'];
}

//Function to print images onto screen
function printImages($userID){
	$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5'; //Requests last 5 pics
	$instagramInfo = connectToInstagram($url); //Connecting to Instagram
	$results = json_decode($instagramInfo, true); //Creating a local variable to decode json information
	//Parse through the information one by one
	foreach ($results['data'] as $items) {
		$image_url = $items['images']['low_resolution']['url']; //Going to go through all of my results and give myself back the URL of those pictures because we want to save it in the PHP server
		echo '<img src=" '.$image_url.'"/><br/>';
	}
}


//Isset dertermines if a variable is set and not NULL
if (isset($_GET['code'])){
	$code = $_GET['code'];
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
curl_close($curl);

$results = json_decode($result, true);

$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);
}

else{
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device width, initial-scale=1.0">
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