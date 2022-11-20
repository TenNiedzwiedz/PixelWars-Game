<?php
  use app\core\Application;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PixelWars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  </head>
  <body onload="showFlashMessage()">
    <header class="p-3 text-bg-dark">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
              <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
            </svg>
            <p style="margin: 10px; font-size: 1.5rem">PixelWars</p>
          </a>

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <?php //navbar ?>
          </ul>

          <div class="text-end">
            <a href="/register" class="btn btn-outline-warning">Załóż konto</a>
            <button data-bs-toggle="modal" data-bs-target="#loginFormModal" class="btn btn-warning">Zaloguj</button>
          </div>
        </div>
      </div>
    </header>

    <div class="container" style="padding: 2rem 0;">

      {{content}}

      <div class="modal fade" id="loginFormModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="changePixelModal">Zaloguj się</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $form = \app\core\form\Form::begin('/login', "post"); ?>
              <div class="modal-body">
                <?= $form->field($model, 'login'); ?>
                <?= $form->field($model, 'password')->passwordField(); ?>
                <div class="mb-3 text-center">
                  Nie masz konta? <a href='/register'>Zarejestruj się!</a>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                <button type="submit" class="btn btn-primary">Zaloguj</button>
              </div>
            <?= \app\core\form\Form::end(); ?>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <?php include_once  Application::$ROOT_DIR."/views/elements/flashMessages.php"; ?>
  </div>
  </body>
</html>
