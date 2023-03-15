<!-- - Afficher la liste des besoins refusés->status='refusé'
- Afficher la liste des besoins réglés->payement=1
- Afficher la liste des besoins en attente->status='en attente'
- La suppression des besoins refusés et réglés -->
<?php
session_start();
require_once "database/functions.php";

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

if (isset($_SESSION['msg_bes'])) {
    $msg_bes = $_SESSION['msg_bes'];
    unset($_SESSION['msg_bes']);
}

$query = "SELECT id,designation,montant,montant_accorde,date,status FROM besoins WHERE status='en attente'";
$result = select($query);

$query2 = "SELECT id,designation,montant,montant_accorde,payement,date FROM besoins WHERE payement=1";
$result2 = select($query2);

$query3 = "SELECT id,designation,montant,montant_accorde,status,date FROM besoins WHERE status='refusé'";
$result3 = select($query3);

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Statistiques</h6>
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
            <h5 class="text-center py-2">Besoins en attente</h5>
          <div class="card-body">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant demandé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant accordé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php while($besoin = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?= $besoin['designation']; ?></td>
                        <td><?= $besoin['montant']; ?> FCFA</td>
                        <td>
                          <?php
                            if (!empty($besoin['montant_accorde'])) {
                              echo $besoin['montant_accorde'] . ' FCFA';
                            }
                          ?>
                        </td>
                        <td><?= $besoin['date']; ?></td>
                        <td><?= $besoin['status']; ?></td>
                      </tr>
                    <?php endwhile; ?>
                </tbody>
              </table>
          </div>
        </div>
        <hr>
        <?php if (isset($msg_bes)): ?>
            <div class="alert alert-danger text-white">
                <?= $msg_bes; ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <h5 class="text-center py-2">Besoins réglés</h5>
          <div class="card-body">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant demandé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant accordé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">payement</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                    <?php if ($user['role'] == 'caisse'): ?>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                    <?php endif; ?>    
                    </tr>
                </thead>
                <tbody>
                    <?php while($besoin = mysqli_fetch_assoc($result2)): ?>
                      <tr>
                        <td><?= $besoin['designation']; ?></td>
                        <td><?= $besoin['montant']; ?> FCFA</td>
                        <td>
                          <?php
                            if (!empty($besoin['montant_accorde'])) {
                              echo $besoin['montant_accorde'] . ' FCFA';
                            }
                          ?>
                        </td>
                        <td><?php echo ($besoin['payement'] == 0) ? 'En attente' : 'Payé'; ?></td>
                        <td><?= $besoin['date']; ?></td>
                        <td>
                          <?php if ($user['role'] == 'caisse'): ?>
                            <a class="btn btn-danger" href="supprimerBesoin.php?idB=<?= $besoin['id']; ?>">Supprimer</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                </tbody>
              </table>
          </div>
        </div>
        <hr>
        <div class="card">
            <h5 class="text-center py-2">Besoins refusés</h5>
          <div class="card-body">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant demandé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant accordé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                    <?php if ($user['role'] == 'caisse'): ?>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                    <?php endif; ?>      
                  </tr>
                </thead>
                <tbody>
                    <?php while($besoin = mysqli_fetch_assoc($result3)): ?>
                      <tr>
                        <td><?= $besoin['designation']; ?></td>
                        <td><?= $besoin['montant']; ?> FCFA</td>
                        <td>
                          <?php
                            if (!empty($besoin['montant_accorde'])) {
                              echo $besoin['montant_accorde'] . ' FCFA';
                            }
                          ?>
                        </td>
                        <td><?= $besoin['status']; ?></td>
                        <td><?= $besoin['date']; ?></td>
                        <td>
                          <?php if ($user['role'] == 'caisse'): ?>
                            <a class="btn btn-danger" href="supprimerBesoin.php?idB=<?= $besoin['id']; ?>">Supprimer</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                </tbody>
              </table>
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