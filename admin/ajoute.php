<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ajout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/fiche.css">

  </head>
  <body>

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
      <?php include('../post.php');?>
    <form class="col-2 col-md-6 mx-auto " style="margin:auto;" action="ajoute.php" method="post">
      <label for="titre" class="form-label">titre</label>
      <input type="text" class="form-control border border-dark" name="titre" value="">

      <label for="subtitre" class="form-label">subtitre</label>
      <input type="text" class="form-control border border-dark" name="subtitre" value="">


      <label for="auteur" class="form-label">auteur</label>
      <input type="text" class="form-control border border-dark" name="auteur" value="">

      <label for="contenue" class="form-label">contenue</label>
      <textarea name="contenue" class="form-control border border-dark" rows="8" cols="250"></textarea>

      <label for="image" class="form-label">Image</label>
      <input type="text" class="form-control border border-dark" name="image" value="">

      <input type="submit" name="envoye" class="btn btn-success" value="envoye">
    </form>
    <?php
    function valid_donnees($donnees){
      $donnees = trim($donnees);
      $donnees = stripslashes($donnees);
      $donnees = htmlspecialchars($donnees);
      return $donnees;
    }

    if (isset($_POST['envoye'])) {
      $req = $bdd->prepare('INSERT INTO articles (titre, subtitre, auteur, contenue, image, date_creation) VALUES (:titre, :subtitre, :auteur, :contenue, :image, now())');
      $titre=valid_donnees($_POST['titre']);
      $subtitre=valid_donnees($_POST['subtitre']);
      $auteur=valid_donnees($_POST['auteur']);
      $contenue=valid_donnees($_POST['contenue']);
      $image=valid_donnees($_POST['image']);



    }
    if (isset($_POST['envoye']) AND !empty($_POST['titre']) AND !empty($_POST['contenue']) AND !empty($_POST['image'])) {

      $req->execute(array(
        'titre'=>htmlspecialchars($_POST['titre']),
        'subtitre'=>htmlspecialchars($_POST['subtitre']),
        'auteur'=>htmlspecialchars($_POST['auteur']),
        'contenue'=>htmlspecialchars($_POST['contenue']),
        'image'=>$_POST['image'],
      ));
      header('location:../index.php');
    }else{
      echo 'erreur!';
    }
     ?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
