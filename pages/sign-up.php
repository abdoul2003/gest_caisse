<?php
session_start();
require_once "../database/functions.php";

$req = "SELECT *
        FROM roles";
$res = select($req);
  


if (isset($_SESSION['msg_email_telephone'])) {
  $msg_email_telephone = $_SESSION['msg_email_telephone'];
}

if (isset($_SESSION['msg_create_account'])) {
  $msg_create_account = $_SESSION['msg_create_account'];
}

if (isset($_SESSION['comptable_exist'])) {
  $comptable_exist = $_SESSION['comptable_exist'];
}

if (isset($_SESSION['rac_exist'])) {
  $rac_exist = $_SESSION['rac_exist'];
}

if (isset($_SESSION['directeur_exist'])) {
  $directeur_exist = $_SESSION['directeur_exist'];
}


session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Page d'inscription
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="">
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Bienvenue!</h1>
              <p class="text-lead text-white">Inscrivez-vous.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-body">
                <form role="form text-left" action="sign-up-script.php" method="POST">
                  
                  <?php if (isset($msg_email_telephone)): ?>
                    <div class="alert alert-danger text-white">
                      <?= $msg_email_telephone; ?>
                    </div>
                  <?php endif; ?>

                  <?php if (isset($rac_exist)): ?>
                    <div class="alert alert-danger text-white">
                      <?= $rac_exist; ?>
                    </div>
                  <?php endif; ?>

                  <?php if (isset($directeur_exist)): ?>
                    <div class="alert alert-danger text-white">
                      <?= $directeur_exist; ?>
                    </div>
                  <?php endif; ?>

                  <?php if (isset($com)): ?>
                    <div class="alert alert-danger text-white">
                      <?= $com; ?>
                    </div>
                  <?php endif; ?>

                  <?php if (isset($msg_create_account)): ?>
                    <div class="alert alert-success text-white">
                      <?= $msg_create_account; ?>
                    </div>
                  <?php endif; ?>

                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nom" aria-label="Nom" name="nom" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Prénoms" aria-label="Prénoms" name="prenom" required>
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" required>
                  </div>
                  <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Numéro de téléphone" aria-label="telephone" aria-describedby="telephone-addon" name="telephone" required>
                  </div>
                  <div class="mb-3">
                    <select name="role" id="role" class="form-control">
                      <?php while($role = mysqli_fetch_assoc($res)): ?>
                        <option value="<?= $role['nom'] ?>"><?= $role['nom'] ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" min="4" placeholder="Mot de passe" aria-label="Password" aria-describedby="password-addon" name="mdp" required>
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
                  <p class="text-sm mt-3 mb-0">Déjà un compte? <a href="sign-in.php" class="text-dark font-weight-bolder">Se connecter</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>