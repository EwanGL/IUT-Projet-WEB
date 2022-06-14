<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Acceuil</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="script.js"></script>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css%22/%3E">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap%22/%3E">
        <link rel="stylesheet" href="css/mdb.min.css" />

    </head>
        
    <body>
        <?php
            session_start();
        ?>


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

                    
                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="img/user.png" alt="user icon" loading="lazy">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="profil.php">Mon profil (<?php echo $_SESSION["login"] ?>)</a>
                        </li>
                        <li>
                            <a class="+" href="logout.php">Se déconnecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <h1>Mes contacts</h1>

        <section>
            <h2>Filtrer les résultats</h2>
            
            <form id="ind_form" action="#" method="GET">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Principal" />
                    <label class="form-check-label" for="inlineRadio1">Principal</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Famille" />
                    <label class="form-check-label" for="inlineRadio1">Famille</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Travail" />
                    <label class="form-check-label" for="inlineRadio1">Professionnel</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="Autre" />
                    <label class="form-check-label" for="inlineRadio1">Autres</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio13" value="Tout" />
                    <label class="form-check-label" for="inlineRadio1">Tout</label>
                </div>
                
                <input type="submit" class="btn btn-primary btn-rounded" id="ind_button" value='Filtrer'>
            </form>
        </section>

        <?php

        include "function.php" ;
        
        if($_SESSION["status"] == NULL){
            session_destroy();
            header("Location: connexion.php");
            die();
        }

        $madb = new PDO('sqlite:'.$_SERVER["DOCUMENT_ROOT"]."/WEB2/IUT-Projet-WEB/DB/database.sqlite") ;
        
        if (!empty($_GET)){
            if ($_GET["inlineRadioOptions"] == "Tout"){
                $query = 'SELECT * FROM Coordonnees WHERE idUsers LIKE '.$_SESSION["id"].';';
            }
            else{
                $groups_filtre= $madb->quote($_GET["inlineRadioOptions"]);
            $query = 'SELECT * FROM Coordonnees WHERE idUsers LIKE '.$_SESSION["id"].' AND groups LIKE '.$groups_filtre.';';
            }
           
            
            $result = $madb->query($query);
            $tb = "
                <tr>
                <th scope='col'>Nom</th>
                <th scope='col'>Prénom</th>
                <th scope='col'>Numéro de Téléphone</th>
                <th scope='col'>Email</th>
                <th scope='col'>Groupe</th>
                </tr>
                <tr>
            ";
            
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // var_dump($row);
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $phone = $row["phoneNumber"];
                $mail = $row["email"];
                $groups = $row["groups"];
                $tb .= "<td> $nom </td>";
                $tb .= "<td> $prenom </td>";
                $tb .= "<td> $phone </td>";
                $tb .= "<td> $mail </td>";
                $tb .= "<td> $groups </td>";
                $tb .= "</tr>";
            }
        }

        else {
            $query = 'SELECT * FROM Coordonnees WHERE idUsers LIKE '.$_SESSION["id"].' ;';
            $result = $madb->query($query);
            $tb = "
                <tr>
                <th scope='col'>Nom</th>
                <th scope='col'>Prénom</th>
                <th scope='col'>Numéro de Téléphone</th>
                <th scope='col'>Email</th>
                <th scope='col'>Groupe</th>
                </tr>
                <tr>
            ";
            
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // var_dump($row);
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $phone = $row["phoneNumber"];
                $mail = $row["email"];
                $groups = $row["groups"];
                $tb .= "<td> $nom </td>";
                $tb .= "<td> $prenom </td>";
                $tb .= "<td> $phone </td>";
                $tb .= "<td> $mail </td>";
                $tb .= "<td> $groups </td>";
                $tb .= "</tr>";
            }
        }

        echo "<div table-responsive>
            <table class='table table-striped ' id='index_tab'>
            $tb
            </table>";
        ?>

        <script type="text/javascript" src="js/mdb.min.js"></script>
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
