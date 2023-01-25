<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("Afbeelding.php");


class Project{

    private static $smaxWidth = 800;
    private static $smaxHeight = 600;
    private static $folder = "public/img/projecten/";
    private static $Afbeelding;

    public static function newProject($post){
        self::$Afbeelding = new Afbeelding(self::$smaxWidth, self::$smaxHeight, self::$folder);
        self::checkFields($post);
        self::saveProject($post, $_FILES);
    }

    public static function update($project){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    
        $stmt = $conn->prepare("UPDATE projecten SET projectNaam = ?, omschrijving = ? WHERE id = ?");
        $stmt->bind_param("sss", $project['naam'], $project['omschrijving'], $project['id']);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM projectenPivotTechnieken WHERE projectID = ?");
        $stmt->bind_param("s", $project['id']);
        $stmt->execute();

        self::saveTechnieken($project['technieken'], $project['id']);
        
        $conn->close();
    }

    public static function delete($project){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
    
        $stmt = $conn->prepare("DELETE FROM projecten WHERE id = ?");
        $stmt->bind_param("s", $project['id']);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM projectenPivotTechnieken WHERE projectID = ?");
        $stmt->bind_param("s", $project['id']);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM projectAfbeeldingen WHERE projectID = ?");
        $stmt->bind_param("s", $project['id']);
        $stmt->execute();

        $conn->close();
    }

    private static function saveProject($post, $afbeeldingen){
        $project = array();
        $project['naam'] = $post['projectNaam'];
        $project['omschrijving'] = $post['omschrijving'];
        $project['thumbnail'] = self::saveAfbeelding($afbeeldingen['thumbnail']);
        $project['github'] = $post['github'];
        $project['productLink'] = $post['productLink'];
        $projectID = self::saveProjectToDb($project);
        $afbeeldingsnamen = self::saveAfbeeldingen($afbeeldingen['afbeeldingen']);
        self::insertAfbeeldingen($afbeeldingsnamen, $projectID);
        self::saveTechnieken($post['technieken'], $projectID);
    }



    private static function saveProjectToDB($project){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("INSERT INTO projecten (projectNaam, omschrijving, thumbnail, github, productLink ) 
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $project['naam'], $project['omschrijving'], $project['thumbnail'], $project['github'], $project['productLink']);
        $stmt->execute();
        $projectID = $conn->insert_id;
        $conn->close();
        return $projectID;
    }

    private static function insertAfbeeldingen($afbeeldingen, $projectID){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("INSERT INTO projectAfbeeldingen (projectID, afbeelding) VALUES (?, ?)");

        foreach($afbeeldingen as $afbeelding){
            $stmt->bind_param("ss", $projectID, $afbeelding);
            $stmt->execute();
        }
    }

    private static function saveTechnieken($technieken, $projectID){
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $stmt = $conn->prepare("INSERT INTO projectenPivotTechnieken (techniekID, projectID) VALUES (?, ?)");
        foreach($technieken as $techniek){
            $stmt->bind_param("ss", $techniek, $projectID);
            $stmt->execute();
        }
    }

    private static function saveAfbeeldingen($afbeeldingen){
        $newNames = array();

        for($i = 0; $i < count($afbeeldingen['name']); $i++){
            $tmpfile = array(
                'name' => $afbeeldingen['name'][$i],
                'type' => $afbeeldingen['type'][$i],
                'tmp_name' => $afbeeldingen['tmp_name'][$i],
                'error' => $afbeeldingen['error'][$i],
                'size' => $afbeeldingen['size'][$i]
            );
            $newName = self::$Afbeelding->verwerk( $tmpfile );
            array_push($newNames, $newName);
        }
        return $newNames;
    }

    private static function saveAfbeelding($afbeelding){
        $newName = self::$Afbeelding->verwerk($afbeelding);
        return $newName;
    }

    private static function checkFields($post){
        self::projectNaam($post);
        self::projectAfbeelding($post);
        self::projectTechnieken($post);
    }

    private static function projectNaam($post){
        if(!isset($post['projectNaam'])){
            die("project naam niet gevonden");
        }
    }

    private static function projectAfbeelding(){
        for($i = 0; $i < count($_FILES['afbeeldingen']['name']); $i++){
            if($_FILES['afbeeldingen']['error'][$i] != 0){
                print_r($_FILES['afbeeldingen']);
                die("Afbeelding niet gevonden");
            }
            self::isTypeAllowed($_FILES['afbeeldingen']['type'][$i]);
            self::isSizeAllowed($_FILES['afbeeldingen']['size'][$i]);
        }
    }

    private static function projectTechnieken($post){
        if(!isset($post['technieken'])){
            die("project technieken niet gevonden");
        }
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