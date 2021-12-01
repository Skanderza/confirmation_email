<?php

session_start(); 

//Connection BDD
$bdd =new PDO('mysql:host=localhost;dbname=confirmation_email', "root", "root");


if(isset($_GET['id']) AND !empty($_GET['id']) AND isset($_GET['cle']) AND !empty($_GET['id'])){

    $getid = $_GET['id'];
    $getcle = $_GET['cle'];
    
    
}else{
    echo "Aucun utilisateur trouvé";
}

?>