<?php 
// cette partie concerne la connexion à ma base de donnée que j'ai nommé bd
$conn = mysqli_connect("localhost","root" , "", "bd"); 

if(!$conn) {
     echo"<script>alert('Connexion Echouer.')</script>";
}

?>