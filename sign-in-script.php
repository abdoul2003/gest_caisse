<?php
session_start();
require_once "database/functions.php";

if (isset($_GET['submit'])) {

    $username = $_GET['username'];
    $mdp = $_GET['mdp'];

    $query = "SELECT * FROM users WHERE username='$username' AND mdp='$mdp'";
    $res = select($query);
    $res = mysqli_fetch_assoc($res);

    if ($res) {

        $_SESSION['user_session'] = $res;

        header('location: index.php');

    } else {

        $_SESSION['user_not_found'] = "Username ou mot de passe incorrect !";
        header('location: sign-in.php');

    }

}

?>