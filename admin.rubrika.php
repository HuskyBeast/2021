<?php 
ob_start();

    $pavadinimas = "";
    $aprasymas = "";
    $nuoroda = "";

    $rubrikos_id = "";

    $klaida = "";

if(isset($_POST["pavadinimas"])){
    $rubrikos_id = (int)($_POST["trinti"]??0);

    if($rubrikos_id){
        $sth = $DB->prepare('DELETE  FROM rubrika WHERE rid = ?;');
        $sth->execute(array($rubrikos_id));
        
        header('Location: admin.php');
        die();

}elseif(isset($_POST["pavadinimas"])){
    $pavadinimas = htmlspecialchars(trim(strip_tags($_POST["pavadinimas"])));
    $aprasymas = htmlspecialchars(trim(strip_tags($_POST["aprasymas"])));
    $nuoroda = htmlspecialchars(trim(strip_tags($_POST["nuoroda"])));

    $rubrikos_id = (int)($_POST["rid"]??0);

    if($pavadinimas && $nuoroda){
        if($rubrikos_id){
            
            $sth = $DB->prepare('UPDATE rubrika SET pavadinimas = ?, aprasymas = ?, nuoroda = ? WHERE rid = ?;');
            $sth->execute(array($pavadinimas,$aprasymas,$nuoroda, $rubrikos_id));
        }else{
            //įterpiame duomenis į DB
            $sth = $DB->prepare('INSERT INTO rubrika (rpavadinimas, raprasymas, rnuoroda) VALUE (?,?,?)');
            $sth->execute(array($pavadinimas,$aprasymas,$nuoroda));

        }

        header('Location: admin.php');
        die();
    }else{
        $klaida = "Neteisingai suvesta forma";
    }
}elseif (isset($_GET["rubrika"]) && is_numeric($_GET["rubrika"])){
    $rubrikos_id = (int)$_GET["rubrika"];
 
    $sth = $DB->prepare(
        "SELECT *
        FROM rubrika
        WHERE rid = ?
        LIMIT 1;"
    );
    $sth->execute(array($rubrikos_id));
    
    if($sth->rowCount() == 0){
        $klaida = "Rubrika neegzistuoja";
        $rubrikos_id = 0;
    }else{
        $rubrika = $sth->fetch(PDO::FETCH_ASSOC);

        $pavadinimas = $rubrika["pavadinimas"];
        $aprasymas = $rubrika["aprasymas"];
        $nuoroda = $rubrika["nuoroda"];
    }
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
if($klaida){
?>
<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    <?php echo $klaida;?>
  </div>
</div>
<?php
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Checkout example · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
      
            <?php 
            if($rubrikos_id){
                echo "<h3>" . $pavadinimas . "</h3>";
                echo "<hr>";

                echo '<form class="needs-validation" novalidate="" method="POST" admin.php?rubrika=' . $rubrikos_id . '>';
                    echo '<button class="btn btn-danger" type="submit">Trinti rubriką</button>';
                    echo "<input type=\"hidden\" name=\"trinti\" value=\"$rubrikos_id\">";
                echo "</form>";

                echo "<hr>";
                echo '<form class="needs-validation" novalidate="" method="POST" admin.php?rubrika=' . $rubrikos_id . '>';
                echo "<h4 class=\"mb-3\">Keisti" . $pavadinimas . "</h4>";
                echo "<input type=\"hidden\" name=\"id\" value=\"$rubrikos_id\">";
            }else{
                  echo '<form class="needs-validation" novalidate="" method="POST" admin.php?rubrika=' . $rubrikos_id . '>';
                  echo "<h4 class=\"mb-3\">Pridėti rubrika</h4>";
            }
            ?>
          <div class="row g-3">
            <div class="col-12">
              <label for="pavadinimas" class="form-label">Pavadinimas</label>
              <input type="text" class="form-control" name="pavadinimas" id="pavadinimas" value="<?php echo $pavadinimas ?>" required>
              <div class="invalid-feedback">
                pateikite pavadinima
              </div>
            </div>
            
            <div class="col-12">
                <label for="aprasymas" class="form-label">Aprašymas (neprivalomas)</label>
                <textarea type="text" class="form-control" name="aprasymas" id="aprasymas"><?php echo $pavadinimas ?></textarea>
            </div>
            
            <div class="col-12">
              <label for="nuoroda" class="form-label">Nuoroda</label>
              <input type="text" class="form-control" name="nuoroda" id="nuoroda" value="<?php echo $pavadinimas ?>">
            </div>
            
          </div>

          <hr class="my-4">

            <?php 
            if ($rubrikos_id){
                echo '<button class="w-100 btn btn-primary btn-lg" type="submit">Sukurti</button>';
            }else{
                echo '<button class="w-100 btn btn-primary btn-lg" type="submit">Keisti</button>';
            }
            ?>
          
        </form>
  </main>

</div>


    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
<?php 
    $rubrika = ob_get_clean();
?>