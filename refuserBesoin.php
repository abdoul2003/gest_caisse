<?php
require_once "database/functions.php";

$idB = isset($_GET['idB']) ? $_GET['idB'] : 0;

$req = "UPDATE besoins SET status='refusé' WHERE id=$idB";

$res = update($req);

header('location: besoins.php');

?>