<?php
session_start();
require_once "./database/functions.php";

if (isset($_POST['submit'])) {
    $societe = $_POST['societe'];
    $motif = $_POST['motif'];
    $date = $_POST['date'];
    $designation = addslashes($_POST['designation']);
    $qte = $_POST['qte'];
    $prix_uni = $_POST['prix_uni'];
    $montant_esti = $_POST['montant_esti'];

    $req3 = "SELECT count(*) as nbrSo FROM societe";
    $res3 = select($req3);

    $so = mysqli_fetch_assoc($res3);

    $nbrSo = $so['nbrSo'];

    if ($nbrSo < 1) {
        $req2 = "INSERT INTO societe VALUES('". strtoupper($societe) . "','$motif')";
        $res2 = mysqli_query(CONN, $req2);
    }

    $req = "INSERT INTO besoins(id,designation,qte,prix_unitaire_es,mt_es,date) VALUES(NULL,'$designation',$qte,$prix_uni,$montant_esti,'$date')";
    $res = mysqli_query(CONN, $req);

    if ($res) {
        $_SESSION['message'] = 'Besoin ajouté avec succès';

        header('location: besoins.php');
    }
}

?>