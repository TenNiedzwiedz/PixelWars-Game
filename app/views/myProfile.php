<div class="row justify-content-center">
  <div class="col-6">
    <h1>Mój profil</h1>

    Login:<h4><?= $user->login ?></h4></br>
    Dostępne pixele:<h4><?= $user->pixels ?>/20</h4></br>
    <a href='/changepassword' class='btn btn-warning'>Zmień hasło</a>
  </div>
</div>
