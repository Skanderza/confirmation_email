<?php

session_start(); 
//Connection BDD
$bdd =new PDO('mysql:host=localhost;dbname=confirmation_email', "root", "root");

if(isset($_POST['valider'])){
  if(!empty($_POST['email'])){
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE email = ?');
    $recupUser->execute(array($_POST['email']));
    if($recupUser->rowCount()>0){
      $userInfo = $recupUser->fetch();
      if($userInfo['confirme'] == 1){
        var_dump($userInfo['confirme']);
        header('Location: verif.php?id='.$userInfo['id'].'&cle='.$userInfo['cle']);
      }else{
        echo 'veuillez confirmer votre mail';
      }
    }else{
      echo "L'utilisateur n'existe pas";
    }
  }else{
    echo 'Veuillez mettre votre email';
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=C, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
  <h1>Connection</h1>
  <div class="container">
  <form method="POST" action="">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  
 
  <button type="submit" class="btn btn-primary" name="valider">Submit</button>
</form>
  </div>

</body>
</html>