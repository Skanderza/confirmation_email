<?php
 require "PHPMailer/PHPMailerAutoload.php";
session_start(); 
//Connection BDD
$bdd =new PDO('mysql:host=localhost;dbname=confirmation_email', "root", "root");

if(isset($_POST['valider'])){
    if(!empty($_POST['email'])){
       
        $cle = rand(1000000, 9000000);
        $email = $_POST['email'];
        $insererUser = $bdd->prepare('INSERT INTO users(email, cle, confirme)VALUES (?,?,?) ');
        $insererUser->execute(array($email, $cle, 0));
        

        //Récupération utilisateur a travers email
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE email=?');
        $recupUser->execute(array($email)); 
        //rowCount > 0 : si on trouve un nombre de champs supérieur a zéro
        if($recupUser->rowCount()>0){
            $userInfos = $recupUser->fetch();
            $_SESSION['id'] = $userInfos['id'];
            $id = $_SESSION['id'];
      
            function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;  
        $mail->Username = 'zahiskander.test@gmail.com';
        $mail->Password = 'Skan1919test';   
   
   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="zahiskander.test@gmail.com";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ="Please try Later, Error Occured while Processing...";
            return $error; 
        }
        else 
        {
            $error = "Thanks You !! Your email is sent.";  
            return $error;
        }
    }
    
    $to   = $email;
    $from = 'zahiskander.test@gmail.com';
    $name = 'Skander';
    $subj = 'Email de confirmation de compte';
    
        $msg = '
        <html>
        <head>Confirmation du compte</head>
        <body>
        <p>Veuillez cliquez sur le lien pour confirmer votre compte<p>
        <a href="http://localhost:8888/Confirmation_mail/verif.php?id='.$id.'&cle='.$cle.'">ICI<a/>
        </body></html>
        http://localhost:8888/Confirmation_mail/verif.php?id='.$_SESSION['id'].'&cle='.$cle;

    $error=smtpmailer($to,$from, $name ,$subj, $msg);

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
        <h1>Inscription</h1>
    <form method="POST" action="">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" name='email'>Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
 
  
  <input type="submit" class="btn btn-primary" name='valider' value='envoyer'>
</form>
    </div>

</body>
</html>