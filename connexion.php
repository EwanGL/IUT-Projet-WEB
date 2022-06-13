<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Connexion</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="script.js"></script>
        
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css%22/%3E">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap%22/%3E">
        <link rel="stylesheet" href="css/mdb.min.css" type="text/css"/>

    </head>
        
    <body>
        <h1>Bienvenue sur Contacts</h1>
        <section id="co_form">
            <form action="#" method="POST" onsubmit="return verifyPassword()" id="connect_form">
                <h2>Connexion</h2>
                
                <div class="form-outline">
                    <input type="text"  name="username" class="form-control" placeholder="Nom d'utilisateur" require/>
                </div>

                <label><b></b></label>
                <div class="form-outline">
                    <input type="password" name="password" id = "co_password"class="form-control" placeholder="Mot de passe" require/>
                </div>

                <input type="submit" class="btn btn-primary btn-rounded" id="co_button" value='LOGIN'>
            </form>
            <?php
                include "function.php" ;

                if(!empty($_POST) && isset($_POST['username']) && isset($_POST['password'])){
                    
                    $login = $_POST['username'];
                    $passwd = $_POST['password'];

                    if(UserConnect($login,$passwd) == true){
                        
                        // $query = "SELECT status FROM users WHERE login = ".$login." AND passwd = ".$passwd.";" ;
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
                        
                        header("Location: index.php");
                        die();
                    }
                    
                    else{
                        echo '<p>failed</p>';
                        connection_log($login, "");
                    }
                }
            ?>
        </section>
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <footer class="bg-light text-center text-lg-start">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-dark" href="https://mdbootstrap.com/">GRIGNOUX-LEVERT Ewan</a>
            </div>
            <!-- Copyright -->
        </footer>
    </body>
</html>
