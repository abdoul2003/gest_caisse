<?php
session_start();
require_once "./database/functions.php";

$query = "SELECT count(*) as besoinsAcceptes FROM besoins WHERE regler='non'";
$result_query = select($query);
$besoinsAcceptes = mysqli_fetch_assoc($result_query);

$besoinsAcceptes = $besoinsAcceptes['besoinsAcceptes'];

if ($besoinsAcceptes > 0) {

    $req = "UPDATE besoins SET regler='oui' WHERE regler='non'";
    
    $res = update($req);
    ;
    $_SESSION['msg_besoins_acceptes_regles'] = 'Tous les besoins acceptés ont été réglés avec succès!';
} else {
    $_SESSION['besoins_acceptes_regles_no'] = 'Aucun besoin non réglé en cours d\'attente. Merci!';
}


header('location: listBesoins.php')

?>