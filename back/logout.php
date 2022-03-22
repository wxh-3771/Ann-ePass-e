<?php
   session_start();
   session_unset();
   session_destroy(); // destruction de la session

   header("Location: login.php") //rediriger vers la page login 
   

?>