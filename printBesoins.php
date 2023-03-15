<?php
session_start();
require_once "database/functions.php";

if (isset($_SESSION['user_session'])) {

  $user = $_SESSION['user_session'];

} else {

  header('location: sign-in.php');

}

$query = "SELECT designation, montant, montant_accorde FROM besoins WHERE payement=1 and status='accepté'";
$result = select($query);

$query2 = "SELECT SUM(montant_accorde) as total FROM besoins WHERE payement=1 and status='accepté'";
$result2 = select($query2);
$result2 = mysqli_fetch_assoc($result2);

$total = $result2['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des besoins</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body onload="print();">
    
    <div class="container py-2">

        <div class="card py-2">

            <div class="card-title">

                <div class="row">
                    <div class="col-12">
                        <span>Société: <strong>ITEBEMA SARLU</strong><span>
                        <span class="float-end">Date: <strong><?= date('Y-m-d'); ?></strong></span>
                    </div>
                </div>

                <hr>

                <h4 class="mb-2">Source:</h4>

                <h4>A:</h4>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead>

                        <th>Désignation</th>
                        <th>Montant demandé</th>
                        <th>Montant accordé</th>

                    </thead>

                    <tbody>
                        <!-- Liste des besoins -->
                        <?php while($besoin = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $besoin['designation']; ?></td>
                                <td><?= $besoin['montant']; ?> FCFA</td>
                                <td><?= $besoin['montant_accorde']; ?> FCFA</td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="2" align="center">
                                Total
                            </td>
                            <td>
                                <?php
                                    if (isset($total)) {
                                        echo $total . ' FCFA';
                                    }
                                ?>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="row">

                    <div class="col-12">

                        <p class="float-end"><strong>Signature</strong></p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="assets/js/core/bootstrap.min.js"></script>
</body>
</html>