<?php

class schaler{
    private $smaxWidth;
    private $smaxHeight;

    public function __construct($smaxWidth, $smaxHeight){
        $this->smaxWidth = $smaxWidth;
        $this->smaxHeight = $smaxHeight;
    }

    public function scale($img){
        $size = $this->getSize($img);
        $width = $size[0];
        $height = $size[1];
        $img = imagecreatefromstring(file_get_contents($img));
        $newImg = imagescale($img, $width, $height);
        return $newImg;
    }

    public function saveImg($img, $path, $type){
        $extension = $type;
        switch($extension){
            case "image/jpg":
                imagejpeg($img, $path);
                break;
            case "image/png":
                imagepng($img, $path);
                break;
            case "image/gif":
                imagegif($img, $path);
                break;
            default:
                echo "Error";
                echo $extension;
                die();
        }
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