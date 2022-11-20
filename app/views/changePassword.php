<div class="row justify-content-center">
  <div class="col-6">
    <h1>Zmiana hasła</h1>
    <?php $form = \app\core\form\Form::begin('/changepassword', "post"); ?>
      <?= $form->field($model, 'password')->passwordField(); ?>
      <?= $form->field($model, 'newPassword')->passwordField(); ?>
      <?= $form->field($model, 'confirmNewPassword')->passwordField(); ?>
      <a href="/myprofile" class="btn btn-secondary">Anuluj</a>
      <button type="submit" class="btn btn-primary">Zmień hasło</button>
    <?= \app\core\form\Form::end(); ?>
  </div>
</div>
