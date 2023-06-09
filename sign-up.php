<?php
session_start();
require_once "database/functions.php";

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

if (isset($_SESSION['account_is_create'])) {
  $account_is_create = $_SESSION['account_is_create'];
  unset($_SESSION['account_is_create']);
}
if (isset($_SESSION['password_is_incorrect'])) {
  $password_is_incorrect = $_SESSION['password_is_incorrect'];
  unset($_SESSION['password_is_incorrect']);
}
if (isset($_SESSION['username_exist'])) {
  $username_exist = $_SESSION['username_exist'];
  unset($_SESSION['username_exist']);
}


?>
<?php include_once "header.php"; ?>
  <!-- End Navbar -->
  <?php include_once "navbar.php"; ?>

    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0">Créer un nouveau utilisateur</h6>
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
      <div class="container">
      <div class="card z-index-0">
              <div class="card-body">
                <form role="form text-left" action="sign-up-script.php" method="POST">
                  
                  <?php if(isset($account_is_create)): ?>
                    <div class="alert alert-success text-white">
                      <?= $account_is_create; ?>
                    </div>
                  <?php endif; ?>

                  <?php if(isset($password_is_incorrect)): ?>
                    <div class="alert alert-danger text-white">
                      <?= $password_is_incorrect; ?>
                    </div>
                  <?php endif; ?>

                  <?php if(isset($username_exist)): ?>
                    <div class="alert alert-danger text-white">
                      <?= $username_exist; ?>
                    </div>
                  <?php endif; ?>
                  
                  <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Confirmer votre mot de passe" name="mdp2" required>
                  </div>
                  <div class="text-center d-flex align-items-center">
                    <button type="submit" name="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">S'inscrire
                      &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                      <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                      <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    </button>
                  </div>
                </form>
              </div>
            </div>
      </div>
    </div>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script>
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>