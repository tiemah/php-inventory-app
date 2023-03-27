<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#">Inventory</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Logged in as <?=$_SESSION['full_name']?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled text-light">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
        <a href="index.php?logout" class="btn btn-primary">Logout</a>
      </form>
    </div>
  </div>
</nav>