<?php
require_once './google-api-php-client-master/src/Google/autoload.php';

include 'google_dev_info.php';

function pre_dump($obj) {
  echo '<pre>';
  print_r($obj);
  echo '</pre>';
}

session_start();

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  die;
}

// Step 1:  The user has not authenticated we give them a link to login
if (!isset($_SESSION['token'])) {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);

  $service = new Google_Service_Calendar($client);

  $calendarList  = $service->calendarList->listCalendarList();;
  while(true) {
    foreach ($calendarList->getItems() as $calendarListEntry) {
      // echo '<b><br>this is a calendar list entry!<br></b>';
      // echo $calendarListEntry->getSummary()."<br>\n";
    }
    $pageToken = $calendarList->getNextPageToken();
    if ($pageToken) {
      $optParams = array('pageToken' => $pageToken);
      $calendarList = $service->calendarList->listCalendarList($optParams);
    } else {
      break;
    }
  }

  $calendar = $service->calendar;
  $eventData = $service->events->listEvents("primary");

  // if no data folder, make it
  $dataDirectory = 'calendar_data';
  if (!file_exists($dataDirectory)) {
    mkdir($dataDirectory, 0777, true);
  }

  $userDataDirectory = $dataDirectory . DIRECTORY_SEPARATOR . $eventData->summary;
  // make folder for user
  if (!file_exists($userDataDirectory)) {
    mkdir($userDataDirectory, 0777, true);
  }

  $calendarName = 'primary';
  // make file for primary calendar
  $f = fopen($userDataDirectory . DIRECTORY_SEPARATOR . "$calendarName.dat", "w");
  fwrite($f, json_encode($service->events->listEvents("primary")));
  fclose($f);

  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/smart-mirror/blog.php';
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
?>