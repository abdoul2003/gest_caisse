<?php
session_start();
require_once "./database/functions.php";

if (isset($_POST['submit'])) {

  $id_user = $_POST['id_user'];

  $req = "SELECT * FROM users WHERE id=$id_user";

  $res = select($req);
  
  $user = mysqli_fetch_assoc($res);

  $active = $user['active'];

    if ($active == 1) {

        $req2 = "UPDATE users SET active=0 WHERE id=$id_user";
        $res2 = update($req2);

        header('location: users.php');
    } else {
        $req2 = "UPDATE users SET active=1 WHERE id=$id_user";
        $res2 = update($req2);

        header('location: users.php');
    }
}

?>