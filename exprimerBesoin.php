<?php
session_start();

if (isset($_SESSION['user_session'])) {

  $user = $_SESSION['user_session'];

} else {

  header('location: sign-in.php');

}

if (isset($_SESSION['besoin_ajouter'])) {

    $besoin_ajouter = $_SESSION['besoin_ajouter'];

    unset($_SESSION['besoin_ajouter']);

}

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Formulaire d'expression du besoin</h6>
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
            <form action="ajout_besoin.php" method="post">
                <?php if (isset($besoin_ajouter)): ?>
                    <div class="alert alert-success text-white">
                        <?= $besoin_ajouter; ?>
                    </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="designation">Désignation</label>
                            <input type="text" name="designation" class="form-control" placeholder="Désignation" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="qte">Quantité</label>
                            <input type="number" name="qte" class="form-control" placeholder="Quantité" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="prixU">Prix Unitaire Estimatif</label>
                            <input type="number" name="prixU" class="form-control" placeholder="Prix unitaire" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" placeholder="Date" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-secondary">Valider</button>
                        </div>
                    </div>
                </div>
            </form>
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