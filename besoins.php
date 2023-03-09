<?php
session_start();
require_once "./database/functions.php";

if (!isset($_SESSION['user'])) {
  header('location: ./pages/sign-in.php');
}else {
  $user = $_SESSION['user'];
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$req = "SELECT count(*) as nbrSo FROM societe";
$res = select($req);

$so = mysqli_fetch_assoc($res);

$nbrSo = $so['nbrSo'];

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">Besoins</h6>
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

        <h2>Ajouter un besoin <a href="listBesoins.php" class="btn btn-success float-end">Liste des besoins</a></h2>
        
        <form action="ajout_besoin.php" method="post">
            
            <?php if(isset($message)): ?>

                <div class="alert alert-success">
                    <?= $message; ?>
                </div>

            <?php endif; ?>

            <?php if ($nbrSo < 1): ?>

                <div class="form-group">
                    <label for="societe" class="form-label">Société</label>
                    <input type="text" name="societe" id="societe" placeholder="Nom de la société" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="motif" class="form-label">Motif</label>
                    <input type="text" name="motif" id="motif" placeholder="Motif" class="form-control" required>
                </div>

            <?php endif; ?>

            <div class="form-group">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" placeholder="Date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="designation" class="form-label">Désignation</label>
                <textarea name="designation" id="designation" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="qte" class="form-label">Quantité</label>
                <input type="number" name="qte" id="qte" placeholder="Quantité" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prix_uni" class="form-label">Prix unitaire estimatif</label>
                <input type="number" name="prix_uni" id="prix_uni" placeholder="Prix unitaire" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="montant_esti" class="form-label">Montant estimatif</label>
                <input type="number" name="montant_esti" id="montant_esti" placeholder="Montant" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary btn-sm" value='Ajouter' name="submit">
                &nbsp;
                <input type="reset" class="btn btn-danger btn-sm" value='Annuler'>
            </div>
        </form>
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