<?php
session_start();
require_once "database/functions.php";

$idD = isset($_GET['idD']) ? $_GET['idD'] : 0;

$req = "DELETE FROM depenses WHERE id=$idD";

$res = delete($req);

$_SESSION['msg_dep'] = 'Dépense supprimée avec succès !';

header('location: liste_ajout_sortie.php');

?>