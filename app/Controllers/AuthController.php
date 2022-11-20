<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{

  public function login(Request $request)
  {
    $user = new User();
    $body = $request->getBody();

    if($user->login($body))
    {
      Application::$app->session->setFlash('success', 'Dziękujemy za zalogowanie');
      Application::$app->session->set('userID', $user->id);
      Application::$app->session->set('userRole', $user->userRole);

    } else {
      Application::$app->session->setFlash('danger', 'Wystapił błąd podczas logowania. Spróbuj ponownie');

    }

    Application::$app->response->redirect('/');
  }

  public function logout()
  {
    Application::$app->session->setFlash('success', 'Wylogowano pomyślnie');
    Application::$app->session->remove('userID');
    Application::$app->session->remove('userRole');
    Application::$app->response->redirect('/');
  }

}
