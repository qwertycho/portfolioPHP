<?php

class Router
{

    private function isPublic(){
        $request = $_SERVER['REQUEST_URI'];
        if (file_exists(__DIR__ . "/public" . $request)) {
            $file = __DIR__ . "/public" . $request;
            $file_extension = strtolower(substr(strrchr($file, "."), 1));
            
            switch ($file_extension) {
                case "html": $ctype = "text/html"; break;
                case "txt": $ctype = "text/plain"; break;
                case "css": $ctype = "text/css"; break;
                case "js": $ctype = "application/javascript"; break;
                case "json": $ctype = "application/json"; break;
                case "xml": $ctype = "application/xml"; break;
                case "swf": $ctype = "application/x-shockwave-flash"; break;
                case "flv": $ctype = "video/x-flv"; break;
                case "png": $ctype = "image/png"; break;
                case "jpe": case "jpeg": case "jpg": $ctype = "image/jpg"; break;
                case "gif": $ctype = "image/gif"; break;
                case "bmp": $ctype = "image/bmp"; break;
                case "ico": $ctype = "image/vnd.microsoft.icon"; break;
                case "tiff": $ctype = "image/tiff"; break;
                case "tif": $ctype = "image/tiff"; break;
                case "svg": $ctype = "image/svg+xml"; break;
                case "svgz": $ctype = "image/svg+xml"; break;
                case "zip": $ctype = "application/zip"; break;
                case "rar": $ctype = "application/x-rar-compressed"; break;
                case "exe": $ctype = "application/x-msdownload"; break;
                case "msi": $ctype = "application/x-msdownload"; break;
                case "cab": $ctype = "application/vnd.ms-cab-compressed"; break;
                case "mp3": $ctype = "audio/mpeg"; break;
                case "qt": case "mov": $ctype = "video/quicktime"; break;
                case "mp4": $ctype = "video/mp4"; break;
                case "mpeg": case "mpg": case "mpe": $ctype = "video/mpeg"; break;
                case "avi": $ctype = "video/x-msvideo"; break;
                case "wmv": $ctype = "video/x-ms-wmv"; break;
                case "mp2": $ctype = "audio/mpeg"; break;
                case "rm": $ctype = "application/vnd.rn-realmedia"; break;

            }
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false); 
            header("Content-Type: $ctype");
            header("Content-Disposition: attachment; filename=\"" . basename($file) . "\";" );
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($file));



            readfile($file);
            die();
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
