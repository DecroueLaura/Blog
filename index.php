<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fiche.css">
  </head>
  <body>
    <?php include('post.php');?>


    <header class="masthead" style="background-image: url(entete.jpeg);">
      <?php include('nav.php') ?>
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
      <?php

      $articles_par_page=2;
      $requete= $bdd->query('SELECT COUNT(*) AS nb_articles FROM articles');
      $donnees=$requete->fetch();
      $nb_articles=$donnees['nb_articles'];
      $nb_pages=ceil($nb_articles/$articles_par_page);

      if (isset($_GET['page']) AND $_GET['page']>0) {
        $page = $_GET['page'];
      }else{
        $page=1;
      }
      $req = $bdd->query('SELECT id, titre, subtitre, auteur, contenue, image, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\')
      AS date_creation_fr FROM articles ORDER BY date_creation DESC LIMIT '. ($page-1)*$articles_par_page . ',' . $articles_par_page);

      while($donnees = $req->fetch()){
       ?>
       <div class="container">
         <div class="row ">
           <div class="col-lg-6 col-md-10 mx-auro text-center" style="margin:auto;margin-top:100px;">
             <a href="article.php?article=<?php echo $donnees['id'] ?>">
               <h2> <?php echo htmlspecialchars($donnees['titre']); ?> </h2>
               <h3> <?php echo htmlspecialchars($donnees['subtitre']); ?> </h3>
               <p> <?php echo $donnees['date_creation_fr']; ?> </p>
             </a>
             <p> <?php echo nl2br(htmlspecialchars($donnees['contenue'])); ?> </p>
             <img class="img-fluid" src="<?php echo $donnees['image']; ?>" alt="">
           </div>
         </div>
       </div>
       <?php
     }
     $req->closeCursor();
        ?>

        <nav>
          <ul class="pagination justify-content-center pagination-lg">
            <?php
            for ($page=1 ; $page <= $nb_pages  ; $page++) {?>
               <li class="page-item"><?php
                echo '<a class="page-link" href="index.php?page='.$page.'">'.$page.'</a>';
                ?>
              </li>
              <?php
              }
             ?>
          </ul>
        </nav>
    </main>


    <footer>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
