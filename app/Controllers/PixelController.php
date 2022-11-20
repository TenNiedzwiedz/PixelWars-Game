<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\Pixel;

class PixelController extends Controller
{

  public function main()
  {
    $user = new User();
    $lastColors = [];
    if($userID = Application::$app->session->get('userID'))
    {
      $user = $user::findOne(['id' => $userID]);
      $lastColors = $user->getLastColors();
    }

    $params = [
      'model' => $user,
      'lastColors' => $lastColors
    ];
    return $this->render('main', $params);
  }

  public function changePixel(Request $request)
  {
    $body = $request->getBody();
    if(isset($body['id']))
    {
      $id = $body['id'];

      $pixel = new Pixel();
      $pixel = $pixel::findOne(['id' => $id]);
    }

    if(!$pixel)
    {
      throw new \Exception('Pixel o podanym ID nie istnieje', 404);
    }

    if($request->isPost())
    {
      $userID = Application::$app->session->get('userID');
      $user = new User();
      $user = $user::findOne(['id' => $userID]);

      if($pixels = $user->getPixels())
      {
        if($pixel->update(['id' => $pixel->id], $body))
        {
          Application::$app->session->setFlash('success', 'Kolor pixela nr '.$body['id'].' został zmieniony');

          $body = [
            'lastColors' => $user->setLastColors($body['color']),
            'pixels' => $pixels-1
          ];
          $user->update(['id' => $user->id], $body);
        }
      } else {
        Application::$app->session->setFlash('warning', 'Nie posiadasz wolnych pixeli do wykorzystania');
      }
    }
    Application::$app->response->redirect('/');
  }
}
