<?php include('../post.php');?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>suppression</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/fiche.css">
  </head>
  <body style=" background:url(../strasbourg.jpg);">

     <div class="contenaire" style="position:relative; top: 250px;">
       <div class="row">
         <div class="col-6  border border-radius rounded-pill " style="margin:auto; background-color:white;">
           <form class="supprime" action="supprime.php?id=<?php echo $_GET['id'] ?>" method="post" >
             <div class="row">
               <div class="col-6 mx-auto text-center" style="margin:auto;">
                 <h1>Etes vous sur de vouloir supprimé cette article?</h1>
               </div>
             </div>
             <br>
             <div class="row">
               <div class="col-2"> </div>
               <input type="submit" class="col-3 btn rounded-pill btn-success" name="oui" value="oui">
               <div class="col-2"> </div>
               <input type="submit" class="col-3 btn rounded-pill btn-danger" name="non" value="non">
               <div class="col-2"> </div>
             </div>
           </form>
         </div>
       </div>
     </div>
     <?php
     $req = $bdd ->prepare('DELETE  FROM articles WHERE id=:id LIMIT 1');
     $oui = !empty($_POST['oui'])? $_POST['oui'] : NULL;
     $non = !empty($_POST['non'])? $_POST['non'] : NULL;

     if ($oui) {
      $req->execute(array(
        'id' => $_GET['id']
      ));
      echo 'article supprimé';
      header('location:../index.php');
    }else{
      echo 'il y a une erreur';
    };

    if ($non) {
      header('location:../index.php');
    };
      ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
