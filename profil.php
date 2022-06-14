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

                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" href="index.php">Page principale</a>
                        </li>
                        <?php 
                            if(isset($_SESSION) && $_SESSION['status']=='admin'){
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="insertion.php">Insertion</a>';
                                echo '</li>';
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="modification.php">Modification</a>';
                                echo '</li>';
                            }
                        ?>
                    </ul>
                    <!-- Left links -->
                </div>
            </div>
        </nav>

        <h1>Mon Profil</h1>

        <section id="sec_profil">
            <h2>Mes infos</h2>
            
            <?php
            session_start();
            
            if($_SESSION["status"] == NULL){
                session_destroy();
                header("Location: connexion.php");
                die();
            }

            
            $login = $_SESSION["login"];
            $img = $_SESSION["img"];
            echo "<img src='$img' alt='user' width='100' height='100'>";
            echo "<p>Nom d'utilisateur : $login</p>";
            
            echo "<button type='button' class='btn btn-primary btn-rounded' onclick='window.location.href = 'logout.php';' >Se déconnecter</button>";
            ?>
            
        
        </section>
        <footer class="bg-light text-center text-lg-start">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-dark" href="https://github.com/EwanGL">GRIGNOUX-LEVERT Ewan</a>
            </div>
            <!-- Copyright -->
        </footer>
    </body> 
</html>