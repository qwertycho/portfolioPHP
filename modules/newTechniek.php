<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// require_once("secret.php");
require_once("Afbeelding.php");

class Techniek{

    private static $maxWidth = 300;
    private static $maxHeight = 300;
    private static $Afbeelding;

    private static $uploadFolder = "public/img/technieken/";

    public static function update($post){
        self::$Afbeelding = new Afbeelding(self::$maxWidth, self::$maxHeight, self::$uploadFolder);
        self::checkFields($post);
        self::updateTechniek($post, $_FILES['afbeelding']);
    }
    
    private static function updateTechniek($post, $afbeelding){
        $techniek = array();
        $techniek['oldNaam'] = $_POST['id'];
        $techniek['naam'] = $post['techniek'];
        $techniek['afbeelding'] = self::$Afbeelding->verwerk($afbeelding);
        self::updateTechniekToDb($techniek);
    }

    private static function updateTechniekToDb($techniek){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("UPDATE technieken SET techniek = ?, afbeelding = ? WHERE techniek = ?");
        $stmt->bind_param("sss", $techniek['naam'], $techniek['afbeelding'], $_POST['id']);
        $stmt->execute();
        $stmt = $conn->prepare("UPDATE projectenPivotTechnieken set techniekID = ? WHERE techniekID = ?");
        $stmt->bind_param("ss", $techniek['naam'], $techniek['oldNaam']);
        $stmt->execute();
        unlink(self::$uploadFolder . $_POST['afbeeldingLink']);
    }

    public static function newTechniek($post){
        self::$Afbeelding = new Afbeelding(self::$maxWidth, self::$maxHeight, self::$uploadFolder);
        self::checkFields($post);
        self::saveTechniek($post, $_FILES['afbeelding']);
    }

    private static function saveTechniek($post, $afbeelding){
        $techniek = array();
        $techniek['naam'] = $post['techniek'];
        $techniek['afbeelding'] = self::$Afbeelding->verwerk($afbeelding);
        self::saveTechniekToDb($techniek);
    }

    private static function saveTechniekToDb($techniek){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("INSERT INTO technieken (techniek, afbeelding) VALUES (?, ?)");
        $stmt->bind_param("ss", $techniek['naam'], $techniek['afbeelding']);
        $stmt->execute();
    }

    private static function checkFields($post){
        self::techniekNaam($post);
        self::techniekAfbeelding();
    }

    private static function techniekNaam($post){
        if(!isset($post['techniek'])){
            die("techniek naam niet gevonden");
        }
    }

    private static function techniekAfbeelding(){
        if($_FILES['afbeelding']['error'] != 0){
            die("techniek afbeelding niet gevonden");
        }
        self::isTypeAllowed($_FILES['afbeelding']['type']);
        self::isSizeAllowed($_FILES['afbeelding']['size']);
    }

    private static function isTypeAllowed($ext){
        $allowed = array('image/jpg', 'image/jpeg', 'image/png');
        if(!in_array($ext, $allowed)){
            die("Bestandstype is niet toegestaan" . $ext);
        }
    }

    private static function isSizeAllowed($size){
        if($size > 100000000){
            die("Bestand is te groot");
        }
    }

}