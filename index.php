<?php
session_start();

if (isset($_SESSION['user_session'])) {

  if ($_SESSION['user_session']['role']=='directeur') {
    header('location: besoins.php');
  } else {

    header('location: home.php');
  }


} else {

  header('location: sign-in.php');

}

?>