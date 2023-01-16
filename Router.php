<?php

class Router{

    public function any($path, $callback){
        $request = $_SERVER['REQUEST_URI'];
        if($request == $path){
            $callback();
        }
    }

    public function route($path, $callback){
        $request = $_SERVER['REQUEST_URI'];
        if(str_starts_with($request, $path)){
            $callback();
        }
    }

    public function params($path, $callback){
        $request = $_SERVER['REQUEST_URI'];
        if(str_starts_with($request, $path)){
            $params = explode($path, $request);
            if(strlen($params[1])){
                $callback($params[1]);
            }
        }

    }
}

$Router = new Router;