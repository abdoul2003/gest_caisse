<?php
session_start();
require_once "./database/functions.php";

$query = "SELECT count(*) as besoinsRefuses FROM besoins WHERE status='refusé'";
$result_query = select($query);
$besoinsRefuses = mysqli_fetch_assoc($result_query);

$besoinsRefuses = $besoinsRefuses['besoinsRefuses'];

if ($besoinsRefuses > 0) {

    $req = "DELETE FROM besoins WHERE status='refusé'";
    
    $res = delete($req);
    ;
    $_SESSION['msg_besoins_refuses_supprimer'] = 'Tous les besoins refusés ont été supprimés avec succès!';
} else {
    $_SESSION['besoins_refuses_no'] = 'Aucun besoin refusé pour l\'instant. Merci!';
}


header('location: listBesoins.php')

?>