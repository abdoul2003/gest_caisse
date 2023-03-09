<?php
session_start();
require_once "../database/functions.php";

if (isset($_GET['submit'])) {

  $email = $_GET['email'];
  $mdp = $_GET['mdp'];

  $req = "SELECT * FROM users WHERE email='$email' AND mdp='$mdp'";

  $res = select($req);
  
  $user = mysqli_fetch_assoc($res);

    if ($user) {
        $req2 = "UPDATE users SET status=1 WHERE email='$email' AND mdp='$mdp'";
        $res2 = update($req2);

        if ($user['active'] == 1) {
            $_SESSION['user'] = $user;
            header('location: ../home.php');
        } else {
            $_SESSION['msg_conn'] = "Contactez le comptable pour activer votre compte!";
            header('location: sign-in.php');
        }
        
    } else {
        $_SESSION['user_conn_msg'] = "Email ou mot de passe incorrect";
        header('location: sign-in.php');
    }
}

?>