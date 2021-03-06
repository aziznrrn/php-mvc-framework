<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';

    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    public function view($view, $params = [])
    {
        extract($params);
        return Application::$app->router->renderView($view, $params);
    }
}