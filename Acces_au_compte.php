<?php
session_start();


//echo sha1('hi');
echo $_POST['Email'] . $_POST['Password'];
if (isset($_POST['connexion'])) {
  echo "       isset marche!!!!!!!!!!!!!" . $_POST['connexion'] . !empty($_POST['Email'] . !empty($_POST['Password']));
  if (!empty($_POST['Email']) and !empty($_POST['Password'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=utilisateurs;charset=utf8', 'root', '');
    echo "empty marche!!!!!!!!!!!!!!!!!";
    $RecupUser = $bdd->prepare('SELECT * FROM user WHERE Email=?');
    $RecupUser->execute(array($_POST['Email']));
    if ($RecupUser->rowCount() > 0) {
      echo "connex";
      /* $_SESSION['Email']=$Email;
      $_SESSION['Password']=$Password;
      $_SESSION['id']=$RecupUser->fetch()['id'];
      echo"sdfghabc"; */
      $userInfo = $RecupUser->fetch();
      if ($userInfo['confirme'] == 1) {
        header('Location: verif.php?id=' . $userInfo['id'] . '&cle=' . $userInfo['cle']);
      } else {
        echo "Vous n'êtes pas confirmé au niveau du site";
      }


    } else {
      echo "L'utilisateur n'existe pas";

    }


    if (!empty($_POST['Email']) and !empty($_POST['Password']) and $RecupUser->rowCount() == 3) {
      echo '<script>' . 'alert("mdp ou mail incorrect");' . '</script>';
      echo "else";
    }


  } else {
    echo "Veuillez mettre votre e-mail";

  }





} else {
  echo "isset marche pas";
}
?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="Acces_au_compte.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
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
  <div style="display:flex">
    <div class="typeVetements">
      <ul>
        <li><a href="">Vêtements femmes</a></li>
        <li><a href="">Vêtements hommes</a></li>
        <li><a href="">sport</a></li>
        <li><a href="">Accéssoires</a></li>
        <li><a href="">Beauté</a></li>
      </ul>
    </div>


    <div class="divform">
      <form method='POST' action="">

        <h1>Connexion</h1>


        <div class="inputs">
          <input type="email" placeholder="Email" name="Email" />

          <hr>
          <br>
          <input type="password" placeholder="Mot de passe" name="Password">

        </div>
        <div align="center">
          <p>Pas de compte?<a href="Creation_de_compte.php">Créer un compte ici.</a></p>
          <input type="submit" name="connexion">Se connecter</input>
        </div>
      </form>

    </div>
  </div>
</body>

</html>