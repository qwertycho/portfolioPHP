<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Afbeelding{
    private $smaxWidth;
    private $smaxHeight;
    private $folder;

    public function __construct($smaxWidth, $smaxHeight, $folder){
        $this->smaxWidth = $smaxWidth;
        $this->smaxHeight = $smaxHeight;
        $this->folder = $folder;
    }

    public function verwerk($file){
        $img = $this->imgageFactory($file);
        $name = $this->saveAfbeelding($img, $file);
        return $name;
    }

    private function newImageSize($size){
        $width = $size[0];
        $height = $size[1];
        $ratio = $width / $height;
        if($width > $height){
            $newWidth = $this->smaxWidth;
            $newHeight = round($newWidth / $ratio);

        }else{
            $newHeight = $this->smaxHeight;
            $newWidth = round($newHeight * $ratio);
        }
        return array($newWidth, $newHeight);
    }

    private function imgageFactory($file){
        $img = imagecreatefromstring(file_get_contents($file['tmp_name']));
        $size = $this->newImageSize(getimagesize($file['tmp_name']));
        $newImg = imagecreatetruecolor($size[0], $size[1]);
        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $size[0], $size[1], $transparent);
        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $size[0], $size[1], getimagesize($file['tmp_name'])[0], getimagesize($file['tmp_name'])[1]);
        return $newImg;
    }

    private function saveAfbeelding($gdIMG, $afbeelding){
        $this->checkFolder();
        $newName = time() . $afbeelding['name'];
        $this->saveImg($gdIMG, $newName);
        return $newName;
    }

    public function saveImg($img, $name){
        $path = $this->folder . $name;
        imagepng($img, $path);
    }

    private function checkFolder(){
        if(!file_exists($this->folder)){
            echo $this->folder;
            mkdir($this->folder);
        }
    }

}