<?php
require_once "connect_db.php";

function insert($req) {

    $result = $conn->exec($req);

    return $result;
}

function update($req) {

    $result = $conn->exec($req);

    return $result;
}

function delete($req) {

    $result = $conn->exec($req);

    return $result;
}

function totalEntrees($req) {

    $result = mysqli_query($conn, $req);

    $result = mysqli_fetch_assoc($result);

    return $result;
}

function totalSorties($req) {

    $result = mysqli_query($conn, $req);

    $result = mysqli_fetch_assoc($result);

    return $result;
}


function select($req) {

    $result = mysqli_query($conn, $req);

    return $result;
} 

?>