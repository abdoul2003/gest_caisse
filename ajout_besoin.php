<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

    $designation = addslashes($_POST['designation']);
    $qte = $_POST['qte'];
    $prixU = $_POST['prixU'];
    $date = $_POST['date'];

    $montant = $prixU * $qte;

    $req = "INSERT INTO besoins(id,designation,qte,prixU,montant,date) VALUES(NULL,'$designation',$qte,$prixU,$montant,'$date')";
    $res = insert($req);

    $_SESSION['besoin_ajouter'] = "Le besoin a été enregistrer avec succès !";

    header('location: exprimerBesoin.php');

}

?>