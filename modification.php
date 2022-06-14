<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="script.js"></script>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css%22/%3E">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap%22/%3E">
        <link rel="stylesheet" href="css/mdb.min.css" />

        <script src="https://www.google.com/recaptcha/api.js"></script>

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
                                <a class="dropdown-item" href="profil.php">My profile (<?php echo $_SESSION['login'] ?>)</a>
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
            <h1>Modifier un contact</h1>
            

            <form action="#" method="GET" id="select_form">
                <h2>Sélectionner un contact à modifier</h2>
                <div class="input-group" id="select_form_div">
                    <div class="form-outline">
                        <input type="search" id="form1" name="search" class="form-control" require/>
                        <label class="form-label" for="form1">Email</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-rounded">
                        <img src="img/search.png" alt="search icon" loading="lazy">
                    </button>
                </div>
            </form>
        </section>

        <?php

        include "function.php" ;
        
        if($_SESSION["status"] == NULL){
            session_destroy();
            header("Location: connexion.php");
            die();
        }
        else if ($_SESSION["status"] != "admin"){
            header("Location: index.php");
            die();
        }

        if(!empty($_GET) ) {
            $infos = selectContact($_GET["search"]);
        // var_dump($infos[0]);
        $infos = $infos[0];

        
        
        echo '<form id="modif_form" action="#" method="POST" class="row g-3 needs-validation" novalidate onsubmit="return verifyInsertForm()">
        <div class="col-md-4">
            <div class="form-outline">
            <input type="text" class="form-control" id="validationCustom05" value="'.$infos["prenom"].'" name="name" required /> 
            <label for="validationCustom01" class="form-label">Prénom</label>
            <div class="valid-feedback">Looks good!</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-outline">
            <input type="text" class="form-control" id="validationCustom06" value="'.$infos["nom"].'" name="last_name" required />
            <label for="validationCustom02" class="form-label">Nom</label>
            <div class="valid-feedback">Looks good!</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-outline">
            <input type="text" class="form-control" id="validationCustom07" value="'.$infos["phoneNumber"].'" name="phone" required />
            <label for="validationCustom02" class="form-label">Numéro de téléphone</label>
            <div class="valid-feedback">Looks good!</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-outline">
            <input type="text" class="form-control" id="validationCustom08" value="'.$infos["email"].'" name="email" required />
            <label for="validationCustom02" class="form-label">Email</label>
            <div class="valid-feedback">Looks good!</div>
            </div>
        </div>';
        
        if ($infos['groups'] == "Principal"){
            echo '
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio5" checked value="Principal" />
                <label class="form-check-label" for="inlineRadio1">Principal</label>
            </div>

            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio6" value="Famille" />
                <label class="form-check-label" for="inlineRadio1">Famille</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio7" value="Travail" />
                <label class="form-check-label" for="inlineRadio1">Professionnel</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio8" value="Autre" />
                <label class="form-check-label" for="inlineRadio1">Autres</label>
            </div>';
        }
        if ($infos['groups'] == "Famille"){
            echo '
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio5"  value="Principal" />
                <label class="form-check-label" for="inlineRadio1">Principal</label>
            </div>

            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio6" checked value="Famille" />
                <label class="form-check-label" for="inlineRadio1">Famille</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio7" value="Travail" />
                <label class="form-check-label" for="inlineRadio1">Professionnel</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio8" value="Autre" />
                <label class="form-check-label" for="inlineRadio1">Autres</label>
            </div>';
        }
        if ($infos['groups'] == "Travail"){
            echo '
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio5"  value="Principal" />
                <label class="form-check-label" for="inlineRadio1">Principal</label>
            </div>

            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio6" value="Famille" />
                <label class="form-check-label" for="inlineRadio1">Famille</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio7" checked value="Travail" />
                <label class="form-check-label" for="inlineRadio1">Professionnel</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio8" value="Autre" />
                <label class="form-check-label" for="inlineRadio1">Autres</label>
            </div>';
        }
        
        if ($infos['groups'] == "Autre"){
            echo '
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio9"  value="Principal" />
                <label class="form-check-label" for="inlineRadio1">Principal</label>
            </div>

            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio10" value="Famille" />
                <label class="form-check-label" for="inlineRadio1">Famille</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio11" value="Travail" />
                <label class="form-check-label" for="inlineRadio1">Professionnel</label>
            </div>
            
            <div class="col-md-2 ins_radio">
                <input class="form-check-input" type="radio" name="groups" id="inlineRadio12" checked value="Autre" />
                <label class="form-check-label" for="inlineRadio1">Autres</label>
            </div>';
        }

        echo '
        <div class="col-md-12">
            <input class="btn btn-primary btn-rounded g-recaptcha" id="modif_button" type="submit" data-sitekey="6LfxP1EgAAAAAHBY8Cf5kujJtGR8OCf2c0V7Hpgf" data-callback="onSubmit" data-action="submit" value="Submit">
        </div>
        </form>';
        }

        if(!empty($_POST)){
            // var_dump($_POST);
            DbModif($_POST["name"], $_POST["last_name"], $_POST["email"], $_POST["phone"], $_POST["groups"], $_SESSION["id"]);
            echo '<script type="text/JavaScript"> grecaptcha.reset();location.reload(); </script>';
            echo "<script>ajaxModif();</script>";
        }
        ?>
        
        <script>
            function onSubmit(token) {
                document.getElementById("modif_form").submit();
            }
        </script>
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