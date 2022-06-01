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
}

function connection_log($login, $status){
    $ip = $_SERVER['REMOTE_ADDR'];

    $file = fopen("C:\Users\Ewan GRIGNOUX-LEVERT\Documents\Cours\WEB\WEB2\logs web projet\log.txt", "a");
    $tdate=getdate();
    $jour=sprintf("%02.2d",$tdate["mday"])."/".sprintf("%02.2d",$tdate["mon"])."/".$tdate["year"];
    $heure=sprintf("%02.2d",$tdate["hours"])."H".sprintf("%02.2d",$tdate["minutes"]);
    $d="[".$jour." à ".$heure."] ";
    fwrite($file, $d.$ip." ".$login." ".$status."\n");
    fclose($file);
}
?>