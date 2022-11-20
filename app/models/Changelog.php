<?php

  namespace app\models;

  use app\core\DbModel;

  class Changelog extends DbModel {

    public string $id;
    public string $objectID;
    public string $fieldName;
    public string $oldValue;
    public string $newValue;

    public string $object = '';

    public function rules(): array
    {
      return [];
    }

    public function labels(): array
    {
      return [
        'id' => 'ID',
        'objectID' => 'ID objektu',
        'fieldName' => 'Nazwa pola',
        'oldValue' => 'Stara wartość',
        'newValue' => 'Nowa wartość',
        'date' => 'Data'
        ];
    }

    public static function tableName()
    {
      return $this->object.'changes';
    }

    public function getDbFields()
    {
      return ['objectID', 'fieldName', 'oldValue', 'newValue'];
    }

    public function getChangelogFields()
    {
      return [];
    }
  }
