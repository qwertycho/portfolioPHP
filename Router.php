<?php

class Router
{

    public function match($path, $callback)
    {
        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            $callback();
        }
    }

    public function render($path, $file)
    {
        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            require __DIR__ . '/views/' . $file . '.php';
            die();
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
                header("HTTP/1.0 200 OK");
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
