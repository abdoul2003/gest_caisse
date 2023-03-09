<?php
require_once "./database/functions.php";

$idB = isset($_GET['idB']) ? $_GET['idB'] : 0;

$req = "DELETE FROM besoins WHERE id=$idB";

$res = delete($req);

header('location: listBesoins.php');

?>