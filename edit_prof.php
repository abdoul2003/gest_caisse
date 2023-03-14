<?php
session_start();
require_once "database/functions.php";

if (isset($_SESSION['user_session'])) {

    $user = $_SESSION['user_session'];
  
}

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $mdp = $_POST['mdp'];
    $mdp_confirm = $_POST['mdp_confirm'];


    $query = "SELECT * FROM users WHERE username='$username'";
    $result = select($query);
    $result = mysqli_fetch_assoc($result);

    $idUser = $user['id'];

    if ($idUser == $result['id']) {

        if (strcmp($mdp, $mdp_confirm) == 0) {

            $req = "UPDATE users SET username='$username', mdp='$mdp_confirm' WHERE id=$idUser";
            $res = update($req);
    
            header('location: sign-in.php');
    
        } else {
    
            $_SESSION['mdp_incorrect'] = "Les mots de passe ne sont pas identiques !";
    
            header('location: editer_prof.php');
        }

    } else {

        $_SESSION['username_incorrect'] = "Username indisponible !";
    
        header('location: editer_prof.php');

    }

}

?>