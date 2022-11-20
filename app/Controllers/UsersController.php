<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\RegisterUser;
use app\models\ChangePassword;

use app\core\table\Table;

class UsersController extends Controller
{

  public function registerUser(Request $request)
  {
    $user = new RegisterUser();

    if($request->isPost())
    {
      $body = $request->getBody();

      $user->loadData($body);

      if($user->validate() && $user->save())
      {
        Application::$app->session->setFlash('success', 'Dziękujemy za rejestrację! Możesz się teraz zalogować');
        Application::$app->response->redirect('/');
        exit;
      }
    }

    $params = [
        'model' => $user,
      ];

    return $this->render('registerForm', $params);
  }

  public function myProfile()
  {
    $id = Application::$app->session->get('userID');
    $user = new User();
    $user = $user::findOne(['id' => $id]);

    $params = [
      'user' => $user
    ];

    return $this->render('myProfile', $params);
  }

  public function usersList()
  {
    $usersList = User::findAll();

    $params = [
      'usersList' => $usersList
    ];

    return $this->render('usersList', $params);
  }

  public function changePassword(Request $request)
  {
    $body = $request->getBody();
    $id = Application::$app->session->get('userID');

    $user = new ChangePassword;

    if($request->isPost())
    {
      $user = $user::findOne(['id' => $id]);

      if($user->update(['id' => $user->id], $body))
      {
        Application::$app->session->setFlash('success', 'Hasło zostało zmienione');
        Application::$app->response->redirect('/myprofile');
        exit;
      }
    }

    $params = [
      'model' => $user
    ];
    return $this->render('changePassword', $params);
  }

  public function editUser(Request $request)
  {
    $body = $request->getBody();
    if(isset($body['id']))
    {
      $id = $body['id'];

      $user = new User();
      $user = $user::findOne(['id' => $id]);
    }

    if(!$user)
    {
      throw new \Exception('Użytkownik o podanym ID nie istnieje', 404);
    }

    if($request->isPost())
    {
      if($user->update(['id' => $user->id], $body))
      {
        Application::$app->session->setFlash('success', 'Zmiany zostały zapisane');
        Application::$app->response->redirect('/users');
        exit;
      }
    }

    $params = [
      'model' => $user
    ];
    return $this->render('editUser', $params);
  }

}
