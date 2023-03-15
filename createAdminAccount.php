<?php
session_start();
require_once "database/functions.php";

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
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <title>
    Créer un compte
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="./assets/css/bootstrap.min.css"> -->
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link id="pagestyle" href="./assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">

    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

    <h6 class="font-weight-bolder mb-0 text-center">Créer votre compte</h6>

      <div class="container">
      <div class="card z-index-0">
              <div class="card-body">
                <form role="form text-left" action="admin_account.php" method="POST">
                  
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