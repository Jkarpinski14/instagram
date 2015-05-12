<?php
//Configuration for our PHP server
set_time_limit(0);
ini_set('default_socket_timeout', 300); //Sets it so that it goes to 300 seconds
session_start(); //Commences the session

//Make constants using define
define('client_id', 'bb199a42cd21404fadf74e1564d369b5')
define('client_secret', '21dec25dae844aa5b8edad461cd4803d')
define('redirectURI', 'http://localhost:8888/instagram/index.php')
define('ImageDirectory', 'pics/')
?>


<!--CLIENT INFO
CLIENT ID bb199a42cd21404fadf74e1564d369b5
CLIENT SECRET 21dec25dae844aa5b8edad461cd4803d
WEBSITE URL http://localhost:8888/instagram.index.php
REDIRECT URI http://localhost:8888/instagram.index.php-->