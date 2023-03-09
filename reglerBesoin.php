<?php
require_once "./database/functions.php";

$idB = isset($_GET['idB']) ? $_GET['idB'] : 0;

$req = "UPDATE besoins SET regler='oui' WHERE id=$idB";

$res = update($req);

header('location: listBesoins.php');

?>