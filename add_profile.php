<?php
require_once "database/functions.php";

if (isset($_POST['submit'])) {
    $profile = $_POST['profile'];
    $req = "INSERT INTO profile VALUES(NULL,'$profile')";
    $res = insert($req);
    header('location: users.php');
}

?>