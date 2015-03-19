<?php

$client = new Google_Client();

$client->setApplicationName("API Project");
$client->setClientId('805034040388-erokn7fetmrl9id1romu3o75m7tbnpqp.apps.googleusercontent.com');
$client->setClientSecret('3oYfgw9AHDcdFshZDuBy04bM');

$client->setRedirectUri('http://localhost/smart-mirror/connect.php');
$client->setAccessType('offline');
$client->setScopes(array(
  'https://www.googleapis.com/auth/calendar'
));

?>