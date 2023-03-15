<?php
require_once "database/functions.php";

if (isset($_POST['submit'])) {
    $profile = $_POST['profile'];
    $idU = $_POST['idU'];
    $req = "UPDATE users SET role='$profile' WHERE id=$idU";
    $res = update($req);
    header('location: users.php');
}

?>