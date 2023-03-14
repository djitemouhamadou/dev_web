<?php
require "PHPMailer/PHPMailerAutoload.php";
session_start();
if (isset($_POST['creation'])) {
  $bdd = new PDO('mysql:host=localhost;dbname=utilisateurs;charset=utf8', 'root', '');
  if (!empty($_POST['Nom']) and !empty($_POST['Prenom']) and !empty($_POST['Email']) and !empty($_POST['Password']) and !empty($_POST['Cpassword']) and $_POST['Password'] == $_POST['Cpassword']) {
    $cle = rand(1000000, 9000000);
    $Nom = htmlspecialchars($_POST['Nom']);
    $Prenom = htmlspecialchars($_POST['Prenom']);
    $Email = htmlspecialchars($_POST['Email']);
    $Password = sha1($_POST['Password']);

    $insertUtilisateur = $bdd->prepare('INSERT INTO user(Nom,Prenom,Email,Password,cle,confirme) VALUES (?,?,?,?,?,?)');
    $insertUtilisateur->execute(array($Nom, $Prenom, $Email, $Password, $cle, 0));

    $RecupUser = $bdd->prepare('SELECT * FROM user WHERE Nom = ? AND Prenom=? AND Email=? AND cle=?');
    $RecupUser->execute(array($Nom, $Prenom, $Email, $cle));

    if ($RecupUser->rowCount() > 0) {
      $userInfos = $RecupUser->fetch();
      $_SESSION['id'] = $userInfos['id'];
      echo $_SESSION['id'] == 1;
      /* 
      $_SESSION['Nom'] = $Nom;
      $_SESSION['Prenom'] = $Prenom;
      $_SESSION['Email'] = $Email;
      $_SESSION['Password'] = $Password;
      $_SESSION['id'] = $RecupUser->fetch()['id']; */

      function smtpmailer($to, $from, $from_name, $subject, $body)
      {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;

        $mail->SMTPSecure = 'TLS';
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->Port = '587';
        $mail->Username = 'ant_charlet@hotmail.fr';
        $mail->Password = '';

        //   $path = 'reseller.pdf';
        //   $mail->AddAttachment($path);

        $mail->IsHTML(true);
        $mail->From = "ant_charlet@hotmail.fr";
        $mail->FromName = $from_name;
        $mail->Sender = $from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if (!$mail->Send()) {
          $error = "Please try Later, Error Occured while Processing...";
          return $error;
        } else {
          $error = "Thanks You !! Your email is sent.";
          return $error;
        }
      }

      $to = $Email;
      $from = 'ant_charlet@hotmail.fr';
      $name = 'Antoine';
      $subj = 'PHPMailer 5.2 testing from DomainRacer';
      $msg = 'http://localhost/AWA_dev_web/verif.php?id=' . $_SESSION['id'] . '&cle=' . $cle;

      $error = smtpmailer($to, $from, $name, $subj, $msg);




    }
  } else {
    echo "Veuillez mettre votre email";
  }







}




?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="Creation_de_compte.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>site de vêtements</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" async></script>
</head>

<body>
  <nav class="nav">
    <button onclick="fct()"><img src="pngegg.png" alt="menuBarre" class="menuBarre" id="menuBarre"></button>
    <a href="" class="nomEntreprise">Top Vêtement</a></button>
    <div class="compte">
      <ul>
        <li><a href="Acces_au_compte.php">Se connecter</a></li>
        <li><a href="">Mon panier</a></li>
        <li><a href="">Langue</a></li>
      </ul>
    </div>

  </nav>
  <div style="display:flex;background-color:white;">
    <div class="typeVetements">
      <ul>
        <li><a href="">Vêtements femmes</a></li>
        <li><a href="">Vêtements hommes</a></li>
        <li><a href="">sport</a></li>
      </ul>
    </div>


    <div class="divform">
      <form method="POST" action="">

        <h1>INFORMATIONS PERSONNELLES</h1>


        <div class="inputs">
          <input type="text" placeholder="Nom" name="Nom" />
          <input type="text" placeholder="Prénom" name="Prenom" />
          <input type="email" placeholder="Email" name="Email" />
          <br>
          <hr>
          <br>
          <input type="password" placeholder="Mot de passe" name="Password">
          <input type="password" placeholder="Confirmer le mot de passe" name="Cpassword">
        </div>


        <div align="center">
          <input type="submit" name="creation">Créer un compte</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>