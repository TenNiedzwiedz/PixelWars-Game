<?php

  namespace app\models;

  use app\core\DbModel;

  class Pixel extends DbModel {

    public string $id;
    public string $color =  '#e6e6e6';

    public function rules(): array
    {
      return [
        'color' => [self::RULE_REQUIRED]
      ];
    }

    public function labels(): array
    {
      return [
        'color' => 'Kolor'
        ];
    }

    public static function getDataArray()
    {
      $rows = 100;
      $columns = 100;

      $pixelList = self::findAll();

      $pixelID = 0;

      for($i = 0; $i < $rows; $i++)
      {
        for($j = 0; $j < $columns; $j++)
        {
          $dataArray[$i][$j] = $pixelList[$pixelID]->color;
          $pixelID++;
        }
      }

      return $dataArray;
    }

    public function setColor($color)
    {
      $this->color = $color;
    }

    public function update($where, $body=[])
    {
      $pixelCopy = clone $this;
      $this->loadData($body);
      if($result = parent::update($where))
      {
        $this->changelog($pixelCopy);
      }
      return $result;
    }

    public static function tableName()
    {
      return 'pixels';
    }

    public function getDbFields()
    {
      return ['color'];
    }

    public function getChangelogFields()
    {
      return ['color'];
    }

  }
