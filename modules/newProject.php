<?php

class Project{


    public static function newProject($post){
        self::checkFields($post);
        self::saveProject($post, $_FILES);
    }

    private static function saveProject($post, $afbeeldingen){
        $project = array();
        $project['naam'] = $post['projectNaam'];
        $project['omschrijving'] = $post['omschrijving'];
        $project['thumbnail'] = self::saveAfbeelding($afbeeldingen['thumbnail']);
        $project['github'] = $post['github'];
        $project['productLink'] = $post['productLink'];
        $projectID = self::saveProjectToDb($project);
        $afbeeldingsnamen = self::saveAfbeeldingen($afbeeldingen);
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
        foreach($afbeeldingen['afbeeldingen']['name'] as $key => $name){
            $newName = time() . $name;
            self::writeFile($afbeeldingen['afbeeldingen']['tmp_name'][$key], $newName);
            $newNames[] = $newName;
        }
        return $newNames;
    }

    private static function saveAfbeelding($afbeelding){
            $newName = time() . $afbeelding['name'];
            self::writeFile($afbeelding['tmp_name'], $newName);
        
        return $newName;
    }

    private static function writeFile($tmpName, $newName){
        $uploadFolder = "public/img/projecten/";
        if(!file_exists($uploadFolder)){
            mkdir($uploadFolder);
        }
        if(!move_uploaded_file($tmpName, $uploadFolder . $newName)){
            die("Afbeelding niet opgeslagen");
        }
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
        for($i = 0; $i < count($_FILES); $i++){
            if($_FILES['afbeeldingen']['error'][$i] != 0){
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