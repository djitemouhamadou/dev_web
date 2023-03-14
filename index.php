<?php
/*
session_start();
$_SESSION = array();
session_destroy();
header("location:Acces_au_compte.php");

*/
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site de vêtements</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" async></script>


</head>

<body>
        <nav class="nav">
            <button onclick="fct()" class="bouton"><img src="pngegg.png" alt="menuBarre" class="menuBarre" id="menuBarre"></button>
            <a href="" class="nomEntreprise">Top Vêtement</a></button>
            <div class="compte">
                <ul>
                    <li><a href="Acces_au_compte.html">Se connecter</a></li>
                    <li><a href="">Mon panier</a></li>
                    <li><a href="">Langue</a></li>
                </ul>
            </div>

        </nav>
        


    
    <div class="typeVetements">
            <ul>
                <li><a href="">Femmes</a>
                    <ul>
                        <li>Robes</li>
                        <li>Jupes</li>
                    </ul>
                </li>
                <li><a href="">Hommes</a></li>
                <li><a href="">sport</a></li>
                <li><a href="">Accéssoires</a></li>
                <li><a href="">Beauté</a></li>
            </ul>
        </div>
</body>

</html>