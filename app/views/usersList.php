  Lista użytkowników
  <?php app\core\table\Table::table($usersList, ['id', 'login', 'userRole', 'pixels', 'pixelsLastUpdate']); ?>

  <?php app\core\table\Table::tableClickable('/edituser'); ?>
