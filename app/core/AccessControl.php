<?php

namespace app\core;

class AccessControl
{
  public static array $accessRules = [
    'guest' => ['main', 'login', 'registerUser'],
    'user' => ['main', 'login', 'logout', 'myProfile', 'changePassword', 'changePixel'],
    'admin' => ['main', 'login', 'logout', 'myProfile', 'changePassword', 'changePixel', 'usersList', 'editUser', 'showChangelog']
    ];

  public static function checkAccess($route)
  {
    $userRole = Application::$app->session->get('userRole') ?: 'guest';
    Application::$app->layout = $userRole;

    if (is_string($route)) {
      return in_array($route, self::$accessRules[$userRole]);
    }

    if (is_array($route)) {
      return in_array($route[1], self::$accessRules[$userRole]);
    }
  }
}
