
<nav>
<div class="container">
  <div class="row">
    <div class="col-4" >
      <h1 class="text-info">O'quiz</h1>
    </div>

    <div class="col-2 font-weight-bold">
      <div>
          <a href="<?= $router->generate('main_home') ?>">Accueil</a>
      </div>
    </div>

    <div class="col-2 font-weight-bold">
      <div>
            <?php if ($connectedUser !== false) : ?>
            <a href="<?= $router->generate('main_login') ?>">Mon compte</a>
            <?php else : ?>
          <a href="<?= $router->generate('main_signup') ?>">Inscription</a>
          <?php endif; ?>
      </div>
    </div>

    <div class="col-2 font-weight-bold">
      <div>
            <?php if ($connectedUser !== false) : ?>
            <a href="<?= $router->generate('main_logout') ?>">Déconnexion</a>
            <?php else : ?>
            <a href="<?= $router->generate('main_signin') ?>">Connexion</a>
            <?php endif; ?>
      </div>
    </div>

    <div class="col-2 font-weight-bold">
      <div>

      </div>
    </div>
  </div>
</div>
</nav>
