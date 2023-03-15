<?php
require_once "database/functions.php";

$idP = $_GET['idP'];

$req = "DELETE FROM profile WHERE id=$idP";

$res = delete($req);

header('location: allProfile.php');

?>