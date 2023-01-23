<?php
    class testUpdate {

        public static function test($data){
            $error = 0;
            if($data['naam'] == null || $data['naam'] == "" || $data['naam'] == "null" ){
                echo $data['naam'];
                echo json_encode(new statusResponse("error", "Naam is niet ingevuld"));
                $error++;
            }
            if($data['techniek'][0] == null || $data['techniek'][0] == "null"){
                echo json_encode(new statusResponse("error", "Geen techniek ingevuld"));
                $error++;
            }
            if($data['omschrijving'] == null || $data['omschrijving'] == "" || $data['omschrijving'] == "null" ){
                echo json_encode(new statusResponse("error", "Geen geldige omschrijving ingevuld!"));
                $error++;
            }
            if($error > 0){
                die();
            }
        }

    }