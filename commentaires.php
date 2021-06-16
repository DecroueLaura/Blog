<?php
  include('post.php');
  if (isset($_POST['envoye'])) {
    $article=$_POST['id_article'];
    $nom=$_POST['nom'];
    $commentaire=$_POST['commentaire'];

    $req = $bdd->prepare('INSERT INTO commentaires (id_article, nom, commentaire, datereat)
    VALUES (:id_article, :nom, :commentaire, NOW())');
    $req->execute(array(
      'id_article'=>$article,
      'nom'=>$nom,
      'commentaire'=>$commentaire
    ));
    header('location:article.php?article='.$_POST['id_article']);
  }
  ?>
