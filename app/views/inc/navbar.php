<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
  <a class="navbar-brand" href="/pages/index"><?=SITE_NAME?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/pages/index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/pages/about">About</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
    <?php if (isset($_SESSION['id'])):?>
      <li class="nav-item">
        <a class="nav-link" href="#">Hello, <?=$_SESSION['name'];?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/users/logout">Logout</a>
      </li>
    <?php else:?>
      <li class="nav-item">
        <a class="nav-link" href="/users/register">Regisiter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/users/login">Login</a>
      </li>
    <?php endif;?>
    </ul>
  </div>
</nav>