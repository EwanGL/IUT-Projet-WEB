<?php
session_start();
session_destroy();
header('Location: http://localhost/WEB2/IUT-Projet-WEB/connexion.php');
die();
?>