<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Connexion</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="script.js"></script>
        </head>
        
        <body>
            <section class="formulaires">
                <form action="verification.php" method="POST">
                    <h1>Connexion</h1>
                    
                    <label><b>Nom d utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                    <input type="submit" id='submit' value='LOGIN' >
                    <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                ?>
                </form>
        </section>
    </body>

</html>
