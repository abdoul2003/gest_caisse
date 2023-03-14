<?php
session_start();
require_once "database/functions.php";

$idB = isset($_GET['idB']) ? $_GET['idB'] : 0;

$req = "DELETE FROM besoins WHERE id=$idB";

$res = delete($req);

$_SESSION['msg_bes'] = 'Besoin supprimée avec succès !';

header('location: statistique.php');

?>