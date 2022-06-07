<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Connexion</title>
        <meta charset="UTF-8">
        <link href="http://localhost/WEB2/IUT-Projet-WEB/style.css" rel="stylesheet" type="text/css">
        <script src="http://localhost/WEB2/IUT-Projet-WEB/script.js"></script>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        </head>
        
        <body>
            <section class="formulaires">
                <form action="#" method="POST" onsubmit="return verifyPassword()" id="connect_form">
                    <h1>Connexion</h1>
                    
                    <label><b>Nom d utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required></br>

                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" id="password" required></br>

                    <input type="submit" id='submit' value='LOGIN'>
                </form>
                <?php
                    include "function.php" ;

                    if(!empty($_POST) && isset($_POST['username']) && isset($_POST['password'])){
                        
                        $login = $_POST['username'];
                        $passwd = $_POST['password'];

                        if(UserConnect($login,$passwd) == true){
                            
                            $query = "SELECT status FROM users WHERE login = ".$login." AND passwd = ".$passwd.";" ;	
                            $madb = new PDO('sqlite:DB/database.sqlite'); 
                            $login= $madb->quote($login);
                            $passwd = $madb->quote($passwd);
                            $query = "SELECT * FROM Users WHERE login LIKE $login AND passwd LIKE $passwd;";
                            $result = $madb->query($query);
                            $row = $result->fetch();
                            
                            session_start();
                            $_SESSION["id"] = $row[0];
                            $_SESSION["status"] = $row[3];
                            $_SESSION["login"] = $row[1];
                            $_SESSION["passwd"] = $row[2];
                            
                            connection_log($_SESSION["login"], $_SESSION["status"]);
                            
                            header("Location: http://localhost/WEB2/IUT-Projet-WEB/index.php");
                            die();
                        }
                        
                        else{
                            echo '<p>failed</p>';
                            connection_log($login, "");
                        }
                    }
                ?>
        </section>
    </body>
</html>
