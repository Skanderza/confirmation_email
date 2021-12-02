<?php

session_start(); 

//Connection BDD
$bdd =new PDO('mysql:host=localhost;dbname=confirmation_email', "root", "root");


if(isset($_GET['id']) AND !empty($_GET['id']) AND isset($_GET['cle']) AND !empty($_GET['id'])){

    $getid = $_GET['id'];
    $getcle = $_GET['cle'];
    $recupUser = $bdd->prepare('SELECT * FROM USERS WHERE id = ? AND cle = ?');
    $recupUser->execute(array($getid, $getcle));
    if($recupUser->rowCount()>0){
        $userInfo = $recupUser->fetch();
        if($userInfo['confirme'] != 1){
            $updateConfirmation = $bdd->prepare('UPDATE users SET confirme = ? WHERE id = ?');
            $updateConfirmation->execute(array(1, $getid));
            $_SESSION['cle'] = $getcle;
            header('Location: index.php');
        }else{
            $_SESSION['cle'] = $getcle;
            header('Location: index.php');
        }
    }else{
        echo "Votre clé ou identifiant est incorrecte";
    }

    
}else{
    echo "Aucun utilisateur trouvé";
}

?>