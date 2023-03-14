<?php
require_once "connect_db.php";

$connexion = $conn;

define('CONN', $conn);

function insert($req) {

    $result = mysqli_query(CONN, $req);

    return $result;
}

function update($req) {

    $result = mysqli_query(CONN, $req);

    return $result;
}

function delete($req) {

    $result = mysqli_query(CONN, $req);

    return $result;
}

function select($req) {

    $result = mysqli_query(CONN, $req);

    return $result;
} 

?>