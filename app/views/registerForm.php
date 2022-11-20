<div class="row justify-content-center">
  <div class="col-6">
    <h1>Utwórz konto</h1>
    <?php $form = \app\core\form\Form::begin('/register', "post"); ?>
      <?= $form->field($model, 'login'); ?>
      <?= $form->field($model, 'password')->passwordField(); ?>
      <?= $form->field($model, 'confirmPassword')->passwordField(); ?>
      <a href="/" class="btn btn-secondary">Anuluj</a>
      <button type="submit" class="btn btn-primary">Utwórz konto</button>
    <?= \app\core\form\Form::end(); ?>
  </div>
</div>
