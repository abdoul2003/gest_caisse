<?php
session_start();
require_once "database/functions.php";

if (isset($_SESSION['user_session'])) {

  $user = $_SESSION['user_session'];

} else {

  header('location: sign-in.php');

}

if (isset($_SESSION['depense_editer'])) {

  $depense_editer = $_SESSION['depense_editer'];

  unset($_SESSION['depense_editer']);

}

if (isset($_SESSION['msg_dep'])) {

  $msg_dep = $_SESSION['msg_dep'];

  unset($_SESSION['msg_dep']);

}

$actionsD = explode('-', $user['actions_depenses']) ;


$query = "SELECT * FROM depenses";
$result = select($query);

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Dépenses</h6>
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
    <div class="container-fluid py-4">
        <div class="card">
          <div class="card-body">
          <?php foreach($actionsD as $actionD): ?>
              <?php if ($actionD == "AD"): ?>
                <a href="ajouterDepense.php" class="btn btn-info">Ajouter une dépense</a>
              <?php endif; ?>
          <?php endforeach; ?> 
            <?php if (isset($msg_dep)): ?>
                <div class="alert alert-success text-white">
                    <?= $msg_dep; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($depense_editer)): ?>
                <div class="alert alert-success text-white">
                    <?= $depense_editer; ?>
                </div>
            <?php endif; ?>
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">bénéficiaire</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">motifs</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant</th>
                  <?php foreach($actionsD as $actionD): ?>
                    <?php if ($actionD == "ED" || $actionD == "SD"): ?>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                  <?php while ($depense = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td><?= $depense['date'] ?></td>
                      <td><?= $depense['beneficiaire'] ?></td>
                      <td><?= $depense['motif'] ?></td>
                      <td><?= $depense['mt'] ?> FCFA</td>
                      <td>
                          <?php foreach($actionsD as $actionD): ?>
                            <?php if ($actionD == "ED"): ?>
                              <a href="editerDepense.php?idD=<?= $depense['id']; ?>" class="btn btn-primary">Editer</a>
                            <?php endif; ?>
                            &nbsp;
                            <?php if ($actionD == "SD"): ?>
                              <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cette dépense de la liste ?');" href="supprimerDepense.php?idD=<?= $depense['id']; ?>" class="btn btn-danger">Supprimer</a>
                            <?php endif; ?>
                          <?php endforeach; ?>
                      </td>
                    </tr>
                  <?php endwhile; ?>
              </tbody>
            </table>
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