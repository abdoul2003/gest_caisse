<?php
require_once "database/functions.php";

if (isset($_POST['montant_accorde'], $_POST['idB'])) {

    $idB = $_POST['idB'];
    $montant_accorde = $_POST['montant_accorde'];

    $req = "UPDATE besoins SET status='accepté', montant_accorde=$montant_accorde WHERE id=$idB";
    $res = update($req);
    header('location: besoins.php');
}



?>