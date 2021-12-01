<?php
session_start(); 
//Connection BDD
$bdd =new PDO('mysql:host=localhost;dbname=confirmation_email', "root", "root");

if(isset($_Post['valider'])){
    if(!empty($_POST['email'])){
        $cle = rand(1000000, 9000000);
        $email = $_POST['email'];
        $insererUser = $bdd->prepare('INSERT INTO users(email, cle, confirme)VALUES (?,?,?) ');
        $insererUser->execute(array($email, $cle, 0));

        //Récupération utilisateur a travers email
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE email=?');
        $recupUser->execute( array($email)); 
        //rowCount > 0 : si on trouve un nombre de champs supérieur a zéro
        if($recupUser->rowCount()>0){
            $userInfos = $recupUser->fetch();
            $_session['id'] = $userInfos['id'];
        }


    }else{
        echo "Veuillez mettre votre email";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
    <form method="POST" action="">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" name='email'>Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
 
  
  <button type="submit" class="btn btn-primary" name='valider'>Submit</button>
</form>
    </div>

</body>
</html>