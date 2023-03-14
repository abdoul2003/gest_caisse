<?php
session_start();
require_once "database/functions.php";

$idD = isset($_GET['idD']) ? $_GET['idD'] : 0;

$query = "SELECT * FROM depenses WHERE id=$idD";
$result = select($query);
$result = mysqli_fetch_assoc($result);

if (isset($_SESSION['user_session'])) {

  $user = $_SESSION['user_session'];

} else {

  header('location: sign-in.php');

}


?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Edition d'une dépense</h6>
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
            <form action="edit_depense.php" method="post">
                
                <input type="hidden" value="<?= $result['id'] ?>" name="id" class="form-control">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" value="<?= $result['date'] ?>" name="date" class="form-control" placeholder="Date" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="benefi">Bénéficiaire</label>
                            <input type="text" value="<?= $result['beneficiaire'] ?>" name="benefi" class="form-control" placeholder="Bénéficiaire" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="montant">Montant</label>
                            <input type="number" value="<?= $result['mt'] ?>" name="montant" class="form-control" placeholder="Montant" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="motif">Motifs</label>
                            <textarea name="motif" id="motif" cols="30" rows="10" class="form-control"><?= $result['motif'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-secondary">Sauvegarder</button>
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