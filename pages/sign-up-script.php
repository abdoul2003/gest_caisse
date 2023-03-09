<?php
session_start();
require_once "../database/functions.php";

if (isset($_POST['submit'])) {
  
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $role = $_POST['role'];
  $mdp = $_POST['mdp'];

  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $email = htmlspecialchars($email);

  $query = "SELECT count(*) as nbrDirecteur FROM users WHERE role='directeur'";
  $result = select($query);
  $result = mysqli_fetch_assoc($result);
  $nbrDirecteur = $result['nbrDirecteur'];

  $query2 = "SELECT count(*) as nbrComptable FROM users WHERE role='comptabilite'";
  $result2 = select($query2);
  $result2 = mysqli_fetch_assoc($result2);
  $nbrComptable = $result2['nbrComptable'];

  $query3 = "SELECT count(*) as nbrRac FROM users WHERE role='rac'";
  $result3 = select($query3);
  $result3 = mysqli_fetch_assoc($result3);
  $nbrRac = $result3['nbrRac'];

  $query4 = "SELECT count(*) as nbrEmail FROM users WHERE email='$email'";
  $result4 = select($query4);
  $result4 = mysqli_fetch_assoc($result4);
  $nbrEmail = $result4['nbrEmail'];

  if ($nbrEmail > 0) {
    $_SESSION['msg_email_telephone'] = 'Désolé, votre email est indisponible. Veuillez en choisir un autre! Merci';
    header('location: sign-up.php');
  } else if ($nbrComptable > 0 && $role == 'comptabilite') {
    $_SESSION['comptable_exist'] = 'Désolé, un utilisateur à déjà choisit comptabilite. Veuillez en choisir un autre! Merci';
    header('location: sign-up.php');
  } else if ($nbrRac > 0 && $role == 'rac') {
    $_SESSION['rac_exist'] = 'Désolé, un utilisateur à déjà choisit rac. Veuillez en choisir un autre! Merci';
    header('location: sign-up.php');
  }else if ($nbrDirecteur > 0 && $role == 'directeur') {
    $_SESSION['directeur_exist'] = 'Désolé, un utilisateur à déjà choisit directeur. Veuillez en choisir un autre! Merci';
    header('location: sign-up.php');
  } else {
    $req = "INSERT INTO users(id,nom,prenom,role,email,telephone,mdp) VALUES(NULL,'". strtoupper($nom) ."','". ucwords($prenom) ."','$role','$email','$telephone','$mdp')";
    $res = insert($req);

    $_SESSION['msg_create_account'] = 'Votre compte a bien été crééé, contactez le/la comptable pour activer votre compte! Merci';
    header('location: sign-up.php');
  }

}

?>