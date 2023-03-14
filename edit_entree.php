<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $beneficiaire = addslashes($_POST['benefi']);
    $source = addslashes($_POST['source']);
    $motif = addslashes($_POST['motif']);
    $date = $_POST['date'];
    $mt_d = $_POST['mt_d'];
    $mt_a = $_POST['mt_a'];
    $moyen_paye = $_POST['moyen_paye'];
    $description = addslashes($_POST['description']);
    $remarque = addslashes($_POST['remarque']);

    $req = "UPDATE entrees SET source = '$source', beneficiaire = '$beneficiaire', motif = '$motif', date = '$date', mt_d=$mt_d, description='$description', mt_a = $mt_a, remarque = '$remarque', type_paye='$moyen_paye' WHERE id = $id";
    $res = insert($req);

    $_SESSION['entree_editer'] = "L'entrée a été modifiée avec succès !";

    header('location: liste_ajout_entree.php');

}

?>