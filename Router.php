<?php

class Router
{

    private function isPublic(){
        $request = $_SERVER['REQUEST_URI'];
        if (file_exists(__DIR__ . "/public" . $request)) {
            $file = __DIR__ . "/public" . $request;
            $file_extension = strtolower(substr(strrchr($file, "."), 1));

            readfile($file);
            // die();
        }
    }

    public function match($path, $callback)
    {
        $this->isPublic();

        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            $callback();
            die();
        }
    }

    public function render($path, $file)
    {
        $this->isPublic();

        $request = $_SERVER['REQUEST_URI'];
        if ($request == $path) {
            require __DIR__ . '/views/' . $file . '.php';
            die();
        }
    }

    public function route($path, $Router)
    {
        $this->isPublic();

        $request = $_SERVER['REQUEST_URI'];
        if (str_starts_with($request, $path)) {
            require __DIR__ . '/routes/' . $Router . '.php';
            die();
        }
    }

    public function params($path, $callback)
    {
        $this->isPublic();

        $request = $_SERVER['REQUEST_URI'];
        if (str_starts_with($request, $path)) {
            $params = explode($path, $request);
            if (strlen($params[1])) {
                $callback($params[1]);
                die();
            }
        }
    }

    public function catch($path, $callback)
    {
        $callback();
        die();
    }

    public function setPublic($path)
    {
        $request = $_SERVER['REQUEST_URI'];
        if (str_starts_with($request, $path)) {
            if (!file_exists(__DIR__ . $path)) {
                header("HTTP/1.0 404 Not Found");
                die();
            } else {
                $file = __DIR__ . $path;
                readfile($file);
                die();
            }
        }
    }
}

$Router = new Router;
