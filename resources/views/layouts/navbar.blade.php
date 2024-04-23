<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <a class="btn btn-primary" href="/">Logout</a>
  </ul>

  <!-- Search form -->
  <form class="form-inline ml-3" action="/search" method="GET">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" name="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search fa-lg"></i>
        </button>
      </div>
    </div>
  </form>
</nav>
