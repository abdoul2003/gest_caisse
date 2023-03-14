<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

    $beneficiaire = addslashes($_POST['benefi']);
    $montant = $_POST['montant'];
    $motif = addslashes($_POST['motif']);
    $date = $_POST['date'];
    $id = $_POST['id'];


    $req = "UPDATE depenses SET date = '$date', beneficiaire = '$beneficiaire', motif = '$motif', mt = $montant WHERE id = $id";
    $res = insert($req);

    $_SESSION['depense_editer'] = "La dépense a été modifiée avec succès !";

    header('location: liste_ajout_sortie.php');

}

?>