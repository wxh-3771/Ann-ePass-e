<?php
    session_start();
    if (!isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: login.php"); //rediriger vers la page login
        exit();
    }
    include 'conbd.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="imgV/png" href="../imgV/logo.png">
    <link rel="stylesheet" href="../css/bienvenue.css">
    <title>Espace privé</title>
</head>
<body>
      <header>
		  Espace privé 
		  <a href="logout.php">Quitter la session</a> <!-- c'est le lien vers la page logout qui permet à l'utilisateur de se déconnecté du 
          site et redirige apres l'utilisateur vers la page d'acceuil qui est la page Index dans le cas de mon site -->
	  </header>
  
      <div class="navbar">
            <ul>
                <li><a class="active" href="../index.html">Accueil</a></li>
 				<li><a href="../html/produit.html">Produits</a></li>
                 <li> <a href="../html/promotion.html"class="promo-lien">promotion</a></li> 
                 <!-- j'ai pas inclue les pages login et register dans la barre de navigation de la page de bienvenue car ces deux pages 
                 sont inaccessibles lorque l'utilisateur est déja connecté au site et j'ai fait la meme chose pour les pages login et register 
                 qui sont bien sur seulement accessible lorsque l'utilisateur n'est pas connecté à mon site-->
           </ul>
           <img src="../imgV/logo.png" alt="logo" classe="logo-image" width=150px;>
     </div>   

     <div class="tout">
      <?php
            $sql = "SELECT * FROM users WHERE email='{$_SESSION["SESSION_EMAIL"]}'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result); 
        ?>

      <h1>
		   <?php 
			  echo (date("H")<16)?("Bonjour"):("Bonsoir"); /* ici cela va afficher soit Bonsoir si l'heure -qui est l'heure système de 
              l'utilisateur- est supérieure à 16h 
              Ou soit Bonjour si cet heure inférieure à 16h*/
		   ?>
		  <span>
		      <?php echo $row["name"]; /*cela va afficher le nom de l'utilisateur qui s'est connecté donc qui a eu accées à la page Bienvenue 
              car cette page est inaccessible lorsque l'utilisateur ne c'est pas connecté*/
              ?>  
              
          <span class="form">
	  </h1>
     <?php } ?>
    </div>
    
</body>
</html>