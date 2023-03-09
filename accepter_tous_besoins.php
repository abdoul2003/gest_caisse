<?php
session_start();
require_once "./database/functions.php";

$query = "SELECT count(*) as besoinsNonAcceptes FROM besoins WHERE status='en attente'";
$result_query = select($query);
$besoinsNonAcceptes = mysqli_fetch_assoc($result_query);

$besoinsNonAcceptes = $besoinsNonAcceptes['besoinsNonAcceptes'];

if ($besoinsNonAcceptes > 0) {

    $req = "UPDATE besoins SET status='accepté' WHERE status='en attente'";
    
    $res = update($req);
    ;
    $_SESSION['msg_besoins_acceptes'] = 'Tous les besoins ont été acceptés avec succès!';
} else {
    $_SESSION['besoins_acceptes_no'] = 'Aucun besoin en cours d\'attente. Merci!';
}


header('location: listBesoins.php')

?>