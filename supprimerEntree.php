<?php
session_start();
require_once "database/functions.php";

$idE = isset($_GET['idE']) ? $_GET['idE'] : 0;

$req = "DELETE FROM entrees WHERE id=$idE";

$res = delete($req);

$_SESSION['msg_dep'] = 'Entrée supprimée avec succès !';

header('location: liste_ajout_entree.php');

?>