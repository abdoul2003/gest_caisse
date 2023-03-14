<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $mdp = $_POST['mdp'];
  $mdp2 = $_POST['mdp2'];
  $role = $_POST['role'];

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

  if ($role == 'caisse') {

    $query = "SELECT COUNT(*) as userCaisse FROM users WHERE role='$role'";
    $result = select($query);
    $result = mysqli_fetch_assoc($result);

    if ($result['userCaisse'] == 0) {

      if (!$result2) {

        if (verifierMdp($mdp, $mdp2)) {

          $req = "INSERT INTO users VALUES(NULL,'$username','$mdp','$role')";
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

    } else {

      $_SESSION['user_role'] = 'Vous ne pouvez pas créér un compte car le nombre d\'utilisateurs autorisés est déjà atteint !';
      header('location: sign-up.php');

    }

  } else if ($role == 'comptabilite') {

    $query = "SELECT COUNT(*) as userComptabilite FROM users WHERE role='$role'";
    $result = select($query);
    $result = mysqli_fetch_assoc($result);

    if ($result['userComptabilite'] == 0) {

      if (!$result2) {

        if (verifierMdp($mdp, $mdp2)) {

          $req = "INSERT INTO users VALUES(NULL,'$username','$mdp','$role')";
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

    } else {

      $_SESSION['user_role'] = 'Vous ne pouvez pas créér un compte car le nombre d\'utilisateurs autorisés est déjà atteint !';
      header('location: sign-up.php');

    }

  } else if ($role == 'rac') {

    $query = "SELECT COUNT(*) as userRac FROM users WHERE role='$role'";
    $result = select($query);
    $result = mysqli_fetch_assoc($result);

    if ($result['userRac'] == 0) {

      if (!$result2) {

        if (verifierMdp($mdp, $mdp2)) {

          $req = "INSERT INTO users VALUES(NULL,'$username','$mdp','$role')";
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

    } else {

      $_SESSION['user_role'] = 'Vous ne pouvez pas créér un compte car le nombre d\'utilisateurs autorisés est déjà atteint !';
      header('location: sign-up.php');

    }

  } else {

    $query = "SELECT COUNT(*) as userDirecteur FROM users WHERE role='$role'";
    $result = select($query);
    $result = mysqli_fetch_assoc($result);

    if ($result['userDirecteur'] == 0) {

      if (!$result2) {

        if (verifierMdp($mdp, $mdp2)) {

          $req = "INSERT INTO users VALUES(NULL,'$username','$mdp','$role')";
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

    } else {

      $_SESSION['user_role'] = 'Vous ne pouvez pas créér un compte car le nombre d\'utilisateurs autorisés est déjà atteint !';
      header('location: sign-up.php');

    }

  }

}

?>