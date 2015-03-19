<?php

require_once './google-api-php-client-master/src/Google/autoload.php';

include 'google_dev_info.php';

session_start();

$authUrl = $client->createAuthUrl();

$isSignedIn = isset($_SESSION['token']);

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>PhotoArtWork2_reverse</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <!-- stylesheets -->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/colour.css" rel="stylesheet" type="text/css" />
  <!-- modernizr enables HTML5 elements and feature detects -->

  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">

<!-- begin header -->
<header>
  <script src="https://apis.google.com/js/client:platform.js" async defer></script>
  <div id="logo"><h1>ALFRED<a href="#">TheSmartMirror</a></h1></div>
  <nav>
    <ul class="sf-menu" id="nav">
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">Who Is Alfred</a></li>
      
      <li class="selected"><a href="blog.php">Sign Up With Google+</a></li>
      <li><a href="contact.html">Contact Us</a></li>
      <?php
      if ($isSignedIn) {
        echo '<li><a class="logout-button" href="logout.php">Log Out</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>
<!-- end header -->