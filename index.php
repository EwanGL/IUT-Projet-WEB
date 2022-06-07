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
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0">
                        <img src="#" height="30" loading="lazy"/>
                    </a>
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
                            }
                        ?>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <!-- Icon -->
                    <a class="text-reset me-3" href="#">
                        <i class="fas fa-shopping-cart"></i>
                    </a>

                    
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="img/mdb-favicon.ico" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">My profile (<?php echo $_SESSION['login'] ?>)</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <section>
            <h2>Filtrer les résultats</h2>
            
            <form action="#" method="GET">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Principal" />
                    <label class="form-check-label" for="inlineRadio1">Principal</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Famille" />
                    <label class="form-check-label" for="inlineRadio1">Famille</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Professionnel" />
                    <label class="form-check-label" for="inlineRadio1">Professionnel</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="Autres" />
                    <label class="form-check-label" for="inlineRadio1">Autres</label>
                </div>
                
                <input type="submit" id='submit' value='Filtrer'>
            </form>
        </section>

        <?php

        include "function.php" ;
        
        if($_SESSION["status"] == NULL){
            session_destroy();
            header("Location: http://localhost/WEB2/IUT-Projet-WEB/connexion.php");
            die();
        }

        $madb = new PDO('sqlite:'.$_SERVER["DOCUMENT_ROOT"]."/WEB2/IUT-Projet-WEB/DB/database.sqlite") ;
        
        if (!empty($_GET)){
            // var_dump($_GET["inlineRadioOptions"]);
            $groups_filtre= $madb->quote($_GET["inlineRadioOptions"]);
            $query = 'SELECT * FROM Coordonnees WHERE idUsers LIKE '.$_SESSION["id"].' AND groups LIKE '.$groups_filtre.';';
            $result = $madb->query($query);
            $tb = "<tr>";
            
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
            $tb = "<tr>";
            
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

        echo "<table id='index_tab'>".$tb."</table>";
        ?>

        <script type="text/javascript" src="js/mdb.min.js"></script>
    </body>

</html>
