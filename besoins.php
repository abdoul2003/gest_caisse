<?php
session_start();
require_once "database/functions.php";

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

$query2 = "SELECT SUM(montant_accorde) as total FROM besoins WHERE status='accepté' AND payement=0";
$result2 = select($query2);
$result2 = mysqli_fetch_assoc($result2);
$total = $result2['total'];

$query3 = "SELECT id,designation,montant FROM besoins WHERE status='en attente'";
$result3 = select($query3);

$query5 = "SELECT id,designation,montant,montant_accorde,payement,status,date FROM besoins WHERE payement=0 and status='accepté'";
$result5 = select($query5);

$query4 = "SELECT count(*) as besoinsEnAttente FROM besoins WHERE status='en attente'";
$result4 = select($query4);
$result4 = mysqli_fetch_assoc($result4);

$besoinsEnAttente = $result4['besoinsEnAttente'];

$actionsB = explode('-', $user['actions_besoins']) ;


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
          <?php foreach($actionsB as $actionB): ?>
              <?php if ($actionB == "AB"): ?>
                <a href="exprimerBesoin.php" class="btn btn-info">Exprimer vos besoins</a>
              <?php endif; ?>
          <?php endforeach; ?>
          &nbsp;
          <?php foreach($actionsB as $actionB): ?>
              <?php if ($actionB == "IB"): ?>
                <a href="printBesoins.php" class="btn btn-outline-danger">Imprimer</a>
              <?php endif; ?>
          <?php endforeach; ?>

          <h5 class="float-end">Total à payer: <strong><?php echo isset($total) ? $total : 0 ?> FCFA</strong></h5>

            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant demandé</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant accordé</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">payement</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                  <?php foreach($actionsB as $actionB): ?>
                    <?php if ($actionB == "APCB"): ?>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php while($besoin = mysqli_fetch_assoc($result5)): ?>
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
                      <td><?= ucfirst($besoin['status']); ?></td>
                      <td><?= $besoin['date']; ?></td>
                      <td>
                        <?php foreach($actionsB as $actionB): ?>
                          <?php if ($actionB == "APCB" AND $besoin['status'] == 'accepté' AND $besoin['payement'] == 0): ?>
                            <a class="btn btn-dark" href="validerBesoin.php?idB=<?= $besoin['id']; ?>">Approvisionner la caisse</a>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      <td>
                    </tr>
                  <?php endwhile; ?>
              </tbody>
            </table>
            <?php if($user['role'] == 'directeur'): ?>
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">désignation</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant demandé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant accordé</th>
                    <?php foreach($actionsB as $actionB): ?>
                      <?php if ($actionB == "ARB"): ?>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php if($besoinsEnAttente > 0): ?>
                    <?php while($besoin2 = mysqli_fetch_assoc($result3)): ?>
                      <tr>
                        <td><?= $besoin2['designation']; ?></td>
                        <td><?= $besoin2['montant']; ?> FCFA</td>
                        <form action="accepterBesoin.php" method="post">
                          <td>
                            <input type="hidden" name="idB" value="<?= $besoin2['id']; ?>" class="form-control w-12">
                            <input type="number" name="montant_accorde" class="w-50 form-control" required>
                          </td>
                          <td>
                            <?php foreach($actionsB as $actionB): ?>
                              <?php if ($actionB == "ARB"): ?>
                                <a class="btn btn-danger" href="refuserBesoin.php?idB=<?= $besoin2['id']; ?>">Refuser</a>
                                &nbsp;
                                <button class="btn btn-primary" type="submit" name="submit">Accepter</button>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </td>
                        </form>
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