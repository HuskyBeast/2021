<?php
include_once "db.php";

?>
<!doctype html>
<html lang="lt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Blog Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/blog/">

    

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="CSS/bootstrap.min.css">

<meta name="theme-color" content="#7952b3">


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
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="CSS/blog.css" rel="stylesheet">

    <base href="http://localhost/PHP/PHP2/09-28/index.php">
  </head>
  <body>
    
        <div class="container">
            <header class="blog-header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-12 text-center">
                    <a class="blog-header-logo text-dark" href="admin.php">Straipsniai</a>
                </div>
                </div>
            </header>

            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                <?php 
                $sth = $DB->query('SELECT * FROM rubrika;');
                
                while($rubrika = $sth->fetch(PDO::FETCH_ASSOC)){
                    $pavadinimas = $rubrika["rpavadinimas"];
                    $nuoroda = $rubrika["rnuoroda"];
                    $aprasymas = $rubrika["raprasymas"];
                    if ($aprasymas == "") $aprasymas = $pavadinimas;

                    $element = "<a class=\"p-2 link-secondary\" href=admin.php?rubrika=%s title=\"%s\">%s</a>";
                    printf($element, $nuoroda, $aprasymas,$pavadinimas);

                    // echo "<a class=\"p-2 link-secondary\" href=\"" . $rubrika["nuoroda"] . "\" title=\"" . $rubrika["aprasymas"] . "\">" . $rubrika["pavadinimas"] . "</a>";
                }
                
                ?>
                </nav>
            </div>
        </div>

        <main class="container">
            
            <?php
            
            if(isset($_GET["straipsnis"])){
                //straipsnio isvedimas
                include_once "straipsnis.php";

            }elseif(isset($_GET["rubrika"])){
                //rubrikos isvedimas
                include_once "rubrika.php";

            }elseif(isset($_GET["nauja_rubrika"])){
                //naujos rubrikos sukurimas
                include_once "admin.rubrika.php";
                echo $rubrika;
            }elseif(isset($_GET["naujas_straipsnis"])){
                //naujo straipsnio sukurimas
                include_once "admin.straipsnis.php";

            }else {
                //titulinio isvedimas
                include_once "admin.titulinis.php";
                echo $content;
            }
            ?>
        </main>

        <footer class="blog-footer">
            <p>&copy; 2021. Visos teisės saugomos. Naujienų portalo projektas.</p>
        </footer>

    <script src="JS/bootstrap.bundle.min.js"></script>
  </body>
</html>
