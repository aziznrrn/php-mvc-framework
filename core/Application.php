<?php

namespace app\core;

class Application
{
    public static $config;
    public static string $rootDir;
    public static string $viewsDir;
    public static string $controllersDir;
    public static string $modelsDir;

    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        
        self::$app = $this;
        self::$config = require_once __DIR__ . '/../config/config.php';
        self::$rootDir = self::$config['rootDir'];
        self::$viewsDir = self::$config['viewsDir'];
        self::$controllersDir = self::$config['controllersDir'];
        self::$modelsDir = self::$config['modelsDir'];
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}