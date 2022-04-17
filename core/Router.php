<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    public array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->method();
        
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return $this->pageNotFound();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();

            Application::$app->controller = $callback[0];
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function pageNotFound()
    {
        $this->response->setStatusCode(404);

        if (file_exists(Application::$viewsDir . '404.php')) {
            return $this->renderView('404');
        }

        return $this->renderContent('<h1>404 Page Not Found</h1>');
    }

    public function renderView($view, $params = []) {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderViewContent($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($content)
    {
        return str_replace('{{content}}', $content, $this->layoutContent());
    }

    public function layoutContent() {
        $layout = Application::$app->controller->layout;
        ob_start();
        require_once Application::$viewsDir . 'layouts/' . $layout . '.php';
        return ob_get_clean();
    }

    public function renderViewContent($view, $params = []) {
        extract($params);

        ob_start();
        require_once Application::$viewsDir . $view . '.php';
        return ob_get_clean();
    }
}