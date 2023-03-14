<?php
session_start();
require_once "database/functions.php";

if (isset($_SESSION['user_session'])) {

  $user = $_SESSION['user_session'];

} else {

  header('location: sign-in.php');

}

if (isset($_SESSION['entree_editer'])) {

  $entree_editer = $_SESSION['entree_editer'];

  unset($_SESSION['entree_editer']);

}

if (isset($_SESSION['msg_dep'])) {

  $msg_dep = $_SESSION['msg_dep'];

  unset($_SESSION['msg_dep']);

}


$query = "SELECT * FROM entrees";
$result = select($query);

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Entrées</h6>
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
    <a href="ajouterEntree.php" class="btn btn-info">Ajouter une entrée</a>
              <?php if (isset($msg_dep)): ?>
                  <div class="alert alert-success text-white">
                      <?= $msg_dep; ?>
                  </div>
              <?php endif; ?>
              <?php if (isset($entree_editer)): ?>
                  <div class="alert alert-success text-white">
                      <?= $entree_editer; ?>
                  </div>
              <?php endif; ?>
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">source</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">bénéficiaire</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">motif</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant demandé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">montant accordé</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">remarques</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">moyen de payement</th>
                    <?php if ($user['role'] == 'caisse'): ?>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                    <?php while ($entree = mysqli_fetch_assoc($result)): ?>
                      <tr>
                        <td><?= $entree['source'] ?></td>
                        <td><?= $entree['beneficiaire'] ?></td>
                        <td><?= $entree['motif'] ?></td>
                        <td><?= $entree['date'] ?></td>
                        <td><?= $entree['mt_d'] ?> FCFA</td>
                        <td><?= $entree['description'] ?></td>
                        <td><?= $entree['mt_a'] ?> FCFA</td>
                        <td><?= $entree['remarque'] ?></td>
                        <td><?= $entree['type_paye'] ?></td>
                        <?php if ($user['role'] == 'caisse'): ?>
                          <td>
                            <a href="editerEntree.php?idE=<?= $entree['id']; ?>" class="btn btn-primary">Editer</a>
                            &nbsp;
                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cette entrée de la liste ?');" href="supprimerEntree.php?idE=<?= $entree['id']; ?>" class="btn btn-danger">Supprimer</a>
                          </td>
                        <?php endif; ?>
                      </tr>
                    <?php endwhile; ?>
                </tbody>
              </table>
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