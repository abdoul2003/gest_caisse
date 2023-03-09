<?php
require_once "./database/functions.php";

$idU = $_GET['idU'];

$req = "DELETE FROM users WHERE id=$idU";

$res = delete($req);

header('location: users.php');

?>