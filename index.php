<?php
session_start();

if(!$_session['cle']){
    header('Location: connexion.php');
}


?>