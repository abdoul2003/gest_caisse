<?php
session_start();

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

$mdp = $user['mdp'];
$taille = strlen($mdp);

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Profile</h6>
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
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Information sur le profile</h6>
                </div>
              </div>
            </div>
            <div class="card-body text-center p-3">
              <hr class="horizontal gray-light my-2">
              <h3>Username: <?= $user['username']; ?></h3>
              <h3>Mot de passe: 
                <?php
                  for ($i=0; $i < $taille; $i++) { 
                    echo '*';
                  }
                ?>
              </h3>
              <a href="editer_prof.php?id_u=<?php echo $user['id']; ?>" class="btn btn-danger mt-2">Editer ton profile</a>
            </div>
          </div>
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
  </div>

<?php include_once "footer.php"; ?>