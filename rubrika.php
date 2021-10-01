 <?php
 $rubrikos_nuoroda = $_GET["rubrika"];
 
    $sth = $DB->prepare(
        "SELECT *
        FROM rubrika
        WHERE rubrika.nuoroda = \"?\"
        LIMIT 1;"
    );
    $sth->execute(array($rubrikos_nuoroda));
    
    if($sth->rowCount()){
        $rubrika = $sth->fetch(PDO::FETCH_ASSOC);
?>
    <h3 class="pb-4 mb-4 fst-italic border-bottom">
        <?php ?>
    </h3>
<?php
        $sth = $DB->prepare(
            "SELECT *
            FROM straipsnis
            WHERE rid = ?
            ORDER BY laikas
            LIMIT 10;"
        );
        $sth->execute(array($rubrika["id"]));

        if($sth->rowCount() == 0){
            echo "<p>Šioje rubrikoje straipsnių nėra</p>";
        }else{
            while($straipsnis = $sth->fetch(PDO::FETCH_ASSOC)){
                $pavadinimas = $straipsnis["pavadinimas"];
                $paveiksliukas = $straipsnis["paveiksliukas"];
                $nuoroda = "?straipsnis=". $straipsnis["nuoroda"];
                $date = date("Y-m-d H:i", strtotime($straipsnis["laikas"]));
                
                $aprasymas = explode(" ", $straipsnis["aprasymas"]);
                
                if(count($aprasymas)>10){
                    $aprasymas = array_slice($aprasymas, 0, 10);
                    $aprasymas = implode(" ", $aprasymas);
                    $aprasymas .= "...";
                }else{
                    $aprasymas = $straipsnis["aprasymas"];
                }
                
                $rubrika = $straipsnis["rubrika"];

                if($straipsnis["paveiksliukas"]){
                    $paveiksliukas = '<img src="img/"' . $straipsnis["paveiksliukas"] . '">';
                } else {

                    $paveiksliukas = '<svg class="bd-placeholder-img" 
                            width="200" 
                            height="250" 
                            xmlns="http://www.w3.org/2000/svg" 
                            role="img" 
                            aria-label="Placeholder: Thumbnail" 
                            preserveAspectRatio="xMidYMid slice" 
                            focusable="false">
                                <title>' . $pavadinimas. '</title>
                                <image
                                    href="IMG/"'. $straipsnis["paveiksliukas"]. '
                                    width="100%"
                                    height="100%"
                                >
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Paveiksliukas</text>
                        </svg>';
                }
            }
        }
?>


 
    <div class="row mb-2">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0">Featured post</h3>
                <div class="mb-1 text-muted">2020 sausio 14 d.</div>
                <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="stretched-link">Skaitykite daugiau...</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            </div>
        </div>
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0">Post title</h3>
                <div class="mb-1 text-muted">Nov 11</div>
                <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="stretched-link">Skaitykite daugiau...</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            </div>
        </div>
    </div>

<?php
    }else{
        include_once "404.php";
    }
?>

 <!-- TESTAS 123 -->