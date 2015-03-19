<?php

session_start();

if (isset($_SESSION['token'])) {
  unset($_SESSION['token']);
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/smart-mirror/logout_google.php';
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  die;
}

?>

