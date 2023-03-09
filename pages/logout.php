<?php
session_start();
require_once "../database/functions.php";

if (isset($_SESSION['user']))
{
    $id = $_SESSION['user']['id'];
    $req = "UPDATE users SET status=0 WHERE id=$id";
    update($req);
    session_destroy();
    header('location: sign-in.php');
}

?>