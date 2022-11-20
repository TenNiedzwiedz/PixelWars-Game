<?php

  namespace app\models;

  use app\core\Application;
  use app\core\DbModel;

  class RegisterUser extends User{

    public string $id;
    public string $login = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $userRole = 'user';
    public string $pixels = '10';
    public string $pixelsLastUpdate;

    public function __construct()
    {
      $pixelsLastUpdate = new \DateTime();
      $this->pixelsLastUpdate = $pixelsLastUpdate->format('Y-m-d H:i:s');
    }

    public function save()
    {
      $this->password = password_hash($this->password, PASSWORD_DEFAULT);
      return parent::save();
    }

    public function rules(): array
    {
      return [
        'login' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
      ];
    }

    public function labels(): array
    {
      return [
        'login' => 'Login',
        'password' => 'Hasło',
        'confirmPassword' => 'Powtórz hasło'
        ];
    }

    public static function tableName()
    {
      return 'users';
    }

    public function getDbFields()
    {
      return ['login', 'password', 'userRole', 'pixels', 'pixelsLastUpdate'];
    }

    public function getChangelogFields()
    {
      return ['login', 'password', 'userRole'];
    }


  }
