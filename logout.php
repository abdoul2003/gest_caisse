<?php
session_start();
require_once "database/functions.php";

if ($_SESSION['user_session'])
{
    session_destroy();

    header('location: sign-in.php');

}

?>