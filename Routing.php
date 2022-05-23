<?php

require_once __DIR__.'/controllers/DefaultController.php';

class Router {

    public static $routes;

    public static function get($url, $view)
    {
        self::$routes[$url] = $view;
    }

    static public function run(string $url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            // TODO render index page
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';
        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }
}
