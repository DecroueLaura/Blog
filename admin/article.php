<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/fiche.css">
  </head>
  <body>
    <?php include('../post.php');?>


    <header class="masthead" style="background-image: url(../entete.jpeg);">
      <?php include('../nav.php') ?>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10  mx-auto">
            <div class="page-heading" style="text-align:center">
              <h1>Gay Pride</h1>
              <span>Les dates et lieu des Gay Pride de 2021</span>
            </div>
          </div>
        </div>
      </div>
    </header>


    <main>
      <?php $req = $bdd->prepare('SELECT id, titre, subtitre, auteur, contenue, image, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles WHERE id=?');
      $req->execute(array($_GET['article']));
      $donnees = $req->fetch();
      if (!isset($donnees['id'])) {
        ?> <p>Article inconnu!</p>
        <?php
      }else{
        ?>
        <div class="container">
          <div class="row ">

            <div class="col-lg-6 col-md-10 ">
              <a href="../article.php?article=<?php echo $donnees['id'] ?>">
                <h2> <?php echo htmlspecialchars($donnees['titre']); ?> </h2>
                <h3> <?php echo htmlspecialchars($donnees['subtitre']); ?> </h3>
                <p> <?php echo $donnees['date_creation_fr']; ?> </p>
              </a>
              <p> <?php echo nl2br(htmlspecialchars($donnees['contenue'])); ?> </p>
              <img class="img-fluid" src="../<?php echo $donnees['image']; ?>" alt="">
            </div>
          </div>
        </div>
        <?php
        $req->closeCursor();
        ?>

        <?php $req = $bdd->prepare('SELECT id, id_article, nom, commentaire, DATE_FORMAT(datereat, \'%d/%m/%y à %Hh%imin%ss\') AS date_commentaires_fr FROM commentaires WHERE id_article = ? ORDER BY datereat');
        $req->execute(array($_GET['article']));
        while ($donnees = $req->fetch()){
          ?>
          <div class="container">
            <div class="row">
              <div class="col-3 ">
                <h2>Commentaire publié</h2>
                <h3><?php echo htmlspecialchars($donnees['nom']) ?> <?php echo $donnees['date_commentaires_fr'] ?> </h3>
                <p> <?php echo nl2br(htmlspecialchars($donnees['commentaire'])) ?> </p>
              </div>
            </div>
            <?php
          }
          $req->closeCursor();
          ?>
          <form class="commentaire col-6 " action="commentaires.php" method="post">
            <h2>Mettez un commentaire!</h2>
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="nom">
            <label for="com" class="form-label">Commentaire</label>
            <textarea name="commentaire" rows="2" cols="40"></textarea>
            <input type="hidden" name="id_article" class="form-control" value="<?php echo $_GET['article'] ?>">
            <input type="submit" name="envoye" class="btn btn-primary" value="envoye">
          </form>
          <a href="modifier.php?id=<?php echo $_GET['article'] ?>" class=" col-1 btn btn-primary">modifier</a>
          <a href="supprime.php?id=<?php echo $_GET['article'] ?>" class=" col-1 btn btn-danger">supprime</a>
        </div>
        <?php
      }
       ?>

    </main>


    <footer>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
