<?php
session_start();
require_once "./database/functions.php";

if (!isset($_SESSION['user'])) {
    header('location: ./pages/sign-in.php');
}else {
    $user = $_SESSION['user'];
}

if (isset($_SESSION['msg_besoins_acceptes'])) {
    $msg_b_accept = $_SESSION['msg_besoins_acceptes'];
    unset($_SESSION['msg_besoins_acceptes']);
}

if (isset($_SESSION['msg_besoins_refuses'])) {
    $msg_besoins_refuses = $_SESSION['msg_besoins_refuses'];
    unset($_SESSION['msg_besoins_refuses']);
}

if (isset($_SESSION['besoins_acceptes_no'])) {
    $besoins_acceptes_no = $_SESSION['besoins_acceptes_no'];
    unset($_SESSION['besoins_acceptes_no']);
}

if (isset($_SESSION['msg_besoins_supprimer'])) {
    $msg_besoins_supprimer = $_SESSION['msg_besoins_supprimer'];
    unset($_SESSION['msg_besoins_supprimer']);
}

if (isset($_SESSION['besoins_acceptes_regles'])) {
    $besoins_acceptes_regles = $_SESSION['besoins_acceptes_regles'];
    unset($_SESSION['besoins_acceptes_regles']);
}

if (isset($_SESSION['msg_besoins_refuses_supprimer'])) {
    $msg_besoins_refuses_supprimer = $_SESSION['msg_besoins_refuses_supprimer'];
    unset($_SESSION['msg_besoins_refuses_supprimer']);
}

if (isset($_SESSION['besoins_refuses_no'])) {
    $besoins_refuses_no = $_SESSION['besoins_refuses_no'];
    unset($_SESSION['besoins_refuses_no']);
}

if (isset($_SESSION['msg_besoins_acceptes_regles'])) {
    $msg_besoins_acceptes_regles = $_SESSION['msg_besoins_acceptes_regles'];
    unset($_SESSION['msg_besoins_acceptes_regles']);
}

if (isset($_SESSION['besoins_acceptes_regles_no'])) {
    $besoins_acceptes_regles_no = $_SESSION['besoins_acceptes_regles_no'];
    unset($_SESSION['besoins_acceptes_regles_no']);
}

$req2 = 'SELECT * FROM societe';
$res2 = select($req2);

$so = mysqli_fetch_assoc($res2);

$nom = isset($so['nom']) ? $so['nom'] : "";
$motif = isset($so['motif']) ? $so['motif'] : "";

// var_dump($id, $nom, $motif);

$req = "SELECT * FROM besoins";
$res = select($req);

// Nombre d'enregistrement des besoins
$query = "SELECT count(*) as NbreBesoins FROM besoins";
$result_query = select($query);
$query = mysqli_fetch_assoc($result_query);

$nbreBesoins = $query['NbreBesoins'];

$req_t = "SELECT SUM(mt_es) as montant_total FROM besoins";
$res_t = select($req_t);
$mt = mysqli_fetch_assoc($res_t);

$montant_total = $mt['montant_total'];

// Nombre de besoins acceptés

$req_besoin_accept = "SELECT count(*) as besoinsAcceptes FROM besoins where status='accepté'";
$res_besoin_accept = select($req_besoin_accept);
$besoin_accept = mysqli_fetch_assoc($res_besoin_accept);
$nbr_besoin_accept = $besoin_accept['besoinsAcceptes'];

// Nombre de besoins refusés

$req_besoin_refuse = "SELECT count(*) as besoinsRefuses FROM besoins where status='refusé'";
$res_besoin_refuse = select($req_besoin_refuse);
$besoin_refuse = mysqli_fetch_assoc($res_besoin_refuse);
$nbr_besoin_refuse = $besoin_refuse['besoinsRefuses'];

// Nombre de besoins réglés

$req_besoin_regler = "SELECT count(*) as besoinsRegles FROM besoins where regler='oui'";
$res_besoin_regler = select($req_besoin_regler);
$besoin_regler = mysqli_fetch_assoc($res_besoin_regler);
$nbr_besoin_regler = $besoin_regler['besoinsRegles'];

// Nombre de besoins en attente

$req_besoin_attente = "SELECT count(*) as besoinsAttente FROM besoins where status='en attente'";
$res_besoin_attente = select($req_besoin_attente);
$besoin_attente = mysqli_fetch_assoc($res_besoin_attente);
$nbr_besoin_attente = $besoin_attente['besoinsAttente'];

// Total besoins acceptés

$req_besoin_accept_total = "SELECT sum(mt_es) as totalBesoinsAcceptes FROM besoins where status='accepté' and regler='non'";
$res_besoin_accept_total = select($req_besoin_accept_total);
$besoin_accept_total = mysqli_fetch_assoc($res_besoin_accept_total);
$total_besoin_accept = $besoin_accept_total['totalBesoinsAcceptes'];

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Liste des besoins</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
        <div class="d-flex justify-content-between">
                        <p>Société/Département: <strong><?= $nom; ?></strong></p>
                        <p>Projet/Motif: <strong><?= $motif; ?></strong></p>
                    </div>

                    <?php if (isset($msg_b_accept)): ?>

                        <div class="alert alert-success text-white">
                            <?= $msg_b_accept; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($besoins_acceptes_no)): ?>

                        <div class="alert alert-primary text-white">
                            <?= $besoins_acceptes_no; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($msg_besoins_refuses)): ?>

                        <div class="alert alert-success text-white">
                            <?= $msg_besoins_refuses; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($msg_besoins_supprimer)): ?>

                        <div class="alert alert-success text-white">
                            <?= $msg_besoins_supprimer; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($besoins_acceptes_regles)): ?>

                        <div class="alert alert-danger text-white">
                            <?= $besoins_acceptes_regles; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($msg_besoins_refuses_supprimer)): ?>

                        <div class="alert alert-success text-white">
                            <?= $msg_besoins_refuses_supprimer; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($besoins_refuses_no)): ?>

                        <div class="alert alert-dark text-white">
                            <?= $besoins_refuses_no; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($msg_besoins_acceptes_regles)): ?>

                        <div class="alert alert-warning text-white">
                            <?= $msg_besoins_acceptes_regles; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($besoins_acceptes_regles_no)): ?>

                        <div class="alert alert-info text-white">
                            <?= $besoins_acceptes_regles_no; ?>
                        </div>

                    <?php endif; ?>
                    
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center">désignation</th>
                                    <th class="text-uppercase text-secondary text-center">quantité</th>
                                    <th class="text-uppercase text-secondary text-center">prix unitaire estimatif</th>
                                    <th class="text-uppercase text-secondary text-center">montant estimatif</th>
                                    <th class="text-uppercase text-secondary text-center">statut</th>
                                    <th class="text-uppercase text-secondary text-center">Régler</th>
                                    <?php if ($user['role'] != 'directeur'): ?>
                                        <th class="text-uppercase text-secondary text-center">actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($nbreBesoins > 0): ?>
                                <?php while($besoin = mysqli_fetch_assoc($res)): ?>
                                <tr>
                                    <td align="center">
                                        <?= $besoin['designation']; ?>
                                    </td>
                                    <td align="center">
                                        <?= $besoin['qte']; ?>
                                    </td>
                                    <td align="center">
                                        <?= $besoin['prix_unitaire_es']; ?> FCFA
                                    </td>
                                    <td align="center">
                                        <?= $besoin['mt_es']; ?> FCFA
                                    </td>
                                    <td align="center">
                                        <?= $besoin['status']; ?>
                                    </td>
                                    <td align="center">
                                        <?= $besoin['regler']; ?>
                                    </td>
                                    <td align="center">
                                        <!-- Si un besoin est accepté, on affiche 'Régler' sinon on affiche 'Accepter' -->
                                        <!-- href='reglerBesoin.php?idB=<?= $besoin['id'] ?>' -->
                                        <!-- href='accepterBesoin.php?idB=<?= $besoin['id'] ?>' -->
                                        <?php if ($besoin['status'] == 'accepté' &&  $besoin['regler'] == 'non'): ?>
                                            <?php if ($user['role'] == 'caisse'): ?>
                                                <a href="reglerBesoin.php?idB=<?= $besoin['id'] ?>" class="btn btn-primary">Régler</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($besoin['status'] == 'en attente'): ?>
                                            <?php if($user['role'] == 'directeur'): ?>
                                                <a href="accepterBesoin.php?idB=<?= $besoin['id'] ?>" class="btn btn-primary">Accepter</a>
                                                <a href="refuserBesoin.php?idB=<?= $besoin['id'] ?>" class="btn btn-danger">Refuser</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ((($besoin['status'] == 'accepté') && ($besoin['regler'] == 'oui')) || $besoin['status'] == 'refusé'): ?>
                                            <?php if ($user['role'] != 'directeur' || $user['role'] != 'rac' || $user['role'] != 'comptabilite'): ?>
                                                <a href="supprimerBesoin.php?idB=<?= $besoin['id'] ?>" class="btn btn-dark">Supprimer</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <td colspan="3" align="right">
                                        <strong>Total:</strong>
                                    </td>
                                    <td align="center">
                                        <?php echo $montant_total ? $montant_total : 0; ?> FCFA
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" align="center">Aucun besoin exprimer pour l'instant</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if($nbreBesoins > 0): ?>
                                <div class="d-flex justify-content-center mt-3">
                                    <?php if ($user['role'] == 'directeur'): ?>
                                        <a onclick="return confirm('Etes-vous sûr de vouloir accepter tous les besoins ?');" href="accepter_tous_besoins.php" class="btn btn-warning">Accepter tous les besoins</a>
                                        &nbsp;
                                        &nbsp;
                                        <a onclick="return confirm('Etes-vous sûr de vouloir refuser tous les besoins ?');" href="refuser_tous_besoins.php" class="btn btn-danger">Refuser tous les besoins</a>
                                    <?php endif; ?>
                                    <?php if ($user['role'] == 'caisse'): ?>
                                        
                                        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer tous les besoins acceptés et réglés ?');" href="supprimer_tous_besoins_a_r.php" class="btn btn-info">Supprimer tous les besoins acceptés et réglés</a>
                                        &nbsp;
                                        &nbsp;
                                        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer tous les besoins refusés ?');" href="supprimer_tous_besoins_refuses.php" class="btn btn-secondary">Supprimer tous les besoins refusés</a>
                                        &nbsp;
                                        &nbsp;
                                        <a onclick="return confirm('Etes-vous sûr de vouloir régler tous les besoins acceptés');" href="regler_tous_besoins_acceptes.php" class="btn btn-dark">Régler les besoins acceptés</a>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Nombre de besoins acceptés: <strong><?php echo ($nbr_besoin_accept > 0) ? $nbr_besoin_accept : 0 ?></strong></p>
                                        <p>Somme à régler: <strong><?php echo ($total_besoin_accept > 0) ? $total_besoin_accept : 0 ?> FCFA</strong></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Nombre de besoins réglés: <strong><?php echo ($nbr_besoin_regler > 0) ? $nbr_besoin_regler : 0 ?></strong></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Nombre de besoins refusés: <strong><?php echo ($nbr_besoin_refuse > 0) ? $nbr_besoin_refuse : 0 ?></strong></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Nombre de besoins en attente: <strong><?php echo ($nbr_besoin_attente > 0) ? $nbr_besoin_attente : 0 ?></strong></p>
                                    </div>
                                </div>
                        <?php endif; ?>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                document.write(new Date().getFullYear())
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>   
        </div>
    </main>

<?php include_once "footer.php"; ?>