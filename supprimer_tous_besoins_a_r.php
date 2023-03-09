<?php
session_start();
require_once "./database/functions.php";

$query = "SELECT count(*) as besoinsAcceptesRegles FROM besoins WHERE regler='oui'";
$result_query = select($query);
$besoinsAcceptesRegles = mysqli_fetch_assoc($result_query);

$besoinsAcceptesRegles = $besoinsAcceptesRegles['besoinsAcceptesRegles'];

if ($besoinsAcceptesRegles > 0) {

    $req = "DELETE FROM besoins WHERE regler='oui'";
    
    $res = delete($req);
    ;
    $_SESSION['msg_besoins_supprimer'] = 'Tous les besoins réglés ont été supprimés avec succès!';
} else {
    $_SESSION['besoins_acceptes_regles'] = 'Aucun besoin réglé pour l\'instant. Merci!';
}


header('location: listBesoins.php')

?>