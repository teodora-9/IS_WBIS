<?php


namespace app\core;


class Field
{
    public $model;
    public $attribute;
    public $type;

    public function __construct($model, $attribute, $type)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString()
    {
        return sprintf("
           <label for='%s'>%s</label>
            <input type='%s' name='%s' id='%s' value='%s' class='form-control %s'>
            <div class='invalid-feedback'>
            %s
            </div>
        "
            , $this->attribute
            , $this->model->labels()[$this->attribute]
            , $this->type
            , $this->attribute
            , $this->attribute
            , $this->model->{$this->attribute}
            , $this->model->existError($this->attribute) ? "is-invalid" : ''
            , $this->model->firstError($this->attribute)
        );
    }
}