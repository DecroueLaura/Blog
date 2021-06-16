<?php
// connexion base de donné
try{
    $bdd = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e){
  echo "Erreur : " . $e->getMessage();
}
 ?>
