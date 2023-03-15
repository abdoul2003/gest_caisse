<?php
session_start();
require_once "database/functions.php";

if (isset($_POST['submit'])) {

    $designation = addslashes($_POST['designation']);
    $montant_de = $_POST['montant_de'];
    $date = date('Y-m-d');

    $req = "INSERT INTO besoins(id,designation,montant,date) VALUES(NULL,'$designation',$montant_de,'$date')";
    $res = insert($req);

    $_SESSION['besoin_ajouter'] = "Le besoin a été enregistrer avec succès !";

    header('location: exprimerBesoin.php');

}

?>