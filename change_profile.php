<?php
    require_once "database/functions.php";

    if (isset($_POST['submit'])) {
        $idU = isset($_POST['idU']) ? $_POST['idU'] : 0;
        $profile = isset($_POST['profile']) ? $_POST['profile'] : "";
        $action_entrees = isset($_POST['action_entrees']) ? $_POST['action_entrees'] : '';
        $action_depenses = isset($_POST['action_depenses']) ? $_POST['action_depenses'] : '';
        $action_besoins = isset($_POST['action_besoins']) ? $_POST['action_besoins'] : '';
        $action_statistique = isset($_POST['action_statistiques']) ? $_POST['action_statistiques'] : '';

        $req = "UPDATE users SET role='$profile' WHERE id=$idU";
        $res = update($req);

        $string_entrees = "";

        foreach ($action_entrees as $action) {
            if ($action != '') {
                $string_entrees = $string_entrees . $action . "-";
            }
        }

        $req = "UPDATE users SET actions_entrees='$string_entrees' WHERE id=$idU";
        $res = update($req);

        $string_depenses = "";

        foreach ($action_depenses as $action) {
            
            if ($action != '') {
                $string_depenses = $string_depenses . $action . "-";
            }

        }
        $req = "UPDATE users SET actions_depenses='$string_depenses' WHERE id=$idU";
        $res = update($req);

        $string_besoins = "";

        foreach ($action_besoins as $action) {
            
            if ($action != '') {
                $string_besoins = $string_besoins . $action . "-";
            }

        }

        $req = "UPDATE users SET actions_besoins='$string_besoins' WHERE id=$idU";
        $res = update($req);

        $req = "UPDATE users SET actions_statistiques='$action_statistique' WHERE id=$idU";
        $res = update($req);

        header('location: users.php');

    }
?>