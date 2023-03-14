<?php
require_once "database/functions.php";

if (isset($_POST['submit'])) {


    $beneficiaire = addslashes($_POST['benefi']);
    $source = addslashes($_POST['source']);
    $motif = addslashes($_POST['motif']);
    $date = $_POST['date'];
    $mt_d = $_POST['mt_d'];
    $mt_a = $_POST['mt_a'];
    $idB = $_POST['idB'];
    $moyen_paye = $_POST['moyen_paye'];
    $description = addslashes($_POST['description']);
    $remarque = addslashes($_POST['remarque']);


    $req = "INSERT INTO entrees VALUES(NULL,'$source','$beneficiaire','$motif','$date',$mt_d,'$description',$mt_a,'$remarque','$moyen_paye')";
    $res = insert($req);

    $req2 = "UPDATE besoins SET payement=1 WHERE id=$idB";
    $res2 = update($req2);
    
    header('location: besoins.php');

}
?>