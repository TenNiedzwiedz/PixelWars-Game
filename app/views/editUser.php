<div class="row justify-content-center">
  <div class="col-6">
    <h1>Edycja użytkownika</h1>
    <?php $form = \app\core\form\Form::begin('/edituser', "post"); ?>
      <?= $form->field($model, 'id')->hiddenField(); ?>
      <?= $form->field($model, 'login'); ?>
      <?= $form->select($model, 'userRole', ['Użytkownik' => 'user', 'Administrator' =>'admin']) ?>
      <div class="row mb-3">
        <div class="col-6">
          <a href="/changelog?object=users&id=<?= $model->id ?>" class="btn btn-outline-warning">Historia zmian</a>
        </div>
        <div class="col-6 text-end">
          <a href="/users" class="btn btn-outline-primary">Anuluj</a>
          <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
      </div>
    <?= \app\core\form\Form::end(); ?>
  </div>
</div>
