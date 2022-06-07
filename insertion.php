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

        <script src="https://www.google.com/recaptcha/api.js"></script>

    </head>
    <body>
        <?php
            session_start();
            if($_SESSION["status"] == NULL){
                session_destroy();
                header("Location: http://localhost/WEB2/IUT-Projet-WEB/connexion.php");
                die();
            }

            else if ($_SESSION["status"] != "admin"){
                header("Location: http://localhost/WEB2/IUT-Projet-WEB/index.php");
                die();
            }
        ?>

        <h1>Ajoutez un contact</h1>

        
        <form id="insert_form" action="#" method="POST" class="row g-3 needs-validation" novalidate onsubmit="return verifyInsertForm()">
            <div class="col-md-4">
                <div class="form-outline">
                <input type="text" class="form-control" id="validationCustom01" value="" name="name" required /> 
                <label for="validationCustom01" class="form-label">Prénom</label>
                <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                <input type="text" class="form-control" id="validationCustom02" value="" name="last_name" required />
                <label for="validationCustom02" class="form-label">Nom</label>
                <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                <input type="text" class="form-control" id="validationCustom03" value="" name="phone" required />
                <label for="validationCustom02" class="form-label">Numéro de téléphone</label>
                <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-outline">
                <input type="text" class="form-control" id="validationCustom04" value="" name="email" required />
                <label for="validationCustom02" class="form-label">Email</label>
                <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="group" id="flexRadioDefault1" checked value="Principal"/>
                <label class="form-check-label" for="flexRadioDefault1">Principal</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="group" id="flexRadioDefault2"  value="Famille"/>
                <label class="form-check-label" for="flexRadioDefault2">Famille</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="group" id="flexRadioDefault2"  value="Travail"/>
                <label class="form-check-label" for="flexRadioDefault2">Professionnel</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="group" id="flexRadioDefault2"  value="Autres"/>
                <label class="form-check-label" for="flexRadioDefault2">Autres</label>
            </div>


            <div class="col-12">
                <button class="btn btn-primary g-recaptcha" type="submit" data-sitekey="6LfxP1EgAAAAAHBY8Cf5kujJtGR8OCf2c0V7Hpgf" data-callback='onSubmit' data-action='submit'>Submit</button>
            </div>
        </form>

        <script>
            function onSubmit(token) {
                document.getElementById("insert_form").submit();
            }
        </script>

        <?php
        include "function.php";

        if(!empty($_POST)){
            // var_dump($_POST);
            DbInsert($_POST["name"], $_POST["last_name"], $_POST["email"], $_POST["phone"], $_POST["group"], $_SESSION["id"]);
        }
        ?>
    
        <script type="text/javascript" src="js/mdb.min.js"></script>
    </body>
<html>