
<style>
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
    img.d-inline-block.align-top {
    margin-left: 20px;
}
</style>
<header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="images/ubicon.png" width="40" height="40" class="d-inline-block align-top" alt="Logo">
  </a>

  <div class="mx-auto">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/UBLC_Reservation/home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/UBLC_Reservation/contact.php">Contact</a>
      </li>
    </ul>
  </div>

  <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?= $_SESSION['role'] ?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="#"><?= $_SESSION['role'] ?></a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
  </div>
</nav>
</header>