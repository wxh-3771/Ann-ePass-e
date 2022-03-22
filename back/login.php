<?php
    session_start();
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: bienvenue.php");// rediriger à la page bienvenue
    }

    if (isset($_POST["email"])) {
        include 'conbd.php';//on va inclure la connexion à la base de donnée 
        
        $email = mysqli_real_escape_string($conn, $_POST["email"]); /* mysqli_real_escape_string permet d'éviter l'écriture de code html à 
        des fins malveiantes */
        $password = mysqli_real_escape_string($conn, md5($_POST["password"])); /* md5 va hacher le mot de passe entré par l'utilisateur lors
         de son inscription */

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}' ";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

           if ($count === 1) {
                 $row = mysqli_fetch_assoc($result);

                 $x = $row["nbre_con"] + 1; //nbre_con est le nombre de fois que l'utilisateur de cet email s'est connecté à ma base de donnée 
                 mysqli_query($conn, "UPDATE users SET nbre_con='{$x}' WHERE email='{$email}'");
                 
                 $_SESSION["SESSION_EMAIL"] = $email;
                 header("Location: bienvenue.php");
            }else {
                   echo "<script>alert('Vos détails de connection sont incorrectes.');</script>";
                }
    }else{ 
         echo "<script>alert(' vous étes déconnecté .');</script>"; //ce message va s'afficher dans deux cas 
          //le 1 ére cas est lors de la déconnexion du site en cliquant sur le lien Déconnexion qui se trouve dans la page Bienvenue
         //le 2 éme cas est lorque l'utilisateur ne s'est pas encore connecté et il clique sur le lien de connexion qui se trouve soit sur la barre de navigation de l'une des pages de son site soit dnas le lien Se connecter dans la page d'inscription 
         // je voulais faire des messages pour prévenir l'utilisateur de sa déconnexion du site mais ça a eu cet effet.
        }       
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="imgV/png" href="../imgV/logo.png">
    <title>Connection</title>
</head>
<body>
     <header>
      <div class="navbar">
            <ul>
                <li><a class="active" href="../index.html">Accueil</a></li>
 				<li><a href="../html/produit.html">Produits</a></li>
                 <li> <a href="../html/promotion.html"class="promo-lien">Promotion</a></li>
           </ul>
     </div>   
    </header>
     <div class="tout">
        <h2 class="titre">Connection</h2>
        <form action="" method="post" class="form">
            <div class="champs">
                <label for="email" class="label">Email</label>
                <input type="email" name="email" id="email" class="input" placeholder="Entrer votre email" required>
            </div>
            <div class="champs">
                <label for="password" class="label">Mot de passe</label>
                <input type="password" name="password" id="password" class="input" placeholder="Entrer votre mot de passe" required>
            </div>
            <button class="btn" name="login">Se connecter</button>
            <p>Vous n'avez pas de compte? creer un maintenant! <a href="register.php">S'incrire</a>.</p>
        </form>
    </div>
</body>
</html>