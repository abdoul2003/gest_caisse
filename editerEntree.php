<?php
session_start();
require_once "database/functions.php";

$idE = isset($_GET['idE']) ? $_GET['idE'] : 0;

$query = "SELECT * FROM entrees WHERE id=$idE";
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
          <h6 class="font-weight-bolder mb-0">Edition d'une entrée</h6>
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
            <form action="edit_entree.php" method="post">
                
                <input type="hidden" value="<?= $result['id'] ?>" name="id" class="form-control">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="source">Source</label>
                            <input type="text" name="source" value="<?= $result['source'] ?>" class="form-control" placeholder="Source" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="benefi">Bénéficiaire</label>
                            <input type="text" name="benefi" value="<?= $result['beneficiaire'] ?>" class="form-control" placeholder="Bénéficiaire" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="motif">Motif</label>
                            <input type="text" name="motif" value="<?= $result['motif'] ?>" class="form-control" placeholder="Motif" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" value="<?= $result['date'] ?>" class="form-control" placeholder="Date" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="mt_d">Montant demandé</label>
                            <input type="number" name="mt_d" value="<?= $result['mt_d'] ?>" class="form-control" placeholder="Montant demandé" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="mt_a">Montant accordé</label>
                            <input type="number" name="mt_a" value="<?= $result['mt_a'] ?>" class="form-control" placeholder="Montant accordé" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="moyen_paye">Moyen de payement</label>
                            <select name="moyen_paye" id="moyen_paye" class="form-control">
                                <option value="espèce" <?php echo ($result['type_paye'] == 'espèce') ? 'selected' : '' ?>>Espèce</option>
                                <option value="chèque" <?php echo ($result['type_paye'] == 'chèque') ? 'selected' : '' ?>>Chèque</option>
                                <option value="billet à ordre" <?php echo ($result['type_paye'] == 'billet à ordre') ? 'selected' : '' ?>>Billet à ordre</option>
                                <option value="autres" <?php echo ($result['type_paye'] == 'autres') ? 'selected' : '' ?>>Autres</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required><?= $result['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="remarque">Remarques</label>
                            <textarea name="remarque" id="remarque" class="form-control" required><?= $result['remarque'] ?></textarea>
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