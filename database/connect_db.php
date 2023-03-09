<?php

define('HOSTNAME', 'localhost');
define('DBNAME', 'gest_caisse');
define('USERNAME', 'root');
define('PASSWORD', '');

try {

    $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DBNAME);

    // echo "Connexion réussie!";

} catch (Exception $e) {

    echo "La connexion à la base de données a échouée: " . $e->getMessage();

    exit;

}

?>