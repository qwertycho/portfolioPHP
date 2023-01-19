<?php

// require_once("secret.php");
require_once("Afbeelding.php");

class Techniek{

    private $smaxWidth = 300;
    private $smaxHeight = 300;
    private $Afbeelding;

    private $uploadFolder = "public/img/technieken/";

    public function __construct(){
        $this->Afbeelding = new Afbeelding($this->smaxWidth, $this->smaxHeight, $this->uploadFolder);
    }

    public function newTechniek($post){
        $this->Afbeelding = new Afbeelding($this->smaxWidth, $this->smaxHeight, $this->uploadFolder);
        $this->checkFields($post);
        $this->saveTechniek($post, $_FILES['afbeelding']);
    }

    private function saveTechniek($post, $afbeelding){
        $techniek = array();
        $techniek['naam'] = $post['techniek'];
        $techniek['afbeelding'] = $this->Afbeelding->verwerk($afbeelding);
        $this->saveTechniekToDb($techniek);
    }

    private function saveTechniekToDb($techniek){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("INSERT INTO technieken (techniek, afbeelding) VALUES (?, ?)");
        $stmt->bind_param("ss", $techniek['naam'], $techniek['afbeelding']);
        $stmt->execute();
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