<?php

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
            $newHeight = $newWidth / $ratio;
        }else{
            $newHeight = $this->smaxHeight;
            $newWidth = $newHeight * $ratio;
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
        $extension = $afbeelding['type'];
        $this->saveImg($gdIMG, $newName, $extension);
        return $newName;
    }

    private function getSize($img){
        $afmetingen = getimagesize($img);
        if($afmetingen[0] > $afmetingen[1]){
            $width = $this->smaxWidth;
            $height = $this->smaxWidth / $afmetingen[0] * $afmetingen[1];
        } else {
            $height = $this->smaxHeight;
            $width = $this->smaxHeight / $afmetingen[1] * $afmetingen[0];
        }
        return array($width, $height);
    }

    public function saveImg($img, $name, $extension){
        $path = $this->folder . $name;
        imagepng($img, $path);
    }

    private function checkFolder(){
        if(!file_exists($this->folder)){
            echo $this->folder;
            mkdir($this->folder);
        }
    }

    private function getExtension($img){
        $afmetingen = getimagesize($img);
        switch($afmetingen["mime"]){
            case "image/jpeg":
                return "jpg";
            case "image/png":
                return "png";
            case "image/gif":
                return "gif";
            default:
                return "jpg";
        }
    }

}