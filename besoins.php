<?php
session_start();
require_once "database/functions.php";

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

$query = "SELECT id,designation,qte,prixU,montant,payement,status,date FROM besoins ORDER BY payement, status";
$result = select($query);

$query2 = "SELECT SUM(montant) as total FROM besoins WHERE status='accepté' AND payement=0";
$result2 = select($query2);
$result2 = mysqli_fetch_assoc($result2);
$total = $result2['total'];

$query3 = "SELECT id,designation,payement,date,status,qte,prixU,montant,status FROM besoins WHERE status='en attente'";
$result3 = select($query3);

$query5 = "SELECT id,designation,payement,date,status,qte,prixU,montant,status FROM besoins WHERE payement=0 and status='accepté'";
$result5 = select($query5);

$query4 = "SELECT count(*) as besoinsEnAttente FROM besoins WHERE status='en attente'";
$result4 = select($query4);
$result4 = mysqli_fetch_assoc($result4);

$besoinsEnAttente = $result4['besoinsEnAttente'];

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Besoins</h6>
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
        <div class="card">
          <div class="card-body">
            <?php if($user['role'] != 'directeur'): ?>
              <a href="exprimerBesoin.php" class="btn btn-info">Exprimer vos besoins</a>
            <?php endif; ?>
            <?php if($user['role'] == 'directeur' || $user['role'] == 'caisse'): ?>
              <h5 class="float-end">Total à payer: <strong><?php echo isset($total) ? $total : 0 ?> FCFA</strong></h5>
            <?php endif; ?>
            <?php if($user['role'] == 'caisse'): ?>
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">quantité</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">prix unitaire estimatif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant estimatif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">payement</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($besoin = mysqli_fetch_assoc($result5)): ?>
                      <tr>
                        <td><?= $besoin['designation']; ?></td>
                        <td><?= $besoin['qte']; ?></td>
                        <td><?= $besoin['prixU']; ?> FCFA</td>
                        <td><?= $besoin['montant']; ?> FCFA</td>
                        <td><?php echo ($besoin['payement'] == 0) ? 'En attente' : 'Payé'; ?></td>
                        <td><?= ucfirst($besoin['status']); ?></td>
                        <td><?= $besoin['date']; ?></td>
                        <td>
                          <?php if ($user['role'] == 'caisse' AND $besoin['status'] == 'accepté' AND $besoin['payement'] == 0): ?>
                            <a class="btn btn-dark" href="validerBesoin.php?idB=<?= $besoin['id']; ?>">Payer</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                </tbody>
              </table>
            <?php endif; ?>
            <?php if($user['role'] == 'directeur'): ?>
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">quantité</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">prix unitaire estimatif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant estimatif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($besoinsEnAttente > 0): ?>
                    <?php while($besoin2 = mysqli_fetch_assoc($result3)): ?>
                      <tr>
                        <td><?= $besoin2['designation']; ?></td>
                        <td><?= $besoin2['qte']; ?></td>
                        <td><?= $besoin2['prixU']; ?> FCFA</td>
                        <td><?= $besoin2['montant']; ?> FCFA</td>
                        <td><?= ucfirst($besoin2['status']); ?></td>
                        <td>
                          <a class="btn btn-danger" href="refuserBesoin.php?idB=<?= $besoin2['id']; ?>">Refuser</a>
                          &nbsp;
                          <a class="btn btn-primary" href="accepterBesoin.php?idB=<?= $besoin2['id']; ?>">Accepter</a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                      <tr>
                        <td colspan="6" align="center">Aucun besoin en attente</td>
                      </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            <?php endif; ?>
            <?php if($user['role'] == 'rac' || $user['role'] == 'comptabilite'): ?>
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">quantité</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">prix unitaire estimatif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant estimatif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($besoin = mysqli_fetch_assoc($result5)): ?>
                    <tr>
                      <td><?= $besoin['designation']; ?></td>
                      <td><?= $besoin['qte']; ?></td>
                      <td><?= $besoin['prixU']; ?> FCFA</td>
                      <td><?= $besoin['montant']; ?> FCFA</td>
                      <td><?= $besoin['date']; ?></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
        </div>
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