<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <link href="http://localhost/WEB2/IUT-Projet-WEB/style.css" rel="stylesheet" type="text/css">
        <script src="http://localhost/WEB2/IUT-Projet-WEB/script.js"></script>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        </head>
        
    <body>
        <?php
        session_start();
        
        if($_SESSION["status"] == NULL){
            session_destroy();
            header("Location: http://localhost/WEB2/IUT-Projet-WEB/connexion.php");
            die();
        }


		$madb = new PDO('sqlite:'.$_SERVER["DOCUMENT_ROOT"]."/WEB2/IUT-Projet-WEB/DB/database.sqlite") ;
		$query = 'SELECT * FROM Coordonnees WHERE idUsers LIKE '.$_SESSION["id"].' ;';
        $result = $madb->query($query);
 
		$ld = "<tr>";
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // var_dump($row);
			$nom = $row["nom"];
			$prenom = $row["prenom"];
            $phone = $row["phoneNumber"];
            $mail = $row["email"];
            $groups = $row["groups"];
			$ld .= "<td> $nom </td>";
			$ld .= "<td> $prenom </td>";
            $ld .= "<td> $phone </td>";
            $ld .= "<td> $mail </td>";
            $ld .= "<td> $groups </td>";
            $ld .= "</tr>";
		}
		echo "<table>".$ld."</table>";

        ?>
    </body>

</html>
