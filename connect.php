<?php
require_once './google-api-php-client-master/src/Google/autoload.php';

$client = new Google_Client();

session_start();

// user profile id. need to get this from client
$id = '107689480800024855038';

$client->setApplicationName("Google+ PHP Application");
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client->setClientId('805034040388-erokn7fetmrl9id1romu3o75m7tbnpqp.apps.googleusercontent.com');
$client->setClientSecret('3oYfgw9AHDcdFshZDuBy04bM');
// $client->setRedirectUri('http://127.0.0.1/connect.php');
$client->setRedirectUri('postmessage');
$client->setDeveloperKey('AIzaSyC_35JwD4LFrv7PuYyjKPiH7xNyir8JDao');
$plus = new Google_Service_Plus($client);

if (!isset($_POST['auth_code'])) {
  die('No code yo');
}

// this is auth code sent from client-side
$auth_code = $_POST['auth_code'];

// get oauth token
$client->authenticate($auth_code);
$access_token = $client->getAccessToken();

// if ($client->getAccessToken()) {
//   $me = $plus->people->get($id);
//   $optParams = array('maxResults' => 100);
//   $activities = $plus->activities->listActivities($id, 'public', $optParams);
//   // The access token may have been updated lazily.
//   $_SESSION['access_token'] = $client->getAccessToken();
// } else {
//   $authUrl = $client->createAuthUrl();
// }

// print_r($client);

// print_r($plus);

?>