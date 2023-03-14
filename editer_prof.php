<?php
session_start();
require_once "database/functions.php";

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

if (isset($_SESSION['mdp_incorrect'])) {
  $mdp_incorrect = $_SESSION['mdp_incorrect'];
  unset($_SESSION['mdp_incorrect']);
}

if (isset($_SESSION['username_incorrect'])) {
  $username_incorrect = $_SESSION['username_incorrect'];
  unset($_SESSION['username_incorrect']);
}

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Edition de profile</h6>
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
            <a href="profile.php" class="btn btn-primary btn-sm">Retourner sur le profile</a>
            <form action="edit_prof.php" method="POST">

              <?php if(isset($mdp_incorrect)): ?>

                <div class="alert alert-danger text-white">
                  <?= $mdp_incorrect; ?>
                </div>

              <?php endif; ?>

              <?php if(isset($username_incorrect)): ?>

                <div class="alert alert-danger text-white">
                  <?= $username_incorrect; ?>
                </div>

              <?php endif; ?>
              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="" class="form-label">Nouveau Username</label>
                      <input type="text" name="username" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="" class="form-label">Nouveau Mot de passe</label>
                      <input type="password" name="mdp" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="" class="form-label">Confirmer votre mot de passe</label>
                      <input type="password" name="mdp_confirm" class="form-control" required>
                  </div>
                </div>
              </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-dark">Sauvegarder</button>
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