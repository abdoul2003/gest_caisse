<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $mdp = $_POST['mdp'];
  $mdp2 = $_POST['mdp2'];

  $query2 = "SELECT * FROM users WHERE username='$username'";
  $result2 = select($query2);
  $result2 = mysqli_fetch_assoc($result2);

  function verifierMdp($mdp, $mdp2) {
    if ($mdp==$mdp2) {
      return true;
    } else {
      return false;
    }
  }

  if (!$result2) {

    if (verifierMdp($mdp, $mdp2)) {

      $req = "INSERT INTO users(id,username,mdp) VALUES(NULL,'$username','$mdp')";
      $res = insert($req);

      $_SESSION['account_is_create'] = 'Votre compte a été crééé avec succès !';
      header('location: sign-up.php');

    } else {

      $_SESSION['password_is_incorrect'] = 'Les mots de passe ne sont pas identiques !';
      header('location: sign-up.php');

    }

  } else {

    $_SESSION['username_exist'] = 'Votre username est déjà pris. Veuillez choisir un autre !';
    header('location: sign-up.php');

  }

}

?>