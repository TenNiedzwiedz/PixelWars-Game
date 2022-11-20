<?php

  require_once __DIR__.'/../app/vendor/autoload.php';

  use app\core\Application;

  use app\Controllers\PixelController;
  use app\Controllers\AuthController;
  use app\Controllers\UsersController;
  use app\Controllers\ChangelogController;

  $app = new Application(dirname(__DIR__).'/app');

  // Routes declaration

  $app->router->get('/', [PixelController::class, 'main']);
  $app->router->post('/changePixel', [PixelController::class, 'changePixel']);

  $app->router->post('/login', [AuthController::class, 'login']);
  $app->router->get('/logout', [AuthController::class, 'logout']);
  $app->router->get('/register', [UsersController::class, 'registerUser']);
  $app->router->post('/register', [UsersController::class, 'registerUser']);

  $app->router->get('/myprofile', [UsersController::class, 'myProfile']);
  $app->router->get('/changepassword', [UsersController::class, 'changePassword']);
  $app->router->post('/changepassword', [UsersController::class, 'changePassword']);

  $app->router->get('/users', [UsersController::class, 'usersList']);
  $app->router->get('/edituser', [UsersController::class, 'editUser']);
  $app->router->post('/edituser', [UsersController::class, 'editUser']);

  $app->router->get('/changelog', [ChangelogController::class, 'showChangelog']);

  $app->run();

?>
