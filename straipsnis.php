<?php
$straipsnio_nuoroda = $_GET["straipsnis"];

    $sth = $DB->prepare(
        "SELECT straipsnis.*, 
            rubrika.rpavadinimas as rubrika_pav,
            rubrika.rnuoroda as rubrika_nuor
        FROM straipsnis
        JOIN rubrika ON straipsnis.id = rubrika.rid
        WHERE straipsnis.nuoroda = ?
        LIMIT 1;"
    );
    $sth->execute(array($rubrika["id"]));

    if($sth->rowCount() == 0){
        include_once "404.php";;
    }else{
       $straipsnis = $sth->fetch(PDO::FETCH_ASSOC);
            
       $rubrikos_pavadinimas = $straipsnis["rubrika_pav"];
       $rubrikos_nuoroda = "?rubrika=" . $straipsnis["rubrika_nuor"];

       $pavadinimas = $straipsnis["pavadinimas"];
       $data;
       $aprasymas = $straipsnis["aprasymas"];
       $tekstas = $straipsnis["tekstas"];
       
       $paveiksliukas = $straipsnis["paveiksliukas"];
       if($paveiksliukas){
           $paveiksliukas = "IMG/" . $paveiksliukas;

            $paveiksliukas = '<figure>
                 <img class="img-fluid" src="'. $paveiksliukas . '" alt="' . $pavadinimas . '" title="' . $pavadinimas . '">
            <figcaption>' .$pavadinimas . '</figcaption>
            </figure>';
       }
       
       
       
       
?>

<h3 class="pb-4 mb-4 fst-italic border-bottom">
    <a><?php ?></a>
</h3>
    <article class="blog-post">
        <h2 class="blog-post-title"><?php echo $pavadinimas?></h2>
        <p class="blog-post-meta"><?php echo $date ?></p>

        <p><?php echo $aprasymas ?></p>

        <figure>
            <img src="<?php echo $paveiksliukas?>" alt="<?php echo $pavadinimas ?>" title="<?php echo $pavadinimas ?>">"
"> 
            <figcaption><?php echo $pavadinimas ?></figcaption>
        </figure>
        <hr>
        <p><?php echo $tekstas ?></p>

     </article>
<?php 
    }
?>