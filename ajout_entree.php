<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

    $beneficiaire = addslashes($_POST['benefi']);
    $source = addslashes($_POST['source']);
    $motif = addslashes($_POST['motif']);
    $date = $_POST['date'];
    $mt_d = $_POST['mt_d'];
    $mt_a = $_POST['mt_a'];
    $moyen_paye = $_POST['moyen_paye'];
    $description = addslashes($_POST['description']);
    $remarque = addslashes($_POST['remarque']);


    $req = "INSERT INTO entrees VALUES(NULL,'$source','$beneficiaire','$motif','$date',$mt_d,'$description',$mt_a,'$remarque','$moyen_paye')";
    $res = insert($req);

    $_SESSION['entree_ajouter'] = "L'entrée a été enregistrer avec succès !";

    header('location: ajouterEntree.php');

}

?>