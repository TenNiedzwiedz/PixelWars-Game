<?php

namespace app\core\form;

use app\core\Model;

class Field
{
  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_NUMBER = 'number';
  public const TYPE_HIDDEN = 'hidden';

  public string $type;
  public Model $model;
  public string $attribute;

  public function __construct(Model $model, string $attribute)
  {
    $this->type = self::TYPE_TEXT;
    $this->model = $model;
    $this->attribute = $attribute;
  }

  public function __toString()
  {
    if($this->type == self::TYPE_HIDDEN)
    {
      return sprintf('
        <input type="%s" name="%s" value="%s">
      ',
        $this->type,
        $this->attribute,
        $this->model->{$this->attribute}
      );
    } else {
      return sprintf('
        <div class="mb-3">
          <label  class="form-label">%s</label>
          <input type="%s" name="%s" value="%s" class="form-control %s">
          <div class="invalid-feedback">
            %s
          </div>
        </div>
      ',
        ($this->type == self::TYPE_HIDDEN) ? '' : $this->model->getLabel($this->attribute),
        $this->type,
        $this->attribute,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        $this->model->getFirstError($this->attribute)
      );
    }
  }

  public function passwordField()
  {
    $this->type = self::TYPE_PASSWORD;
    return $this;
  }

  public function hiddenField()
  {
    $this->type = self::TYPE_HIDDEN;
    return $this;
  }

}