<?php

function p($s) {
  echo "$s\n";
}

  require_once 'google-api-php-client/src/apiClient.php';
  require_once 'google-api-php-client/src/contrib/apiPlusService.php';
session_start();

$id = '107689480800024855038';

$client = new apiClient();
$client->setApplicationName("Google+ PHP Application");
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client->setClientId('805034040388-erokn7fetmrl9id1romu3o75m7tbnpqp.apps.googleusercontent.com');
$client->setClientSecret('3oYfgw9AHDcdFshZDuBy04bM');
$client->setRedirectUri('http://127.0.0.1');
$client->setDeveloperKey('AIzaSyC_35JwD4LFrv7PuYyjKPiH7xNyir8JDao');
$plus = new apiPlusService($client);

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['access_token'])) {
  $client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) {
  $me = $plus->people->get($id);
  $optParams = array('maxResults' => 100);
  $activities = $plus->activities->listActivities($id, 'public', $optParams);
  // The access token may have been updated lazily.
  $_SESSION['access_token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}

p($me)


?>



<!doctype html>
  <html>
  <head><link rel='stylesheet' href='style.css' /></head>
  <body>
  <header><h1>Google+ Sample App</h1></header>
  <div class="box">

<?php if(isset($me) && isset($activities)): ?>
  <div class="me">
  <p><a rel="me" href="<?php echo $me['url'] ?>"><?php print $me['displayName'] ?></a></p>
  <p><?php print $me['tagline'] ?></p>
  <p><?php print $me['aboutMe'] ?></p>
  <div><img src="<?php echo $me['image']['url']; ?>?sz=82" /></div>
  </div>
  <div class="activities">Your Activities:
  <?php foreach($activities['items'] as $activity): ?>
  <div class="activity">
  <p><a href="<?php print $activity['url'] ?>"><?php print $activity['title'] ?></a></p>
  </div>
  <?php endforeach ?>
  </div>
  <?php endif ?>
  <?php
  if(isset($authUrl)) {
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
  } else {
  //print "<a class='logout' href='?logout'>Logout</a>";
  }

  ?>
  </div>
  </body>
  </html>