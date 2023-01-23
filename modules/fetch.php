<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Fetch
{

    public static function getProjecten()
    {
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);

        $projectenSQL = "SELECT * from projecten";
        $projecten = mysqli_query($conn, $projectenSQL);
        $projecten = $projecten->fetch_all(MYSQLI_ASSOC);
        return $projecten;
    }

    public static function getProject($id)
    {
        global $selectedProject;
        global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);


        $getSQL = "SELECT * from projecten WHERE ID = " . $id;
        $selectedProject = mysqli_query($conn, $getSQL);
        $selectedProject = $selectedProject->fetch_all(MYSQLI_ASSOC);

        $selectedProject = array_values($selectedProject)[0];

        $getSQL = "SELECT techniekID AS techniek from projectenPivotTechnieken WHERE projectID = " . $id;
        $selectedtTechnieken = mysqli_query($conn, $getSQL);
        $selectedProject['technieken'] = $selectedtTechnieken->fetch_all(MYSQLI_ASSOC);

        $getSQL = "SELECT afbeelding from projectAfbeeldingen WHERE projectID = " . $id;
        $selectedtAfbeeldingen = mysqli_query($conn, $getSQL);
        $selectedProject['afbeeldingen'] = $selectedtAfbeeldingen->fetch_all(MYSQLI_ASSOC);

        return $selectedProject;
    }

    public static function getTechnieken()
    {
        global $keys;

        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
        $techniekenSQL = "SELECT techniek AS techniek, afbeelding AS thumbnail from technieken";
        $technieken = $conn->query($techniekenSQL);
        $technieken = $technieken->fetch_all(MYSQLI_ASSOC);
        return $technieken;
    }

    public static function getSelectedTechnieken($id)
    {
       global $keys;
        $conn = new mysqli($keys->DB_HOST, $keys->DB_USER, $keys->DB_PASS, $keys->DB_NAME);
 

        $techniekenSQL = "SELECT techniekID AS techniek from projectenPivotTechnieken WHERE projectID = " . $id;
        $technieken = mysqli_query($conn, $techniekenSQL);
        $technieken = $technieken->fetch_all(MYSQLI_ASSOC);
        return $technieken;
    }
}
