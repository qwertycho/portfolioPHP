<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Router
{

    public function match($path, $callback)
    {
        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            $callback();
            exit();
        }
    }

    public function api($path, $file)
    {
        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            require __DIR__ . '/api/' . $file . '.php';
            exit();
        }
    }


    public function render($path, $file)
    {
        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            require __DIR__ . '/views/' . $file . '.php';
            exit();
        }
    }

    public function route($path, $Router)
    {
        $request = $_SERVER['REQUEST_URI'];
        if (str_starts_with($request, $path)) {
            require __DIR__ . '/routes/' . $Router . '.php';
        }
    }

    public function params($path, $callback)
    {
        $request = $_SERVER['REQUEST_URI'];
        if (str_starts_with($request, $path)) {
            $params = explode($path, $request);
            if (strlen($params[1])) {
                $callback($params[1]);
             } else {
                $callback(null);
             }
        }
    }

    public function catch($path, $callback)
    {
        $callback();
    }

    public function setPublic($path)
    {
        $request = $_SERVER['REQUEST_URI'];
        if (str_starts_with($request, $path)) {
            if (!file_exists(__DIR__ . $path)) {
                header("HTTP/1.0 404 Not Found");
            } else {
                $file = __DIR__ . $path;
                readfile($file);
                header("HTTP/1.0 200 OK");
            }
        }
    }
}

$Router = new Router;
