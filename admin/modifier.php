

<?php include('../post.php');?>
<?php
    $getId=intval($_GET['id']);
    $req = $bdd->prepare('SELECT * FROM articles WHERE id=:id');
    $req->execute(array(
      'id' => $getId,
    ));
    $data=$req->fetch();

    if (isset($_POST['titre'])|| isset($_POST['subtitre']) || isset($_POST['contenue']) || isset($_POST['image'])) {
      $titre_modif = $_POST['titre'];
      $subtitre_modif = $_POST['subtitre'];
      $contenue_modif = $_POST['contenue'];
      $image_modif = $_POST['image'];

      $req = $bdd->prepare("UPDATE articles SET titre = :titre, subtitre = :subtitre, contenue = :contenue, image = :image, date_creation = NOW() WHERE id = :id");
      $req->execute(array(
        'titre' => $titre_modif,
        'subtitre' => $subtitre_modif,
        'contenue' => $contenue_modif,
        'image' => $image_modif,
        'id'=> $_POST["id"],
      ));
      header("Location:index.php");
    };
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modification de l'article</title>
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
    <div class="contenaire">
      <div class="row">
        <div class="col-8 col-md-10 border border-radius border-dark mx-auto" style="margin:auto;">
          <form class="modif" action="modifier.php" method="post">
            <label for="titre">Nouveau Titre</label>
            <input type="text" class="form-control border border-radius border-dark" name="titre" value="<?php echo $data['titre']  ?>">
            <br>
            <label for="subtitre">Nouveau sous Titre</label>
            <input type="text" class="form-control border border-radius border-dark" name="subtitre" value="<?php echo $data['subtitre'] ?>">
            <br>
            <label for="contenue">Nouveau Contenue</label>
            <textarea name="contenue" class="form-control border border-radius border-dark"   cols="80" ><?php echo $data['contenue'] ?></textarea>
            <br>
            <label for="image">Nouvelle Image</label>
            <input type="text" class="form-control border border-radius border-dark" name="image" value="<?php echo $data['image'] ?>">
            <br>
            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
            <input type="submit" name="modifier" class="btn btn-success " value="modifier">
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
