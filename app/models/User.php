<?php

  namespace app\models;

  use app\core\Application;
  use app\core\DbModel;

  class User extends DbModel{

    public string $id;
    public string $login = '';
    public string $password = '';
    public string $userRole;
    public string $lastColors;
    public string $pixels;
    public string $pixelsLastUpdate;

    public function rules(): array
    {
      return [
        'login' => [self::RULE_REQUIRED],
        //'password' => [self::RULE_REQUIRED],
        'userRole' => [self::RULE_REQUIRED]
      ];
    }

    public function labels(): array
    {
      return [
        'id' => 'ID',
        'login' => 'Login',
        'password' => 'Hasło',
        'userRole' => 'Typ konta',
        'pixels' => 'Dostępne pixele',
        'pixelsLastUpdate' => 'Ostatnia aktualizacja pixeli'
        ];
    }

    public function login($body)
    {

      if(isset($body['login']) && isset($body['password']))
      {
        $login = $body['login'];
        $password = $body['password'];
      } else {
        return false;
      }

      $sql = "SELECT * FROM users WHERE login = '$login'";
      $statement = $this->prepare($sql);
      $statement->execute();

      $result = $statement->fetch();

      if($result)
      {
        if(password_verify($password, $result['password']))
        {
          $this->id = $result['id'];
          $this->userRole = $result['userRole'];
          return true;
        }
      }
      return false;

    }

    public function setLastColors($lastColor)
    {
      $lastColorsArray = json_decode($this->lastColors)? json_decode($this->lastColors) : [];
      if(!in_array($lastColor, $lastColorsArray))
      {
        array_unshift($lastColorsArray, $lastColor);
        if(count($lastColorsArray) > 5)
        {
          array_pop($lastColorsArray);
        }
      }
      return json_encode($lastColorsArray);
    }

    public function getLastColors()
    {
      return json_decode($this->lastColors);
    }

    public function getPixels()
    {
      return ($this->pixels > 0) ? $this->pixels : false;
    }

    public static function updatePixels(User $user)
    {
      $pixelsLastUpdate = new \DateTime($user->pixelsLastUpdate);
      $currentDate = new \DateTime();
      $interval = $currentDate->diff($pixelsLastUpdate);
      $interval = ($interval->days*24*60) + ($interval->h*60) + $interval->i;
      $pixels = $user->pixels;

      if($pixels >= 20)
      {
        $pixels = 20;
        $pixelsLastUpdate = new \DateTime();
      }
      elseif($interval > 5)
      {
        for($i = 5; $i <= $interval; $i=$i+5)
        {
          $pixels++;
        }

        if($pixels < 20)
        {
          $interval = $interval - $i + 5;
          $pixelsLastUpdate = new \DateTime("$interval minutes ago");
        } else {
          $pixels = 20;
          $pixelsLastUpdate = new \DateTime();
        }
      }

      $pixelsLastUpdate = $pixelsLastUpdate->format('Y-m-d H:i:s');

      $body = [
        'pixels' => $pixels,
        'pixelsLastUpdate' => $pixelsLastUpdate
        ];

      $user->update(['id' => $user->id], $body);

      return $user;
    }

    public static function findOne($where)
    {
      $user = parent::findOne($where);
      $user = self::updatePixels($user);
      return $user;
    }

    public function update($where, $body=[])
    {
      $userCopy = clone $this;
      $this->loadData($body);
      if($result = ($this->validate() && parent::update($where)))
      {
        $this->changelog($userCopy);
      }
      return $result;
    }

    public static function tableName()
    {
      return 'users';
    }

    public function getDbFields()
    {
      return ['login', 'password', 'userRole', 'lastColors', 'pixels', 'pixelsLastUpdate'];
    }

    public function getChangelogFields()
    {
      return ['login', 'userRole', 'lastColors', 'pixels'];
    }


  }
