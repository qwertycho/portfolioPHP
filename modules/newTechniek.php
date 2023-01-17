<?php

require_once("secret.php");

class Techniek{

    private $uploadFolder = "public/img/technieken/";

    public function __construct(){
    }

    public function newTechniek($post){
        $this->checkFields($post);
        $this->saveTechniek($post, $_FILES['afbeelding']);
    }

    private function saveTechniek($post, $afbeelding){
        $techniek = array();
        $techniek['naam'] = $post['techniek'];
        $techniek['afbeelding'] = $this->saveAfbeelding($afbeelding);
        $this->saveTechniekToDb($techniek);
    }

    private function saveTechniekToDb($techniek){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("INSERT INTO technieken (techniek, afbeelding) VALUES (?, ?)");
        $stmt->bind_param("ss", $techniek['naam'], $techniek['afbeelding']);
        $stmt->execute();
    }

    private function saveAfbeelding($afbeelding){
        $newName = time() . $afbeelding['name'];
        $this->writeFile($afbeelding['tmp_name'], $newName);
        return $newName;
    }

    private function writeFile($tmpName, $newName){
        $this->checkFolder();
        if(!move_uploaded_file($tmpName, $this->uploadFolder . $newName)){
            die("Afbeelding niet opgeslagen");
        }
    }

    private function checkFolder(){
        if(!file_exists($this->uploadFolder)){
            echo $this->uploadFolder;
            mkdir($this->uploadFolder);
        }
    }

    private function checkFields($post){
        $this->techniekNaam($post);
        $this->techniekAfbeelding();
    }

    private function techniekNaam($post){
        if(!isset($post['techniek'])){
            die("techniek naam niet gevonden");
        }
    }

    private function techniekAfbeelding(){
        if($_FILES['afbeelding']['error'] != 0){
            die("techniek afbeelding niet gevonden");
        }
        $this->isTypeAllowed($_FILES['afbeelding']['type']);
        $this->isSizeAllowed($_FILES['afbeelding']['size']);
    }

    private function isTypeAllowed($ext){
        $allowed = array('image/jpg', 'image/jpeg', 'image/png');
        if(!in_array($ext, $allowed)){
            die("Bestandstype is niet toegestaan" . $ext);
        }
    }

    private function isSizeAllowed($size){
        if($size > 100000000){
            die("Bestand is te groot");
        }
    }

}