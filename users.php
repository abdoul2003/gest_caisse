<?php
session_start();
require_once "database/functions.php";

if (!isset($_SESSION['user_session'])) {

  header('location: sign-in.php');

} else {

  $user = $_SESSION['user_session'];

}

$query = "SELECT * FROM users WHERE role != 'caisse'";
$res = select($query);

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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">username</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">role</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($user = mysqli_fetch_assoc($res)): ?>
                    <tr>
                      <td><?= $user['username']; ?></td>
                      <td><?= $user['role']; ?></td>
                      <td>
                        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?');" class="btn btn-danger" href="deleteUser.php?idU=<?= $user['id']; ?>">Supprimer</a>
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