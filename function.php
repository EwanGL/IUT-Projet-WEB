<?php

    function UserConnect($login,$passwd){
        
        $retour = false ;
        $madb = new PDO('sqlite:'.$_SERVER["DOCUMENT_ROOT"]."/WEB2/IUT-Projet-WEB/DB/database.sqlite");
        $login= $madb->quote($login);
        $passwd = $madb->quote($passwd);
        $query = "SELECT * FROM Users WHERE login LIKE $login AND passwd LIKE $passwd;";
        $result = $madb->query($query); 
        $tableau_assoc = $result->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($query);
        //var_dump($tableau_assoc);
        if (sizeof($tableau_assoc)!=0){
            $retour = true;
        }
        return $retour;
    };

    function connection_log($login, $status){
        $ip = $_SERVER['REMOTE_ADDR'];

        $file = fopen("C:\Users\Ewan GRIGNOUX-LEVERT\Documents\Cours\WEB\WEB2\logs web projet\log.txt", "a");
        $tdate=getdate();
        $jour=sprintf("%02.2d",$tdate["mday"])."/".sprintf("%02.2d",$tdate["mon"])."/".$tdate["year"];
        $heure=sprintf("%02.2d",$tdate["hours"])."H".sprintf("%02.2d",$tdate["minutes"]);
        $d="[".$jour." à ".$heure."] ";
        fwrite($file, $d.$ip." ".$login." ".$status."\n");
        fclose($file);

        return 0;
    };

    function verifyCaptcha(){
        $secret = "6LfxP1EgAAAAANl2aqV3sWDqBbBRKGCqGbnmCXHH";
        $response = htmlspecialchars($_POST["g-recaptcha-response"]);
        $remoteip = $_SERVER["REMOTE_ADDR"];
        $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip^=$remoteip";

        $get = file_get_contents($request);
        $decode = json_decode($get, true);

        return ($decode["success"]);
    };

    function DbInsert($name, $last_name, $email, $phone, $groups, $id_user){

        if (verifyCaptcha() == true){
            $madb = new PDO('sqlite:'.$_SERVER["DOCUMENT_ROOT"]."/WEB2/IUT-Projet-WEB/DB/database.sqlite");
            $name= $madb->quote($name);
            $last_name= $madb->quote($last_name);
            $email= $madb->quote($email);
            $phone= $madb->quote($phone);
            $groups= $madb->quote($groups);
            $id = $_SESSION["id"];
            
            $query = "SELECT id FROM Coordonnees WHERE email = $email AND idUsers = $id;";
            $madb->query($query);
            $result = $madb->query($query); 
            $tableau_assoc = $result->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($tableau_assoc)!=0){
            echo "<p>Cette personne est déjà dans votre carnet</p>";
            }
            
            else{
                $query = "INSERT INTO Coordonnees (nom, prenom, phoneNumber, email, idUsers, groups, socialMedia) VALUES($last_name, $name, $phone, $email, $id_user, $groups,NULL);";
                $madb->query($query);
                echo "<p>Cette personne as été ajouté dans votre carnet</p>";
            }
        }
        else{
            echo '<p>Vous êtes un robot</p>';
        }

        
        
        return 0;
    };   
?>