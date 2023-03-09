<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('location: ./pages/sign-in.php');
}else {
  header('location: home.php');
}

?>

