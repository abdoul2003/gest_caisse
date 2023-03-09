<?php
session_start();
require_once "./database/functions.php";

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

$id = $user['id'];

$req = "SELECT * FROM users WHERE id!=$id";

$result = select($req);

?>
<?php include_once "header.php"; ?>

<?php include_once "navbar.php"; ?>

<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Utilisateurs</h6>
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
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Liste des utilisateurs</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nom</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">prénoms</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">active</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($user_db = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td>
                        <?= $user_db['nom']; ?>
                      </td>
                      <td>
                        <?= $user_db['prenom']; ?>
                      </td>
                      <td>
                        <?= $user_db['email']; ?>
                      </td>
                      <td>
                        <?php echo ($user_db['status'] == 1) ? 'Connecté' : 'Déconnecté'; ?>
                      </td>
                      <td>
                        <?php echo ($user_db['active'] == 1) ? 'Activé' : 'Désactivé'; ?>
                      </td>
                      <td>
                        <form action="active_user.php" method="post">
                          <input type="hidden" name="id_user" value="<?= $user_db['id'] ?>">
                          <button type="submit" name="submit" class="btn btn-info btn-sm"><?php echo ($user_db['active'] == 1) ? 'Désactivé' : 'Activé' ?></button>
                          &nbsp;
                          <a href="deleteUser.php?idU=<?= $user_db['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </form>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php include_once "footer.php"; ?>