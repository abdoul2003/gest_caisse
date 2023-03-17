<?php
session_start();
require_once "database/functions.php";

if (isset($_SESSION['user_session'])) {

  $user = $_SESSION['user_session'];

} else {

  header('location: sign-in.php');

}

$query = "SELECT * FROM profile";
$res = select($query);

$idU = isset($_GET['idU']) ? $_GET['idU'] : 0;

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Sélectionner le profile de l'utilisateur</h6>
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
            <div class="row">
                <form action="change_profile.php" method="post">

                  <input type="hidden" name="idU" value="<?= $idU; ?>">
                    
                    <div class="form-group mb-2">
                        <label for="profile" class="form-label">Profile</label>
                        <select name="profile" id="profile" class="form-control">
                        <?php while($profile = mysqli_fetch_assoc($res)): ?>
                            <option value="<?= $profile['profile'] ?>"><?= $profile['profile'] ?></option>
                        <?php endwhile;?>
                        </select>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                          <strong>Pages</strong>
                        </div>
                        <div class="col-md-6">
                          <strong>Actions</strong>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6">
                          <p>Entrées</p>
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="action_entrees[]" value="AE" id=""> Ajouter <br>
                          <input type="checkbox" name="action_entrees[]" value="SE" id=""> Supprimer <br>
                          <input type="checkbox" name="action_entrees[]" value="EE" id=""> Editer
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6">
                          <p>Dépenses</p>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" name="action_depenses[]" value="AD"> Ajouter <br>
                            <input type="checkbox" name="action_depenses[]" value="SD"> Supprimer <br>
                            <input type="checkbox" name="action_depenses[]" value="ED"> Editer
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6">
                          <p>Besoins</p>
                        </div>
                        <div class="col-md-6">
                          <input type="checkbox" name="action_besoins[]" id="" value="AB"> Ajouter <br>
                          <input type="checkbox" name="action_besoins[]" id="" value="ARB"> Accepter / Refuser <br>
                          <input type="checkbox" name="action_besoins[]" id="" value="APCB"> Approvisionner la caisse <br>
                          <input type="checkbox" name="action_besoins[]" id="" value="IB">Imprimer
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6">
                          <p>Statistiques</p>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" name="action_statistiques" id="" value="SS"> Supprimer
                        </div>
                    </div>
                    <hr>
                    <div class="form-group text-center">
                        <button type="submit" name="submit" class="btn btn-info">Attribuer</button>
                    </div>
                </form>
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
  </main>

<?php include_once "footer.php"; ?>