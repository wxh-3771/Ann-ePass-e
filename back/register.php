<?php
    session_start();
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: bienvenue.php");
    }

    if (isset($_POST["submit"])) {
        include 'conbd.php'; 

        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST["cpassword"]));
        
        $nbre_con = 0; // nombre de connection de l'utilisateur sur le site  

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            echo "<script>alert('{$email} - Cet email éxiste dèja.');</script>";
        }else {
               if(strlen($email) <= 50){ 
                   if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme 
                      if ($password === $cpassword) { 
                          $sql = "INSERT INTO users (date, name, email, password, nbre_con) VALUES (now(), '{$name}', '{$email}', '{$password}', '{$nbre_con}')";
                         $result = mysqli_query($conn, $sql);

                           if ($result) {
                             header("Location: login.php"); /* l'utilisateur est immédiatement rediriger vers la page Login pour se connecter 
                             apres son inscription sur le site */
                            }else {
                                  echo "<script>Error: ".$sql.mysqli_error($conn)."</script>";
                                }
                        }else {
                             echo "<script>alert('Le mot de passe confirme est different du mot de passe.');</script>";
                            }
                    }else{ 
                         echo"<script>alert('{$email} - n\'est pas de la bonne forme.');</script>";
                        }
                }else{ 
                echo"<script>alert('La longeur de votre email - {$email} - est supérieure à 50.');</script>"; /* ce sont tous des messages
                 d'erreurs qui vont s'afficher dans les cas de non respect des securités définis dans ce code à savoir la remplit obligatoire
                  de tous les champs, et autres parametres définit ici -mais je n'ai pas definie tous les parametres seulement le strictes
                   minimum pour le bon fonctionnement d'un site pas encore mis sur internet par l'utilisateur- */
            }
        }     
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="imgV/png" href="../imgV/logo.png">
    <link rel="stylesheet" href="../css/login.css">
    <title>Inscription</title>
</head>
<body>
      <header>
          <div class="navbar">
              <ul>
                 <li><a class="active" href="../index.html">Accueil</a></li>
 				 <li><a href="../html/produit.html">Produits</a></li>
                 <li> <a href="../html/promotion.html"class="promo-lien">promotion</a></li>
              </ul>
         </div>   
      </header>


     <div class="tout">
        <h2 class="titre">Inscription</h2>
        <form action="" method="post" class="form">
            <div class="champs">
                <label for="name" class="label">Nom Complet</label>
                <input type="name" name="name" id="name" class="input" placeholder="Entrer votre nom" required>
            </div>
            <div class="champs">
                <label for="email" class="label">Email</label>
                <input type="email" name="email" id="email" class="input" placeholder="Entrer votre email." required>
            </div>
            <div class="champs">
                <label for="password" class="label">Mot de passe </label>
                <input type="password" name="password" id="password" class="input" placeholder="Entrer votre mot de passe." required>
            </div>
            <div class="champs">
                <label for="cpassword" class="label">Confirmer votre mot de passe</label>
                <input type="password" name="cpassword" id="cpassword" class="input" placeholder="Entrer votre mot de passe de confirmation" required>
            </div>

            <button class="btn" name="submit">S'inscrire</button>
            <p>Vous avez un compte? <a href="login.php">Se connecter</a>.</p>
        </form>
    </div>
</body>
</html>