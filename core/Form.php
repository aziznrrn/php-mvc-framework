<?php

namespace app\core;

use Attribute;

class Form
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public static function attributes(Array $attributes)
    {
        $html = '';
        foreach ($attributes as $key => $value) {
            $html .= " $key=\"$value\"";
        }

        return $html;
    }

    public static function begin(string $action, string $method = 'POST', Array $attributes = [], Model $model)
    {
        $html = "<form action=\"$action\" method=\"$method\"";
        $html .= self::attributes($attributes);
        $html .= ">";

        echo $html;

        return new Form($model);
    }

    public function end()
    {
        echo '</form>';
    }

    public function field(string $type, string $name, string $label, string $value, string $placeholder = '', Array $attributes = [])
    {
        $value = $this->model->$name ?? $value;
        $error = $this->model->getFirstError($name);
        if ($error) {
            $attributes['class'] = $attributes['class'] ?? '';
            $attributes['class'] .= ' is-invalid';
        }

        $html = "<div class=\"form-group mb-3\">";
        $html .= "<label for=\"$name\">$label</label>";
        $html .= "<input type=\"$type\" name=\"$name\" id=\"$name\" value=\"$value\" placeholder=\"$placeholder\"";
        $html .= self::attributes($attributes);
        $html .= '>';
        if ($error) {
            $html .= "<small class=\"text-danger\">$error</small>";
        }
        $html .= '</div>';


        echo $html;
    }

    public static function button(string $type, string $name, string $label, Array $attributes = [])
    {
        $html = "<button type=\"$type\" name=\"$name\"";
        $html .= self::attributes($attributes);
        $html .= ">$label</button>";

        echo $html;
    }
}