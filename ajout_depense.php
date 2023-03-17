<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

    $beneficiaire = addslashes($_POST['benefi']);
    $montant = $_POST['montant'];
    $motif = addslashes($_POST['motif']);
    $date = date('Y-m-d');


    $req = "INSERT INTO depenses VALUES(NULL,'$date','$beneficiaire','$motif',$montant)";
    $res = insert($req);

    $_SESSION['depense_ajouter'] = "Le dépense a été enregistrer avec succès !";

    header('location: ajouterDepense.php');

}

?>